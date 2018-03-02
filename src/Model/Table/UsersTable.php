<?php
namespace App\Model\Table;

use App\Model\Entity\Commentary;
use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Routing\Router;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\CommentariesTable|\Cake\ORM\Association\HasMany $Commentaries
 *
 * @method \App\Model\Entity\User
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id'
        ]);
        $this->hasMany('Commentaries', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->allowEmpty('bio');

        $validator
            ->allowEmpty('gender');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));

        return $rules;
    }

    /**
     * cleanEmail method
     *
     * @param string $email of user
     * @return string
     */
    public function cleanEmail($email)
    {
        $email = trim($email);
        $email = strtolower($email);

        return $email;
    }

    /**
     * generatePassword method
     *
     * @return bool|string
     */
    public function generatePassword()
    {
        $characters = str_shuffle('abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789');

        return substr($characters, 0, 6);
    }

    /**
     * getEmailFromId method
     *
     * @param int $userId of user
     * @return array|mixed|string
     */
    public function getEmailFromId($userId)
    {
        $query = $this->find()
            ->select(['email'])
            ->where(['id' => $userId]);
        $result = $query->all();
        $email = $result->toArray();
        $email = implode($email);
        $email = trim($email, '{}');
        $email = str_replace('"email": ', '', $email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        return $email;
    }

    /**
     * getIdFromEmail method
     *
     * @param string $email Email address
     * @return bool|int
     */
    public function getIdFromEmail($email)
    {
        $result = $this->find()
            ->select(['id'])
            ->where(['email' => $email])
            ->first();
        if ($result) {
            return $result->id;
        }

        return false;
    }

    /**
     * getOldPassword function
     *
     * @param int $id of user
     * @return string
     */
    public function getOldPassword($id)
    {
        $user = $this->get($id);

        return $user->password;
    }

    /**
     * getResetPasswordHash method
     *
     * @param int $userId of user
     * @param string $email of user
     * @return string
     */
    public function getResetPasswordHash($userId, $email)
    {
        $salt = Configure::read('security_salt');
        $month = date('my');

        return md5($userId . $email . $salt . $month);
    }

    /**
     * sendNewsmediaAlertEmail method
     *
     * @param User|\Cake\Datasource\EntityInterface $user entity
     * @param Commentary|\Cake\Datasource\EntityInterface $commentary entity
     * @return array
     */
    public function sendNewsmediaAlertEmail($user, $commentary)
    {
        $email = new Email('default');
        $timestamp = strtotime($commentary['published_date']);
        $email
            ->setTo($user['email'])
            ->setSubject('CBER Commentaries: Alert')
            ->setTemplate('newsmedia_alert')
            ->setEmailFormat('both')
            ->setHelpers(['Html', 'Text'])
            ->setViewVars([
                'commentary' => $commentary,
                'recipientName' => $user['name'],
                'url' => Router::url(
                    [
                        'controller' => 'commentaries',
                        'action' => 'view',
                        'id' => $commentary['id'],
                        'slug' => $commentary['slug']
                    ],
                    true
                ),
                'newsmediaIndexUrl' => Router::url(
                    [
                        'controller' => 'commentaries',
                        'action' => 'newsmediaIndex',
                    ],
                    true
                ),
                'date' => date('l, F jS', $timestamp)
            ]);

        $user = $this->get($user['id']);
        $user->last_alert_article_id = $commentary['id'];
        $this->save($user);

        return $email->send();
    }

    /**
     * sendNewsmediaIntroEmail method
     *
     * @param User|\Cake\Datasource\EntityInterface $user of newsmedia
     * @return array
     */
    public function sendNewsmediaIntroEmail($user)
    {
        $email = new Email('default');
        $newsmediaIndexUrl = Router::url(
            [
                'controller' => 'commentaries',
                'action' => 'newsmediaIndex',
            ],
            true
        );
        $loginUrl = Router::url(
            [
                'controller' => 'users',
                'action' => 'login'
            ],
            true
        );
        $email
                ->setTo($user['email'])
                ->setSubject('CBER Commentaries: Intro')
                ->setTemplate('newsmedia_intro')
                ->setEmailFormat('both')
                ->setHelpers(['Html', 'Text'])
                ->setViewVars(compact(
                    'user',
                    'newsmediaIndexUrl',
                    'loginUrl'
                ));

        return $email->send();
    }

    /**
     * sendPasswordResetEmail method
     *
     * @param string $userId of user who needs password reset
     * @param string $email of user who needs password reset
     * @return array
     */
    public function sendPasswordResetEmail($userId, $email)
    {
        $resetPasswordHash = $this->getResetPasswordHash($userId, $email);
        $resetEmail = new Email('default');
        $resetUrl = Router::url([
                'controller' => 'users',
                'action' => 'resetPassword',
                $userId,
                $resetPasswordHash
            ], true);
        $resetEmail
                ->setTo($email)
                ->setSubject('CBER Commentaries: Reset Password')
                ->setTemplate('forgot_password')
                ->setEmailFormat('both')
                ->setHelpers(['Html', 'Text'])
                ->setViewVars(compact(
                    'email',
                    'resetUrl'
                ));

        return $resetEmail->send();
    }
}
