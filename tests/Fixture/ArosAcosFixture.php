<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArosAcosFixture
 *
 */
class ArosAcosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'aro_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'aco_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_create' => ['type' => 'string', 'fixed' => true, 'length' => 2, 'null' => false, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_read' => ['type' => 'string', 'fixed' => true, 'length' => 2, 'null' => false, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_update' => ['type' => 'string', 'fixed' => true, 'length' => 2, 'null' => false, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_delete' => ['type' => 'string', 'fixed' => true, 'length' => 2, 'null' => false, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'aro_id' => 1,
            'aco_id' => 1,
            '_create' => '',
            '_read' => '',
            '_update' => '',
            '_delete' => ''
        ],
    ];
}
