<?php
namespace App\Test\TestCase\Controller;

use App\Test\TestCase\ApplicationTest;

class CommentariesTableTest extends ApplicationTest
{
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
     * Test getUnpublishedList method
     *
     * @return void
     */
    public function testGetUnpublishedList()
    {
        $unpublished = $this->Commentaries->getUnpublishedList();
        $unpublished = array_keys($unpublished);
        $unpublished = implode($unpublished);
        $this->assertEquals(3, $unpublished);
    }

    /**
     * Test getNextForNewsmedia method
     *
     * @return void
     */
    public function testGetNextForNewsmedia()
    {
        $upNext = $this->Commentaries->getNextForNewsmedia();
        $comingSoon = $this->Commentaries->get(3);
        $this->assertEquals($upNext, $comingSoon);
    }

    /**
     * Test isMostRecentAlert method
     *
     * @return void
     */
    public function testIsMostRecentAlert()
    {
        $upNext = $this->Commentaries->isMostRecentAlert(3);
        $this->assertEquals($upNext, false);
    }
}
