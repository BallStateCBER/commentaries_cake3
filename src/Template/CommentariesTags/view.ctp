<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CommentariesTag $commentariesTag
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Commentaries Tag'), ['action' => 'edit', $commentariesTag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Commentaries Tag'), ['action' => 'delete', $commentariesTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commentariesTag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Commentaries Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Commentaries Tag'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Commentaries'), ['controller' => 'Commentaries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Commentary'), ['controller' => 'Commentaries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="commentariesTags view large-9 medium-8 columns content">
    <h3><?= h($commentariesTag->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Commentary') ?></th>
            <td><?= $commentariesTag->has('commentary') ? $this->Html->link($commentariesTag->commentary->title, ['controller' => 'Commentaries', 'action' => 'view', $commentariesTag->commentary->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tag') ?></th>
            <td><?= $commentariesTag->has('tag') ? $this->Html->link($commentariesTag->tag->name, ['controller' => 'Tags', 'action' => 'view', $commentariesTag->tag->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($commentariesTag->id) ?></td>
        </tr>
    </table>
</div>
