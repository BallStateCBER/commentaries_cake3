<?php
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Routing\Router;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsTo $Groups
 * @property \App\Model\Table\LastAlertArticlesTable|\Cake\ORM\Association\BelongsTo $LastAlertArticles
 * @property \App\Model\Table\CommentariesTable|\Cake\ORM\Association\HasMany $Commentaries
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
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
            ->requirePresence('bio', 'create')
            ->notEmpty('bio');

        $validator
            ->allowEmpty('sex');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty(['password', 'confirm_password'])
            ->add('confirm_password', [
                'compare' => [
                    'rule' => ['compareWith', 'password'],
                    'message' => 'Your passwords do not match.'
                ]
            ]);

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->boolean('author')
            ->requirePresence('author', 'create')
            ->notEmpty('author');

        $validator
            ->requirePresence('picture', 'create')
            ->notEmpty('picture');

        $validator
            ->boolean('nm_email_alerts')
            ->requirePresence('nm_email_alerts', 'create')
            ->notEmpty('nm_email_alerts');

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

    public function cleanEmail($email)
    {
        $email = trim($email);
        $email = strtolower($email);
        return $email;
    }

    public function getResetPasswordHash($userId, $email)
    {
        $salt = Configure::read('security_salt');
        $month = date('my');
        return md5($userId.$email.$salt.$month);
    }

    public function getUserIdWithEmail($email)
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
                ->setSubject('Muncie Events: Reset Password')
                ->template('forgot_password')
                ->emailFormat('both')
                ->helpers(['Html', 'Text'])
                ->viewVars(compact(
                    'email',
                    'resetUrl'
                ));
        return $resetEmail->send();
    }
}
