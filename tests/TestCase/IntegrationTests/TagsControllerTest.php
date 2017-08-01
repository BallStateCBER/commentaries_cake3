<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TagsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

/**
 * App\Controller\TagsController Test Case
 */
class TagsControllerTest extends IntegrationTestCase
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
        $this->CommentariesTags = TableRegistry::get('CommentariesTags');
        $this->Tags = TableRegistry::get('Tags', $config);
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
        unset($this->Tags);
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test adding tags
     *
     * @return void
     */
    public function testAddingTags()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $this->get('/tags/manage');
        $this->assertResponseOk();
        $this->assertResponseContains('Manage Tags');

        $newTag = [
            'name' => "Lourdes\n-Soothsayer Lies",
            'parent_name' => 'Walmart'
        ];

        $this->post('/tags/add', $newTag);

        $this->assertResponseSuccess();

        $newTag = $this->Tags->find()
            ->where(['name' => 'lourdes'])
            ->andWhere(['parent_id' => 16])
            ->firstOrFail();

        $newChild = $this->Tags->find()
            ->where(['name' => 'soothsayer lies'])
            ->andWhere(['parent_id' => $newTag->id])
            ->firstOrFail();

        if ($newTag->name == 'lourdes' && $newChild->name == 'soothsayer lies') {
            return;
        }

        $this->assertResponseError();
    }

    /**
     * Test adding a tag that already exists
     *
     * @return void
     */
    public function testAddingExistingTag()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $this->get('/tags/manage');
        $this->assertResponseOk();
        $this->assertResponseContains('Manage Tags');

        $newTag = [
            'name' => "Lourdes\n-Soothsayer Lies",
            'parent_name' => 'Walmart'
        ];

        $this->post('/tags/add', $newTag);

        $tags = $this->Tags->find()
            ->where(['name' => 'lourdes'])
            ->orWhere(['name' => 'soothsayer lies'])
            ->count();

        if ($tags == 2) {
            $this->assertResponseSuccess();
            return;
        }

        $this->assertResponseError();
    }

    /**
     * Test editing tags
     *
     * @return void
     */
    public function testEditingTags()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $oldTag = $this->Tags->find()
            ->where(['name' => 'lourdes'])
            ->first();

        $this->session(['Auth.User.id' => $id]);

        $this->get("/tags/edit/lourdes");
        $this->assertResponseSuccess();

        $edits = [
            'name' => 'We the Heathens',
            'selectable' => 1,
            'parent_id' => 160,
            'id' => $oldTag->id
        ];

        $this->post('/tags/edit/lourdes', $edits);

        $this->assertResponseSuccess();
    }

    /**
     * Test merging tags
     *
     * @return void
     */
    public function testMergingTags()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $oldTag = $this->Tags->find()
            ->where(['name' => 'soothsayer lies'])
            ->first();
        $newTag = $this->Tags->find()
            ->where(['name' => 'we the heathens'])
            ->first();

        $decoyJoin = $this->CommentariesTags->newEntity();
        $decoyJoin->commentary_id = 12;
        $decoyJoin->tag_id = $oldTag->id;
        if ($this->CommentariesTags->save($decoyJoin)) {
            $this->post("/tags/merge/$oldTag->name/$newTag->name");
        };

        $newJoin = $this->CommentariesTags->find()
            ->where(['commentary_id' => 12])
            ->andWhere(['tag_id' => $newTag->id])
            ->firstOrFail();

        if (isset($newJoin)) {
            $this->assertResponseSuccess();
            $this->CommentariesTags->delete($newJoin);
        }
    }

    /**
     * Test regrouping rogue/unlisted tags
     *
     * @return void
     */
    public function testRegroupingOrphanTags()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        for ($x = 0; $x <= 10; $x++) {
            $orphanTag = $this->Tags->newEntity([
                'name' => 'nobody loves me',
                'selectable' => 0
            ]);
            $this->Tags->save($orphanTag);
        }

        $this->get('/tags/group-unlisted');
        $this->assertResponseOk();

        $adoptedTag = $this->Tags->find()
            ->where(['name' => 'nobody loves me'])
            ->andWhere(['parent_id' => 213])
            ->toArray();

        if ($adoptedTag) {
            $this->assertResponseSuccess();
            foreach ($adoptedTag as $tag) {
                $tag->parent_id = null;
                $this->Tags->save($tag);
            }
            return;
        }

        $this->assertResponseError();
    }

    /**
     * Test recovering tag tree structure
     *
     * @return void
     */
    public function testTagTreeRecovery()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);
        $this->get('/tags/recover');
        $this->assertResponseOk();
    }

    /**
     * Test the removeUnlistedUnused() action
     *
     * @return void
     */
    public function testRemovingUnusedTags()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $this->get('/tags/remove-unlisted-unused');
        $this->assertResponseOk();

        $deadTag = $this->Tags->find()
            ->where(['name' => 'Nobody loves me'])
            ->first();

        $this->assertResponseOk();

        if (isset($deadTag)) {
            $this->assertResponseError();
        }
    }

    /**
     * Test merging duplicates
     *
     * @return void
     */
    public function testDealingWithDuplicates()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        for ($x = 0; $x <= 10; $x++) {
            $duplicate = $this->Tags->newEntity([
                'name' => 'nobody loves me',
                'selectable' => 0
            ]);
            $this->Tags->save($duplicate);
        }

        $this->get('/tags/duplicates');
        $this->assertResponseOk();

        $duplicates = $this->Tags->find()
            ->where(['name' => 'nobody loves me'])
            ->count();

        if ($duplicates != 1) {
            $this->assertResponseError();
        }
    }

    /**
     * Test removing broken associations
     *
     * @return void
     */
    public function testRemovingBrokenAssociations()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $broken = $this->CommentariesTags->newEntity();
        $broken->commentary_id = 99999;
        $broken->tag_id = 99999;
        $this->CommentariesTags->save($broken);

        $this->get('/tags/remove-broken-associations');
        $this->assertResponseOk();

        $broken = $this->CommentariesTags->find()
            ->where(['commentary_id' => 99999])
            ->count();

        if ($broken > 0) {
            $this->assertResponseError();
        }
    }

    /**
     * Test deleting tags
     *
     * @return void
     */
    public function testDeletingTags()
    {
        $id = $this->Users->getIdFromEmail('edfox@bsu.edu');
        $this->session(['Auth.User.id' => $id]);

        $this->get("/tags/remove/we%20the%20heathens");
        $this->assertResponseSuccess();

        $newTag = $this->Tags->find()
            ->where(['name' => 'we the heathens'])
            ->orWhere(['name' => 'soothsayer lies'])
            ->first();

        if (!isset($newTag->name)) {
            $this->assertResponseSuccess();
            $this->get("/tags/remove/nobody%20loves%20me");
            $this->assertResponseSuccess();
            return;
        }

        $this->assertResponseError();
    }
}
