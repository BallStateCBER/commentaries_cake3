<?php
namespace App\Test\Fixture;

use FriendsOfCake\Fixturize\TestSuite\Fixture\ChecksumTestFixture as TestFixture;

/**
 * TagsFixture
 *
 */
class TagsFixture extends TestFixture
{
    /*
     * initialize fixture method
     */
    public function init()
    {
        parent::init();
        $this->records = [
            [
                'id' => 1,
                'name' => 'blvck ceiling',
                'parent_id' => null,
                'lft' => 1,
                'rght' => 2,
                'selectable' => 1,
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
            [
                'id' => 2,
                'name' => 'alice glass',
                'parent_id' => null,
                'lft' => 3,
                'rght' => 4,
                'selectable' => 1,
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
            [
                'id' => 3,
                'name' => 'darkwave',
                'parent_id' => null,
                'lft' => 5,
                'rght' => 6,
                'selectable' => 1,
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
            [
                'id' => 4,
                'name' => 'witch house',
                'parent_id' => null,
                'lft' => 7,
                'rght' => 8,
                'selectable' => 1,
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
            [
                'id' => 5,
                'name' => 'rvstbelt',
                'parent_id' => null,
                'lft' => 9,
                'rght' => 10,
                'selectable' => 1,
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
        ];
    }

    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'parent_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'lft' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rght' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'selectable' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'utf8_general_ci'
        ],
    ];
}
