<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tag Entity
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property bool $selectable
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ParentTag $parent_tag
 * @property \App\Model\Entity\ChildTag[] $child_tags
 * @property \App\Model\Entity\Commentary[] $commentaries
 */
class Tag extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
