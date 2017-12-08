<?php
namespace App\Test\TestCase\Controller;

use App\Test\TestCase\ApplicationTest;

class CommentariesControllerTest extends ApplicationTest
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
     * testBrowse method
     *
     * @return void
     */
    public function testBrowse()
    {
        $this->get('/commentaries/browse');

        $this->assertResponseOk();
        $this->assertResponseContains(date('Y'));
        $this->assertResponseContains($this->commentaries[0]['title']);
    }

    /**
     * testIndex method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/');
        $this->assertResponseOk();
        $this->assertResponseContains($this->commentaries[0]['body']);
        $this->assertResponseContains($this->commentaries[0]['title']);
    }

    /**
     * testNewsmediaIndex method
     *
     * @return void
     */
    public function testNewsmediaIndex()
    {
        $this->get('/');
        $this->assertResponseOk();
        $this->assertResponseContains($this->commentaries[0]['body']);
        $this->assertResponseContains($this->commentaries[0]['title']);
    }
}
