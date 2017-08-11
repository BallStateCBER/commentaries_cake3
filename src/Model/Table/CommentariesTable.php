<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Commentaries Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TagsTable|\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Commentary get($primaryKey, $options = [])
 * @method \App\Model\Entity\Commentary newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Commentary[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Commentary|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commentary patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Commentary[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Commentary findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommentariesTable extends Table
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

        $this->setTable('commentaries');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'commentary_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'commentaries_tags'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('summary', 'create')
            ->notEmpty('summary');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');

        $validator
            ->boolean('is_published')
            ->requirePresence('is_published', 'create')
            ->notEmpty('is_published');

        $validator
            ->boolean('delay_publishing')
            ->requirePresence('delay_publishing', 'create')
            ->notEmpty('delay_publishing');

        $validator
            ->dateTime('published_date')
            ->allowEmpty('published_date');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function getUnpublishedList()
    {
        return $this->find('list')
            ->where(['is_published' => 0])
            -> order(['modified' => 'DESC']);
    }

    public function getNextForNewsmedia()
    {
        return $this->find()
            ->where(['is_published' => 0])
            ->andWhere(['delay_publishing' => 1])
            ->andWhere(['published_date >' => date('Y-m-d')])
            -> order(['published_date' => 'ASC'])
            ->first();
    }

    public function isMostRecentAlert($commentaryId)
    {
        if (empty($commentaryId)) {
            return false;
        }
        $result = $this->Users->find()
            ->where(['last_alert_article_id' => $commentaryId])
            ->count();
        return $result > 0;
    }
}
