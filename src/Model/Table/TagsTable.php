<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Tags Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentTags
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $ChildTags
 * @property \Cake\ORM\Association\BelongsToMany $Commentaries
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class TagsTable extends Table
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

        $this->setTable('tags');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentTags', [
            'className' => 'Tags',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('ChildTags', [
            'className' => 'Tags',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Commentaries', [
            'foreignKey' => 'tag_id',
            'targetForeignKey' => 'commentary_id',
            'joinTable' => 'commentaries_tags'
        ]);

        $this->CommentariesTags = TableRegistry::get('CommentariesTags');
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
            ->allowEmpty('name');

        $validator
            ->boolean('selectable')
            ->requirePresence('selectable', 'create')
            ->notEmpty('selectable');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentTags'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    /**
     * getAllWithCounts method
     *
     * @param array $conditions to get counts of
     * @return array of tags
     */
    public function getAllWithCounts($conditions)
    {
        $results = $this->Commentaries->find()
            ->select('id')
            ->where($conditions)
            ->contain('Tags')
            ->toArray();

        $tags = [];
        foreach ($results as $result) {
            foreach ($result['tags'] as $tag) {
                if (isset($tags[$tag['name']])) {
                    $tags[$tag['name']]['count']++;
                    continue;
                }
                $tags[$tag['name']] = [
                    'id' => $tag['id'],
                    'name' => $tag['name'],
                    'count' => 1
                ];
            }
        }
        ksort($tags);

        return $tags;
    }

    /**
     * getIdFromName method
     *
     * @param string $name of tag
     * @return bool|mixed of id
     */
    public function getIdFromName($name)
    {
        $result = $this->find()
            ->select('id')
            ->where(['name' => strtolower($name)])
            ->first();
        if (empty($result)) {
            return false;
        }

        return $result->id;
    }

    /**
     * getIdFromSlug methpod
     *
     * @param string $slug of tag
     * @return int of id
     */
    public function getIdFromSlug($slug)
    {
        $splitSlug = explode('_', $slug);

        return (int) $splitSlug[0];
    }

    /**
     * getUpcoming tags
     *
     * @param array $filter out for future tags
     * @return array|mixed getWithCounts method
     */
    public function getUpcoming($filter = [])
    {
        $filter['direction'] = 'future';

        return $this->getWithCounts($filter);
    }

    /**
     * getUsedTagIds method
     *
     * @return array $retval
     */
    public function getUsedTagIds()
    {
        $results = $this->CommentariesTags->find('all')
                    ->select(['tag_id'])
                    ->distinct(['tag_id'])
                    ->order(['tag_id' => 'ASC'])
                    ->toArray();
        $retval = [];
        foreach ($results as $result) {
            $retval[] = $result->tag_id;
        }

        return $retval;
    }

    /**
     * getWithCounts method
     *
     * @param array $filter through the tags
     * @param string $sort by alpha
     * @return array|mixed $tags or $finalTags
     */
    public function getWithCounts($filter = [], $sort = 'alpha')
    {
        // Apply filters and find tags
        $conditions = ['Commentaries.is_published' => 1];
        if ($filter['direction'] == 'future') {
            $conditions['Commentaries.published_date >='] = date('Y-m-d');
        } elseif ($filter['direction'] == 'past') {
            $conditions['Commentaries.published_date <'] = date('Y-m-d');
        }

        $tags = $this->getAllWithCounts($conditions);
        if (empty($tags)) {
            return [];
        }

        if ($sort == 'alpha') {
            return $tags;
        }

        // Sort by count if $sort is not 'alpha'
        $sortedTags = [];
        foreach ($tags as $tag) {
            $sortedTags[$tag['count']][$tag['name']] = $tag;
        }
        krsort($sortedTags);
        $finalTags = [];
        foreach ($sortedTags as $tags) {
            foreach ($tags as $tag) {
                $finalTags[$tag['name']] = $tag;
            }
        }

        return $finalTags;
    }
}
