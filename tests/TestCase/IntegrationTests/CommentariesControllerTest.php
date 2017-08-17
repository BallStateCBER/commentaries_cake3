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

    /**
     * testAdd
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('/commentaries/add');
        $this->assertRedirect();

        $id = $this->Users->getIdFromEmail('cberdirector@bsu.edu');
        $this->session(['Auth.User.id' => $id]);
        $this->get('/commentaries/add');

        $commentary = [
            'user_id' => 8,
            'title' => 'Placeholder Commentary',
            'summary' => 'This is the placeholder summary.',
            'published_date' => [
                'year' => date('Y'),
                'month' => date('m', strtotime('+1 month')),
                'day' => date('d')
            ],
            'body' => 'Placeholder text can be really hard to come up with, but at what cost to society <i>is</i> placeholder text? According to my estimates, Erica has probably earned a total of twenty-five cents writing this placeholder text.',
            'is_published' => 1
        ];

        $this->post('/commentaries/add', $commentary);
        $this->assertResponseOk();
        $this->assertResponseContains('The commentary has been saved.');

        $exists = $this->Commentaries->find()
            ->where(['title' => 'Placeholder Commentary'])
            ->first();

        if ($exists->slug) {
            $this->assertResponseOk();
        }
    }

    /**
     * testDrafts
     *
     * @return void
     */
    public function testDrafts()
    {
        $id = $this->Users->getIdFromEmail('cberdirector@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $this->get('/commentaries/drafts');
        $this->assertResponseContains('Placeholder Commentary');
    }

    /**
     * testEdit
     *
     * @return void
     */
    public function testEdit()
    {
        $exists = $this->Commentaries->find()
            ->where(['title' => 'Placeholder Commentary'])
            ->first();

        $this->get("/commentaries/edit/$exists->id");
        $this->assertRedirect();

        $id = $this->Users->getIdFromEmail('cberdirector@bsu.edu');
        $this->session(['Auth.User.id' => $id]);
        $this->get("/commentaries/edit/$exists->id");

        $commentary = [
            'user_id' => 8,
            'title' => 'Placeholder Article',
            'summary' => 'This is the placeholder summary.',
            'published_date' => [
                'year' => date('Y'),
                'month' => date('m'),
                'day' => date('d')
            ],
            'body' => 'Placeholder text can be really hard to come up with, but at what cost to society <i>is</i> placeholder text? According to my estimates, Erica has probably earned a total of twenty-five cents writing this placeholder text.',
            'is_published' => 1
        ];

        $this->post("/commentaries/edit/$exists->id", $commentary);
        $this->assertResponseOk();
        $this->assertResponseContains('The commentary has been saved.');

        $exists = $this->Commentaries->find()
            ->where(['title' => 'Placeholder Article'])
            ->first();

        if ($exists->slug) {
            $this->assertResponseOk();
        }
    }

    /**
     * testDelete
     *
     * @return void
     */
    public function testDelete()
    {
        $id = $this->Users->getIdFromEmail('cberdirector@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $commentary = $this->Commentaries->find()
            ->where(['title' => 'Placeholder Article'])
            ->first();

        $this->post("/commentaries/delete/$commentary->id");
        $this->assertResponseSuccess();
    }
}
