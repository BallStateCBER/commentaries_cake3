<?php

use Cake\Routing\Router;

if (!isset($newest)) {
    $newest = false;
}
?>

<div class="commentary">
    <div class="header">
        <?php if ($authUser['group_id'] == 1 || $authUser['author']): ?>
            <div class="controls">
                <?= $this->Html->link(
                    $this->Html->image('/data_center/img/icons/pencil.png').'Edit',
                    [
                        'controller' => 'commentaries',
                        'action' => 'edit',
                        $commentary->id,
                        'admin' => false,
                        'newsmedia' => false
                    ],
                    ['escape' => false]
                ); ?>
                &nbsp; <?= $this->Form->postLink(
                    $this->Html->image('/data_center/img/icons/cross.png').'Delete',
                    [
                        'controller' => 'commentaries',
                        'action' => 'delete',
                        $commentary->id,
                        'admin' => false,
                        'newsmedia' => false
                    ],
                    ['escape' => false],
                    'Are you sure that you want to delete this commentary?'
                ); ?>
            </div>
        <?php endif; ?>
        <p class="time_posted">
            <?= date('F j, Y', strtotime($commentary->published_date)); ?>
            <?php if ($newest): ?>
                &nbsp;&nbsp;| &nbsp;&nbsp;Latest Commentary
            <?php endif; ?>
        </p>
        <h3 class="title">
            <?= $this->Html->link($commentary->title, [
                'controller' => 'commentaries',
                'action' => 'view',
                'id' => $commentary->id,
                'slug' =>  $commentary->slug,
                'admin' => false,
                'newsmedia' => false
            ]); ?>
        </h3>
    </div>
    <div class="body">
        <?= $this->Text->autoLink($commentary->body, ['escape' => false]); ?>
    </div>
    <div class="footer">
        <p class="link">
            <?php
                $permalink = Router::url([
                    'controller' => 'commentaries',
                    'action' => 'view',
                    'id' => $commentary->id,
                    'slug' => $commentary->slug,
                    'admin' => false,
                    'newsmedia' => false
                ], true);
            ?>
            Link to this commentary: <?= $this->Html->link($permalink, $permalink); ?>
        </p>
        <?php if (!empty($commentary->tags)): ?>
            <p class="tags">
                <strong>Tags:</strong>
                <?php
                    $linkedTags = [];
                    foreach ($commentary->tags as $tag) {
                        $linkedTags[] = $this->Html->link($tag->name, [
                            'controller' => 'commentaries',
                            'action' => 'tagged',
                            'id' => $tag->id,
                            'admin' => false,
                            'newsmedia' => false
                        ]);
                    }
                    echo implode(', ', $linkedTags);
                ?>
            </p>
        <?php endif; ?>
    </div>
    <?php if (isset($commentary->user) && ! empty($commentary->user['name'])): ?>
        <hr />
        <?= $this->element('users/profile', ['user' => $commentary->user]) ?>
    <?php endif; ?>
</div>
