<?php
namespace App\Test\TestCase\Controller;

use App\Test\TestCase\ApplicationTest;

class TagsControllerTest extends ApplicationTest
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
     * test autocomplete method for tags
     *
     * @return void
     */
    public function testTagAutocomplete()
    {
        $this->get('/tags/autoComplete/0/0?term=blvck');
        $this->assertResponseOk();
        $this->assertResponseContains('"label":"blvck ceiling"');
    }
    /**
     * Test adding, editing, and deleting tags
     *
     * @return void
     */
    public function testTagLifecycle()
    {
        $this->session($this->admin);
        $this->get('/tags/manage');
        $this->assertResponseOk();
        $this->assertResponseContains('Manage Tags');
        $newTag = [
            'name' => "Lourdes\nSoothsayer Lies",
        ];
        $this->post('/tags/add', $newTag);
        $this->assertResponseSuccess();
        $newTag = $this->Tags->find()
            ->where(['name' => 'lourdes'])
            ->firstOrFail();
        $newChild = $this->Tags->find()
            ->where(['name' => 'soothsayer lies'])
            ->firstOrFail();
        if ($newTag['name'] == 'lourdes' && $newChild['name'] == 'soothsayer lies') {
            return;
        }
        $this->assertResponseError();

        /**
         * Test adding a tag that already exists
         */

        $this->get('/tags/manage');
        $this->assertResponseOk();
        $this->assertResponseContains('Manage Tags');
        $newTag = [
            'name' => "Lourdes\nSoothsayer Lies"
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

        /**
         * Test editing tags
         */

        $oldTag = $this->Tags->find()
            ->where(['name' => 'lourdes'])
            ->first();
        $this->get("/tags/edit/lourdes");
        $this->assertResponseSuccess();
        $edits = [
            'name' => 'We the Heathens',
            'listed' => 1,
            'selectable' => 1,
            'id' => $oldTag->id
        ];
        $this->post('/tags/edit/lourdes', $edits);
        $this->assertResponseSuccess();

        /**
         * Test merging tags
         */

        $oldTag = $this->Tags->find()
            ->where(['name' => 'soothsayer lies'])
            ->first();
        $newTag = $this->Tags->find()
            ->where(['name' => 'we the heathens'])
            ->first();
        $decoyJoin = $this->CommentariesTags->newEntity();
        $decoyJoin->commentary_id = 1;
        $decoyJoin->tag_id = $oldTag->id;
        if ($this->CommentariesTags->save($decoyJoin)) {
            $oldName = $oldTag['name'];
            $newName = $newTag['name'];
            $this->post("/tags/merge/$oldName/$newName");
        };
        $newJoin = $this->CommentariesTags->find()
            ->where(['commentary_id' => 1])
            ->andWhere(['tag_id' => $newTag->id])
            ->firstOrFail();
        if (isset($newJoin)) {
            $this->assertResponseSuccess();
            $this->CommentariesTags->delete($newJoin);
        }

        /**
         * Test deleting tags
         */

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

    /**
     * Test tag fixing functions
     *
     * @return void
     */
    public function testFixingTagFunctions()
    {
        $this->session($this->admin);

        /**
         * Test recovering tag tree structure
         */

        $this->get('/tags/recover');
        $this->assertResponseOk();

        /**
         * Test merging duplicates
         */

        for ($x = 0; $x <= 10; $x++) {
            $duplicate = $this->Tags->newEntity([
                'name' => 'nobody loves me',
                'listed' => 0,
                'selectable' => 0,
                'user_id' => 1
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

        /**
         * Test removing broken associations
         */

        $broken = $this->CommentariesTags->newEntity();
        $broken->commentary_id = 99999;
        $broken->tag_id = 99999;
        $this->CommentariesTags->save($broken);
        $this->get('/tags/remove-broken-associations');
        $this->assertResponseOk();
        $this->assertResponseContains('Removed associations');
        $broken = $this->CommentariesTags->find()
            ->where(['commentary_id' => 99999])
            ->count();
        if ($broken > 0) {
            $this->assertResponseError();
        }
    }
}
