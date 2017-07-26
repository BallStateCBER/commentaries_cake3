<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
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
        $this->belongsTo('LastAlertArticles', [
            'foreignKey' => 'last_alert_article_id'
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
            ->notEmpty('password');

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
        $rules->add($rules->existsIn(['last_alert_article_id'], 'LastAlertArticles'));

        return $rules;
    }
}
