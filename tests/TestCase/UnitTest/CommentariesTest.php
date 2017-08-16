<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CommentariesController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CategoriesController Test Case
 */
class CommentariesViewTest extends IntegrationTestCase
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
}
