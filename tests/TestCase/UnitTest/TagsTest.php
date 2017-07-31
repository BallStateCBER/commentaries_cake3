<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CategoriesController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

/**
 * App\Controller\CategoriesController Test Case
 */
class TagsViewTest extends IntegrationTestCase
{
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tags') ? [] : ['className' => 'App\Model\Table\TagsTable'];
        $this->Tags = TableRegistry::get('Tags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tags);
        parent::tearDown();
    }

    /**
     * Test tag admin page
     *
     * @return void
     */
    public function testTagAdminPrivileges()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/tags/getnodes');
        $this->assertResponseOk();
        $this->assertResponseContains('Unlisted (1012)');
    }
}
