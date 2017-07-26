<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentariesTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentariesTagsTable Test Case
 */
class CommentariesTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentariesTagsTable
     */
    public $CommentariesTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.commentaries_tags',
        'app.commentaries',
        'app.users',
        'app.tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CommentariesTags') ? [] : ['className' => CommentariesTagsTable::class];
        $this->CommentariesTags = TableRegistry::get('CommentariesTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommentariesTags);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
