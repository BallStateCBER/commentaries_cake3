<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Aros Model
 *
 * @property \App\Model\Table\ArosTable|\Cake\ORM\Association\BelongsTo $ParentAros
 * @property \App\Model\Table\ArosTable|\Cake\ORM\Association\HasMany $ChildAros
 * @property \App\Model\Table\AcosTable|\Cake\ORM\Association\BelongsToMany $Acos
 *
 * @method \App\Model\Entity\Aro get($primaryKey, $options = [])
 * @method \App\Model\Entity\Aro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Aro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Aro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Aro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Aro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class ArosTable extends Table
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

        $this->setTable('aros');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('ParentAros', [
            'className' => 'Aros',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildAros', [
            'className' => 'Aros',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Acos', [
            'foreignKey' => 'aro_id',
            'targetForeignKey' => 'aco_id',
            'joinTable' => 'aros_acos'
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
            ->allowEmpty('model');

        $validator
            ->integer('foreign_key')
            ->allowEmpty('foreign_key');

        $validator
            ->allowEmpty('alias');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentAros'));

        return $rules;
    }
}
