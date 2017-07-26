<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Commentaries'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="commentaries form large-9 medium-8 columns content">
    <?= $this->Form->create($commentary) ?>
    <fieldset>
        <legend><?= __('Add Commentary') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('summary');
            echo $this->Form->control('body');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('is_published');
            echo $this->Form->control('delay_publishing');
            echo $this->Form->control('published_date', ['empty' => true]);
            echo $this->Form->control('slug');
            echo $this->Form->control('tags._ids', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
