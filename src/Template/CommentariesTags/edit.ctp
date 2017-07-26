<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $commentariesTag->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $commentariesTag->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Commentaries Tags'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Commentaries'), ['controller' => 'Commentaries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Commentary'), ['controller' => 'Commentaries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="commentariesTags form large-9 medium-8 columns content">
    <?= $this->Form->create($commentariesTag) ?>
    <fieldset>
        <legend><?= __('Edit Commentaries Tag') ?></legend>
        <?php
            echo $this->Form->control('commentary_id', ['options' => $commentaries]);
            echo $this->Form->control('tag_id', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
