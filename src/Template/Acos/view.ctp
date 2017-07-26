<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Aco $aco
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Aco'), ['action' => 'edit', $aco->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Aco'), ['action' => 'delete', $aco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aco->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aco'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Acos'), ['controller' => 'Acos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Aco'), ['controller' => 'Acos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Aros'), ['controller' => 'Aros', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aro'), ['controller' => 'Aros', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="acos view large-9 medium-8 columns content">
    <h3><?= h($aco->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Parent Aco') ?></th>
            <td><?= $aco->has('parent_aco') ? $this->Html->link($aco->parent_aco->id, ['controller' => 'Acos', 'action' => 'view', $aco->parent_aco->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Model') ?></th>
            <td><?= h($aco->model) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alias') ?></th>
            <td><?= h($aco->alias) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($aco->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Foreign Key') ?></th>
            <td><?= $this->Number->format($aco->foreign_key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($aco->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($aco->rght) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Acos') ?></h4>
        <?php if (!empty($aco->child_acos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('Foreign Key') ?></th>
                <th scope="col"><?= __('Alias') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($aco->child_acos as $childAcos): ?>
            <tr>
                <td><?= h($childAcos->id) ?></td>
                <td><?= h($childAcos->parent_id) ?></td>
                <td><?= h($childAcos->model) ?></td>
                <td><?= h($childAcos->foreign_key) ?></td>
                <td><?= h($childAcos->alias) ?></td>
                <td><?= h($childAcos->lft) ?></td>
                <td><?= h($childAcos->rght) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Acos', 'action' => 'view', $childAcos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Acos', 'action' => 'edit', $childAcos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Acos', 'action' => 'delete', $childAcos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childAcos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Aros') ?></h4>
        <?php if (!empty($aco->aros)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('Foreign Key') ?></th>
                <th scope="col"><?= __('Alias') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($aco->aros as $aros): ?>
            <tr>
                <td><?= h($aros->id) ?></td>
                <td><?= h($aros->parent_id) ?></td>
                <td><?= h($aros->model) ?></td>
                <td><?= h($aros->foreign_key) ?></td>
                <td><?= h($aros->alias) ?></td>
                <td><?= h($aros->lft) ?></td>
                <td><?= h($aros->rght) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Aros', 'action' => 'view', $aros->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Aros', 'action' => 'edit', $aros->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Aros', 'action' => 'delete', $aros->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aros->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
