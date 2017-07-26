<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Commentary $commentary
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Commentary'), ['action' => 'edit', $commentary->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Commentary'), ['action' => 'delete', $commentary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commentary->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Commentaries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Commentary'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="commentaries view large-9 medium-8 columns content">
    <h3><?= h($commentary->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($commentary->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Summary') ?></th>
            <td><?= h($commentary->summary) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $commentary->has('user') ? $this->Html->link($commentary->user->name, ['controller' => 'Users', 'action' => 'view', $commentary->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($commentary->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($commentary->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Published Date') ?></th>
            <td><?= h($commentary->published_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($commentary->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($commentary->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Published') ?></th>
            <td><?= $commentary->is_published ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delay Publishing') ?></th>
            <td><?= $commentary->delay_publishing ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($commentary->body)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tags') ?></h4>
        <?php if (!empty($commentary->tags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col"><?= __('Selectable') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($commentary->tags as $tags): ?>
            <tr>
                <td><?= h($tags->id) ?></td>
                <td><?= h($tags->name) ?></td>
                <td><?= h($tags->parent_id) ?></td>
                <td><?= h($tags->lft) ?></td>
                <td><?= h($tags->rght) ?></td>
                <td><?= h($tags->selectable) ?></td>
                <td><?= h($tags->created) ?></td>
                <td><?= h($tags->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
