<?php
namespace App\Test\TestCase\Controller;

use App\Test\TestCase\ApplicationTest;

class TagsTableTest extends ApplicationTest
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TagsTable
     */
    public $Tags;
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }
    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }
    /**
     * Test getAllWithCounts method
     *
     * @return void
     */
    public function testGetAllWithCounts()
    {
        // looking for the tags associated with arts
        $conditions = [
            'user_id' => 1
        ];
        $counts = $this->Tags->getAllWithCounts($conditions);
        $counts = array_keys($counts);
        $counts = implode($counts);
        $this->assertContains('alice glass', $counts);
    }
    /**
     * Test getIdFromName method
     *
     * @return void
     */
    public function testGetIdFromName()
    {
        $tag = $this->Tags->getIdFromName('alice glass');
        $this->assertEquals(2, $tag);
        $tag = $this->Tags->getIdFromName('blvck ceiling');
        $this->assertEquals(1, $tag);
    }
    /**
     * Test getIdFromSlug method
     *
     * @return void
     */
    public function testGetIdFromSlug()
    {
        $tag = $this->Tags->getIdFromSlug('1_blvck_ceiling');
        $this->assertEquals(1, $tag);
        $tag = $this->Tags->getIdFromSlug('2_alice_glass');
        $this->assertEquals(2, $tag);
    }
    /**
     * Test getUpcoming method
     *
     * @return void
     */
    public function testGetUpcoming()
    {
        $counts = $this->Tags->getUpcoming(['direction' => 'future']);
        $counts = array_keys($counts);
        $this->assertEquals($counts, ['alice glass', 'blvck ceiling']);
    }
    /**
     * Test getUsedTagIds method
     *
     * @return void
     */
    public function testGetUsedTagIds()
    {
        $used = $this->Tags->getUsedTagIds();
        $used = implode(',', $used);
        $this->assertContains('1', $used);
    }
    /**
     * Test getWithCounts method
     *
     * @return void
     */
    public function testGetWithCounts()
    {
        $counts = $this->Tags->getWithCounts([
            'direction' => 'future'
        ], 'alpha');
        $counts = array_keys($counts);
        $this->assertEquals($counts, ['alice glass', 'blvck ceiling']);
    }
}
