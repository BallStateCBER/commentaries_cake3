<?php
namespace App\Test\Fixture;

use FriendsOfCake\Fixturize\TestSuite\Fixture\ChecksumTestFixture as TestFixture;

/**
 * GroupsFixture
 *
 */
class GroupsFixture extends TestFixture
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
                'name' => 'Administrators',
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
            [
                'id' => 2,
                'name' => 'Commentary authors',
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
            [
                'id' => 3,
                'name' => 'Newsmedia',
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
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
}
