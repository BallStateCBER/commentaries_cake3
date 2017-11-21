<?php
namespace App\Test\Fixture;

use FriendsOfCake\Fixturize\TestSuite\Fixture\ChecksumTestFixture as TestFixture;

/**
 * CommentariesTagsFixture
 *
 */
class CommentariesTagsFixture extends TestFixture
{
    /*
     * initialize fixture method
     */
    public function init()
    {
        parent::init();
        $this->records = [
            [
                'commentary_id' => 1,
                'tag_id' => 1
            ],
            [
                'commentary_id' => 1,
                'tag_id' => 4
            ],
            [
                'commentary_id' => 2,
                'tag_id' => 2
            ],
            [
                'commentary_id' => 2,
                'tag_id' => 1
            ],
            [
                'commentary_id' => 3,
                'tag_id' => 3
            ],
            [
                'commentary_id' => 3,
                'tag_id' => 1
            ],
            [
                'commentary_id' => 3,
                'tag_id' => 5
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
        'commentary_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tag_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'utf8_general_ci'
        ],
    ];
}
