<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TagsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

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
        $this->Commentaries = TableRegistry::get('Commentaries');
        $this->Users = TableRegistry::get('Users');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tags);
        unset($this->Users);
        unset($this->Commentaries);
        parent::tearDown();
    }

    /**
     * Test tag admin page
     *
     * @return void
     */
    public function testTagAdminPrivileges()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $this->get('/tags/getnodes');
        $this->assertResponseOk();
        $this->assertResponseContains('Unlisted (213)');
    }

    /**
     * Test getAllWithCounts method
     *
     * @return void
     */
    public function testGetAllWithCounts()
    {
        // looking for the tags associated with religion
        $conditions = [
            'is_published' => 1
        ];
        $counts = $this->Tags->getAllWithCounts($conditions);
        $counts = array_keys($counts);
        $counts = implode($counts);
        $this->assertContains('federal government', $counts);
        $this->assertContains('taxes', $counts);
    }

    /**
     * Test getDeleteGroupId method
     *
     * @return void
     */
    public function testGetDeleteGroupId()
    {
        $del = $this->Tags->getDeleteGroupId();
        $this->assertEquals(214, $del);
    }

    /**
     * Test getIdFromName method
     *
     * @return void
     */
    public function testGetIdFromName()
    {
        $tag = $this->Tags->getIdFromName('delete');
        $this->assertEquals(214, $tag);

        $tag = $this->Tags->getIdFromName('unlisted');
        $this->assertEquals(213, $tag);
    }

    /**
     * Test getIdFromSlug method
     *
     * @return void
     */
    public function testGetIdFromSlug()
    {
        $tag = $this->Tags->getIdFromSlug('214_delete');
        $this->assertEquals(214, $tag);

        $tag = $this->Tags->getIdFromSlug('213_unlisted');
        $this->assertEquals(213, $tag);
    }

    /**
     * Test getIndentLevel method
     *
     * @return void
     */
    public function testGetIndentLevel()
    {
        $name = '--Yelawolf';
        $level = $this->Tags->getIndentLevel($name);
        $this->assertEquals(2, $level);

        $name = 'Best Friend';
        $level = $this->Tags->getIndentLevel($name);
        $this->assertEquals(0, $level);
    }

    /**
     * Test getTagFromId method
     *
     * @return void
     */
    public function testGetTagFromId()
    {
        $tag = $this->Tags->getTagFromId(214);
        $this->assertEquals('delete', $tag->name);
    }

    /**
     * Test getUnlistedGroupId method
     *
     * @return void
     */
    public function testGetUnlistedGroupId()
    {
        $unl = $this->Tags->getUnlistedGroupId();
        $this->assertEquals(213, $unl);
    }

    /**
     * Test getUpcoming method
     *
     * @return void
     */
    public function testGetUpcoming()
    {
        $counts = $this->Tags->getUpcoming();
        $counts = array_keys($counts);
        $counts = implode($counts);

        $commentaries = $this->Commentaries->find()
            ->contain('Tags')
            ->where(['published_date >=' => date('Y-m-d')])
            ->toArray();

        foreach ($commentaries as $commentary) {
            if (isset($commentary['tags'])) {
                foreach ($commentary['tags'] as $tag) {
                    $upcoming = $tag->name;
                    $this->assertContains($upcoming, $counts);
                }
                return;
            }
        }

        $this->assertEquals($counts, null);
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
            'direction' => 'past'
        ], 'alpha');
        $counts = array_keys($counts);
        $counts = implode($counts);

        $commentaries = $this->Commentaries->find()
            ->contain('Tags')
            ->where(['published_date <' => date('Y-m-d')])
            ->toArray();

        foreach ($commentaries as $commentary) {
            if (isset($commentary['tags'])) {
                foreach ($commentary['tags'] as $tag) {
                    $upcoming = $tag->name;
                    $this->assertContains($upcoming, $counts);
                }
                return;
            }
            $this->assertEquals($counts, null);
        }
    }

    /**
     * Test isUnderUnlistedGroup method
     *
     * @return void
     */
    public function testIsUnderUnlistedGroup()
    {
        $newTag = $this->Tags->newEntity();
        $newTag->parent_id = $this->Tags->getUnlistedGroupId();
        $newTag->name = 'tester';
        $newTag->listed = 0;
        $newTag->selectable = 0;
        $this->Tags->save($newTag);

        $unl = $this->Tags->isUnderUnlistedGroup($newTag->id);
        $this->assertEquals(true, $unl);

        $this->Tags->delete($newTag);
    }
}
