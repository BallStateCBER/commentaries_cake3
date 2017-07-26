<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Tag $tag
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tag'), ['action' => 'edit', $tag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tag'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Commentaries'), ['controller' => 'Commentaries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Commentary'), ['controller' => 'Commentaries', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tags view large-9 medium-8 columns content">
    <h3><?= h($tag->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($tag->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Tag') ?></th>
            <td><?= $tag->has('parent_tag') ? $this->Html->link($tag->parent_tag->name, ['controller' => 'Tags', 'action' => 'view', $tag->parent_tag->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tag->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($tag->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($tag->rght) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($tag->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($tag->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Selectable') ?></th>
            <td><?= $tag->selectable ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Tags') ?></h4>
        <?php if (!empty($tag->child_tags)): ?>
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
            <?php foreach ($tag->child_tags as $childTags): ?>
            <tr>
                <td><?= h($childTags->id) ?></td>
                <td><?= h($childTags->name) ?></td>
                <td><?= h($childTags->parent_id) ?></td>
                <td><?= h($childTags->lft) ?></td>
                <td><?= h($childTags->rght) ?></td>
                <td><?= h($childTags->selectable) ?></td>
                <td><?= h($childTags->created) ?></td>
                <td><?= h($childTags->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $childTags->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $childTags->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $childTags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childTags->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Commentaries') ?></h4>
        <?php if (!empty($tag->commentaries)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Summary') ?></th>
                <th scope="col"><?= __('Body') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Is Published') ?></th>
                <th scope="col"><?= __('Delay Publishing') ?></th>
                <th scope="col"><?= __('Published Date') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tag->commentaries as $commentaries): ?>
            <tr>
                <td><?= h($commentaries->id) ?></td>
                <td><?= h($commentaries->title) ?></td>
                <td><?= h($commentaries->summary) ?></td>
                <td><?= h($commentaries->body) ?></td>
                <td><?= h($commentaries->user_id) ?></td>
                <td><?= h($commentaries->is_published) ?></td>
                <td><?= h($commentaries->delay_publishing) ?></td>
                <td><?= h($commentaries->published_date) ?></td>
                <td><?= h($commentaries->slug) ?></td>
                <td><?= h($commentaries->created) ?></td>
                <td><?= h($commentaries->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Commentaries', 'action' => 'view', $commentaries->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Commentaries', 'action' => 'edit', $commentaries->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Commentaries', 'action' => 'delete', $commentaries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commentaries->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
