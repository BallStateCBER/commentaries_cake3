<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CommentariesTags Model
 *
 * @property \App\Model\Table\CommentariesTable|\Cake\ORM\Association\BelongsTo $Commentaries
 * @property \App\Model\Table\TagsTable|\Cake\ORM\Association\BelongsTo $Tags
 *
 * @method \App\Model\Entity\CommentariesTag get($primaryKey, $options = [])
 * @method \App\Model\Entity\CommentariesTag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CommentariesTag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CommentariesTag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommentariesTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CommentariesTag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CommentariesTag findOrCreate($search, callable $callback = null, $options = [])
 */
class CommentariesTagsTable extends Table
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

        $this->setTable('commentaries_tags');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Commentaries', [
            'foreignKey' => 'commentary_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tags', [
            'foreignKey' => 'tag_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['commentary_id'], 'Commentaries'));
        $rules->add($rules->existsIn(['tag_id'], 'Tags'));

        return $rules;
    }
}
