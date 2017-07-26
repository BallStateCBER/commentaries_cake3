<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User $user
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Commentaries'), ['controller' => 'Commentaries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Commentary'), ['controller' => 'Commentaries', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sex') ?></th>
            <td><?= h($user->sex) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Group') ?></th>
            <td><?= $user->has('group') ? $this->Html->link($user->group->name, ['controller' => 'Groups', 'action' => 'view', $user->group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Picture') ?></th>
            <td><?= h($user->picture) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Alert Article Id') ?></th>
            <td><?= $this->Number->format($user->last_alert_article_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Author') ?></th>
            <td><?= $user->author ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nm Email Alerts') ?></th>
            <td><?= $user->nm_email_alerts ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Bio') ?></h4>
        <?= $this->Text->autoParagraph(h($user->bio)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Commentaries') ?></h4>
        <?php if (!empty($user->commentaries)): ?>
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
            <?php foreach ($user->commentaries as $commentaries): ?>
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
