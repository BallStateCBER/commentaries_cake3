<?php
$this->set('channelData', [
    'title' => __("Weekly Commentary with Michael Hicks"),
    'link' => $this->Html->link('/', true),
    'description' => __("Weekly commentaries by Michael J. Hicks Ph.D., director of the Center for Business and Economic Research, Ball State University."),
    'language' => 'en-us'
]);

foreach ($commentaries as $commentary) {
    $commentaryTime = strtotime($commentary['published_date']);

    $commentaryLink = [
        'controller' => 'commentaries',
        'action' => 'view',
        'id' => $commentary['id'],
        'slug' => $commentary['slug']
    ];

    // This is the part where we clean the body text for output as the description
    // of the rss item, this needs to have only text to make sure the feed validates
    $description = $commentary['body'];
    $description = preg_replace('=\(.*?\)=is', '', $description);
    $description = $this->Text->stripLinks($description);
    $description = $this->Text->truncate($description, 600, [
        'ending' => '...',
        'exact'  => false,
        'html'   => true,
    ]);
    $date = date('F j, Y', strtotime($commentary['published_date']));

    echo $this->Rss->item([], [
        'title' => $date.': '.$commentary['title'],
        'link' => $commentaryLink,
        'guid' => ['url' => $commentaryLink, 'isPermaLink' => 'true'],
        'description' => $description,
        'pubDate' => $commentary['published_date']
    ]);
}
