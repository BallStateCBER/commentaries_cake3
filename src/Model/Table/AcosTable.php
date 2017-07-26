<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Acos Model
 *
 * @property \App\Model\Table\AcosTable|\Cake\ORM\Association\BelongsTo $ParentAcos
 * @property \App\Model\Table\AcosTable|\Cake\ORM\Association\HasMany $ChildAcos
 * @property \App\Model\Table\ArosTable|\Cake\ORM\Association\BelongsToMany $Aros
 *
 * @method \App\Model\Entity\Aco get($primaryKey, $options = [])
 * @method \App\Model\Entity\Aco newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Aco[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Aco|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Aco[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Aco findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class AcosTable extends Table
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

        $this->setTable('acos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('ParentAcos', [
            'className' => 'Acos',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildAcos', [
            'className' => 'Acos',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Aros', [
            'foreignKey' => 'aco_id',
            'targetForeignKey' => 'aro_id',
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
        $rules->add($rules->existsIn(['parent_id'], 'ParentAcos'));

        return $rules;
    }
}
