<?php
namespace App\Test\Fixture;

use FriendsOfCake\Fixturize\TestSuite\Fixture\ChecksumTestFixture as TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
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
                'name' => 'Addy Admin',
                'email' => 'admin@bsu.edu',
                'password' => '$2y$10$kLAsD6QwhXLBfotThN6fOOVJ7RH2j.ea1WMrK0oXAN5yRwpKc/FJq',
                'active' => 1,
                'group_id' => 1,
                'author' => 1,
                'picture' => 'Lorem ipsum dolor sit amet',
                'nm_email_alerts' => 1,
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
            [
                'id' => 2,
                'name' => 'Commentary Connie',
                'email' => 'commentary@bsu.edu',
                'password' => '$2y$10$Y8sW3EGZ47sIibABaGQmze7n4iHjNTdeM8YAzep0Pa0Bfq6ZBs2ca',
                'active' => 1,
                'group_id' => 2,
                'author' => 1,
                'picture' => 'Lorem ipsum dolor sit amet',
                'nm_email_alerts' => 1,
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
            [
                'id' => 3,
                'name' => 'Newsie Newsmedia',
                'email' => 'newsmedia@bsu.edu',
                'password' => 'ff55435345834a3fe224936776c2aa15f6ed5358',
                'active' => 1,
                'group_id' => 3,
                'author' => 0,
                'picture' => 'Lorem ipsum dolor sit amet',
                'nm_email_alerts' => 1,
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ]
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
        'email' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'bio' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'sex' => ['type' => 'string', 'length' => 1, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 64, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'group_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'author' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'picture' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'nm_email_alerts' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'last_alert_article_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'email_UNIQUE' => ['type' => 'unique', 'columns' => ['email'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'utf8_general_ci'
        ],
    ];
}
