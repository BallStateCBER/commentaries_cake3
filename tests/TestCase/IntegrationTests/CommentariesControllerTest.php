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
     * testAdd method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('/commentaries/add');
        $this->assertRedirect();

        $this->session($this->newsmedia);
        $this->get('/commentaries/add');
        $this->assertRedirect();

        $this->session($this->commentary);
        $this->get('/commentaries/add');
        $this->assertResponseOk();

        $commentary = [
            'user_id' => $this->commentary['Auth']['User']['id'],
            'title' => 'Lorem ipsum dolor amet aesthetic cronut kogi',
            'summary' => 'iPhone freegan literally stumptown pug hella humblebrag next level jean shorts YOLO lumbersexual typewriter',
            'published_date' => [
                'year' => date('Y'),
                'month' => date('m'),
                'day' => date('d', strtotime('+3 days'))
            ],
            'body' => '<p>Humblebrag la croix single-origin coffee cornhole, semiotics YOLO hot chicken 8-bit salvia meggings banjo tumblr wayfarers hashtag activated charcoal. Mumblecore austin banjo portland chartreuse butcher adaptogen cronut shaman pitchfork ennui before they sold out wolf craft beer. Poutine ugh locavore, disrupt vaporware hammock offal you probably haven\'t heard of them street art blog af whatever. Salvia tote bag cornhole aesthetic YOLO skateboard deep v, gochujang truffaut woke single-origin coffee godard leggings. Tousled direct trade cold-pressed XOXO man braid stumptown DIY kombucha bushwick YOLO pitchfork. Pickled tote bag hoodie tumblr, craft beer man braid tofu freegan VHS disrupt.</p>',
            'is_published' => 1
        ];

        $this->post('/commentaries/add', $commentary);

        $this->assertResponseContains('has been saved.');
        $added = $this->Commentaries->find()
            ->where(['title' => $commentary['title']])
            ->firstOrFail();

        $this->assertEquals($commentary['title'], $added['title']);
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
     * testDelete method
     *
     * @return void
     */
    public function testDelete()
    {
        $commentary = $this->commentaries['0'];
        $this->get('/commentaries/delete/' . $commentary['id']);
        $deleted = $this->Commentaries->find()->where(['id' => $commentary['id']])->first();
        if ($deleted) {
            $this->assertRedirect();
        }

        $this->session($this->newsmedia);
        $this->get('/commentaries/delete/' . $commentary['id']);
        $deleted = $this->Commentaries->find()->where(['id' => $commentary['id']])->first();
        if ($deleted) {
            $this->assertRedirect();
        }

        $this->session($this->commentary);
        $this->get('/commentaries/delete/' . $commentary['id']);
        $deleted = $this->Commentaries->find()->where(['id' => $commentary['id']])->first();
        if ($deleted) {
            $this->assertResponseContains('has been deleted');
        }
    }

    /**
     * testDrafts method
     *
     * @return void
     */
    public function testDrafts()
    {
        $this->get('/drafts');
        $this->assertRedirect();

        $this->session($this->newsmedia);
        $this->get('/drafts');
        $this->assertRedirect();

        $this->session($this->commentary);
        $this->get('/drafts');

        $draft = $this->Commentaries->find()->where(['delay_publishing' => 1])->first();
        $this->assertResponseContains($draft['title']);
    }

    /**
     * testEdit method
     *
     * @return void
     */
    public function testEdit()
    {
        $commentary = $this->commentaries['0'];
        $this->get('/commentaries/edit/' . $commentary['id']);
        $this->assertRedirect();

        $this->session($this->newsmedia);
        $this->get('/commentaries/edit/' . $commentary['id']);
        $this->assertRedirect();

        $this->session($this->commentary);
        $this->get('/commentaries/edit/' . $commentary['id']);
        $this->assertResponseOk();

        $newCommentary = [
            'user_id' => $this->commentary['Auth']['User']['id'],
            'title' => 'Lorem ipsum dolor amet aesthetic cronut kogi',
            'summary' => 'iPhone freegan literally stumptown pug hella humblebrag next level jean shorts YOLO lumbersexual typewriter',
            'published_date' => [
                'year' => date('Y'),
                'month' => date('m'),
                'day' => date('d', strtotime('+3 days'))
            ],
            'body' => '<p>Humblebrag la croix single-origin coffee cornhole, semiotics YOLO hot chicken 8-bit salvia meggings banjo tumblr wayfarers hashtag activated charcoal. Mumblecore austin banjo portland chartreuse butcher adaptogen cronut shaman pitchfork ennui before they sold out wolf craft beer. Poutine ugh locavore, disrupt vaporware hammock offal you probably haven\'t heard of them street art blog af whatever. Salvia tote bag cornhole aesthetic YOLO skateboard deep v, gochujang truffaut woke single-origin coffee godard leggings. Tousled direct trade cold-pressed XOXO man braid stumptown DIY kombucha bushwick YOLO pitchfork. Pickled tote bag hoodie tumblr, craft beer man braid tofu freegan VHS disrupt.</p>',
            'is_published' => 1
        ];

        $this->post('/commentaries/edit/' . $commentary['id'], $newCommentary);

        $this->assertResponseContains('has been saved.');
        $added = $this->Commentaries->find()
            ->where(['title' => $newCommentary['title']])
            ->firstOrFail();

        $this->assertEquals($newCommentary['title'], $added['title']);
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
        $this->get('/newsmedia');
        $this->assertRedirect('/login?redirect=%2Fnewsmedia');

        $this->session($this->newsmedia);
        $this->get('/newsmedia');
        $this->assertResponseContains($this->commentaries[2]['body']);
        $this->assertResponseContains($this->commentaries[2]['title']);
    }

    /**
     * testRssIndex method
     *
     * @return void
     */
    public function testRssIndex()
    {
        $this->get('/index');
        $this->assertResponseOk();
        $this->assertResponseContains($this->commentaries[0]['title']);
    }

    /**
     * testTagged method
     *
     * @return void
     */
    public function testTagged()
    {
        $this->get('/tag/2');
        $this->assertResponseOk();
        $this->assertResponseContains($this->commentaries[1]['title']);
        $this->assertResponseContains($this->tags[2]['name']);
    }

    /**
     * testTags method
     *
     * @return void
     */
    public function testTags()
    {
        $this->get('/tags');
        $this->assertResponseOk();
        foreach ($this->tags as $tag) {
            $count = $this->CommentariesTags->find()
                ->where(['tag_id' => $tag['id']])
                ->count();

            $this->assertResponseContains($tag['name']);
            $this->assertResponseContains("$count");
        }
    }

    /**
     * testView method
     *
     * @return void
     */
    public function testView()
    {
        $commentary = $this->Commentaries->get(1);
        $this->get("/1/$commentary->slug");
        $this->assertResponseOk();
        $this->assertResponseContains($this->commentaries[0]['body']);
        $this->assertResponseContains($this->commentaries[0]['title']);
    }
}
