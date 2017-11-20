<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Commentaries Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TagsTable|\Cake\ORM\Association\BelongsToMany $Tags
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
        $this->addBehavior('Muffin/Slug.Slug', [
            // Optionally define your custom options here (see Configuration)
        ]);

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

    /**
     * getUnpublishedList method
     *
     * @return array of the unpublished
     */
    public function getUnpublishedList()
    {
        return $this->find('list')
            ->where(['is_published' => 0])
            ->order(['modified' => 'DESC'])
            ->toArray();
    }

    /**
     * getNextForNewsmedia method
     *
     * @return array|\Cake\Datasource\EntityInterface|null of next for newsmedia
     */
    public function getNextForNewsmedia()
    {
        return $this->find()
            ->where(['is_published' => 0])
            ->andWhere(['delay_publishing' => 1])
            ->andWhere(['published_date >' => date('Y-m-d')])
            ->order(['published_date' => 'ASC'])
            ->first();
    }

    /**
     * isMostRecentAlert method
     *
     * @param int $commentaryId of commentary
     * @return bool was it most recent alert?
     */
    public function isMostRecentAlert($commentaryId)
    {
        if (!isset($commentaryId)) {
            return false;
        }
        $result = $this->Users->find()
            ->where(['last_alert_article_id' => $commentaryId])
            ->count();

        return $result > 0;
    }
}
