<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentariesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentariesTable Test Case
 */
class CommentariesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentariesTable
     */
    public $Commentaries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.commentaries',
        'app.users',
        'app.tags',
        'app.commentaries_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Commentaries') ? [] : ['className' => CommentariesTable::class];
        $this->Commentaries = TableRegistry::get('Commentaries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Commentaries);

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
