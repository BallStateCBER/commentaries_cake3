<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CommentariesTag[]|\Cake\Collection\CollectionInterface $commentariesTags
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Commentaries Tag'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Commentaries'), ['controller' => 'Commentaries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Commentary'), ['controller' => 'Commentaries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="commentariesTags index large-9 medium-8 columns content">
    <h3><?= __('Commentaries Tags') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('commentary_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tag_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commentariesTags as $commentariesTag): ?>
            <tr>
                <td><?= $this->Number->format($commentariesTag->id) ?></td>
                <td><?= $commentariesTag->has('commentary') ? $this->Html->link($commentariesTag->commentary->title, ['controller' => 'Commentaries', 'action' => 'view', $commentariesTag->commentary->id]) : '' ?></td>
                <td><?= $commentariesTag->has('tag') ? $this->Html->link($commentariesTag->tag->name, ['controller' => 'Tags', 'action' => 'view', $commentariesTag->tag->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $commentariesTag->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $commentariesTag->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $commentariesTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commentariesTag->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
