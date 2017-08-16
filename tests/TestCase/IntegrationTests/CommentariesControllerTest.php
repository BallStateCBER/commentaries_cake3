<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CommentariesController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\TagsController Test Case
 */
class CommentariesControllerTest extends IntegrationTestCase
{
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Commentaries') ? [] : ['className' => 'App\Model\Table\CommentariesTable'];
        $this->CommentariesTags = TableRegistry::get('CommentariesTags');
        $this->Commentaries = TableRegistry::get('Commentaries', $config);
        $this->Users = TableRegistry::get('Users');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommentariesTags);
        unset($this->Commentaries);
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * testBrowse
     *
     * @return void
     */
    public function testBrowse()
    {
        $this->get('/commentaries/browse');
        $this->assertResponseOk();
        $this->assertResponseContains('Select a year');
    }


    /**
     * testIndex
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/');
        $this->assertResponseOk();
        $this->assertResponseContains('Latest Commentary');
    }

    /**
     * testNewsIndex
     *
     * @return void
     */
    public function testNewsIndex()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $this->get('/newsmedia');
        $this->assertResponseOk();
        $this->assertResponseContains('Next Article to Publish');
    }

    /**
     * testRss
     *
     * @return void
     */
    public function testRss()
    {
        $this->get('/index?ext=rss');
        $this->assertResponseOk();
        $this->assertResponseContains('00:00:00 +0000');
    }

    /**
     * testTagged
     *
     * @return void
     */
    public function testTagged()
    {
        $this->get('/tag/81');
        $this->assertResponseOk();
        $this->assertResponseContains('Commentaries tagged with');
        $this->assertResponseContains('federal government');
    }

    /**
     * testTags
     *
     * @return void
     */
    public function testTags()
    {
        $this->get('/tags');
        $this->assertResponseOk();
        $this->assertResponseContains('tag_cloud_handle');
        $this->assertResponseContains('tag_list_handle');
    }

    /**
     * testView
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/890');
        $this->assertResponseOk();
        $this->assertResponseContains('Proponents of this tax plan are knowingly disingenuous when they make the claim that the tax cuts will pay for themselves. However, opponents are equally misleading when claiming this is primarily a tax cut for the rich.');
    }
}
