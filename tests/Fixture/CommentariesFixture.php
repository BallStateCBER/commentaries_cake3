<?php
namespace App\Test\Fixture;

use FriendsOfCake\Fixturize\TestSuite\Fixture\ChecksumTestFixture as TestFixture;

/**
 * CommentariesFixture
 *
 */
class CommentariesFixture extends TestFixture
{
    /*
     * initialize fixture method
     */
    public function init()
    {
        parent::init();
        $this->records = [
            [
                'id' => 1,
                'title' => 'Semiotics vaporware cold-pressed',
                'summary' => 'adaptogen iPhone organic locavore unicorn microdosing gentrify narwhal quinoa',
                'body' => 'Taiyaki enamel pin XOXO man braid artisan butcher vexillologist glossier vegan organic. Blue bottle actually tattooed cardigan. Readymade aesthetic celiac 90&#39;s freegan. Adaptogen cold-pressed succulents kitsch meditation 3 wolf moon snackwave, forage tattooed freegan. Cray lyft try-hard biodiesel asymmetrical street art, succulents iPhone freegan drinking vinegar offal. Glossier kinfolk XOXO, selvage paleo coloring book biodiesel vegan four dollar toast chambray. Salvia plaid bicycle rights twee gastropub. Palo santo snackwave shaman chambray post-ironic vinyl, truffaut thundercats.',
                'user_id' => 1,
                'is_published' => 1,
                'delay_publishing' => 0,
                'published_date' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'slug' => 'semiotics-vaporware-cold-pressed',
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
            [
                'id' => 2,
                'title' => 'Etsy pickled selvage street art',
                'summary' => 'iceland synth 90s microdosing',
                'body' => '<p>Oh. You need a little dummy text for your mockup? How quaint.</p>',
                'user_id' => 1,
                'is_published' => 1,
                'delay_publishing' => 0,
                'published_date' => date('Y-m-d h:i:s', strtotime('Now')),
                'slug' => 'iceland-synth-90s-microdosing',
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ],
            [
                'id' => 3,
                'title' => 'I have left the field of economics in favor of becoming a linguist in hipster ipsum',
                'summary' => 'Woke meh iceland, microdosing lumbersexual flexitarian schlitz skateboard art party palo santo deep v chicharrones brunch taiyaki gochujang.',
                'body' => 'Craft beer +1 readymade hashtag. Hammock roof party unicorn readymade bicycle rights bespoke. Cornhole waistcoat kickstarter, kitsch taxidermy aesthetic bicycle rights normcore occupy health goth cloud bread crucifix pitchfork. Chartreuse austin hell of forage, occupy quinoa enamel pin echo park hella taiyaki tacos. Humblebrag la croix polaroid, mixtape cornhole pok pok thundercats selvage pug health goth. Cred sustainable YOLO lumbersexual jianbing locavore chia. Mlkshk tousled +1, occupy fixie echo park retro umami pickled meggings. Schlitz wayfarers vexillologist kitsch bespoke. Kale chips pop-up blue bottle selvage tote bag vape authentic post-ironic street art meditation pinterest thundercats literally pabst cray. Aesthetic ramps viral, retro four loko squid try-hard photo booth keytar. Wayfarers messenger bag pinterest palo santo bicycle rights cornhole quinoa snackwave organic. Kombucha PBR&amp;B man braid godard iPhone af. Kickstarter intelligentsia chillwave offal skateboard, artisan lo-fi woke hell of semiotics knausgaard man braid selfies cold-pressed.',
                'user_id' => 1,
                'is_published' => 0,
                'delay_publishing' => 1,
                'published_date' => date('Y-m-d h:i:s', strtotime('+2 days')),
                'slug' => 'i-have-left-the-field-of-economics-in-favor-of-becoming-a-linguist-in-hipster-ipsum',
                'created' => date('Y-m-d h:i:s', strtotime('-7 days')),
                'modified' => date('Y-m-d h:i:s', strtotime('-7 days'))
            ]
        ];
    }
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'title' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'summary' => ['type' => 'string', 'length' => 1000, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'body' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => 1, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'is_published' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'delay_publishing' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'published_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'slug' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'utf8_general_ci'
        ],
    ];
}
