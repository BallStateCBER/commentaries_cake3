<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ArosAco[]|\Cake\Collection\CollectionInterface $arosAcos
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Aros Aco'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Aros'), ['controller' => 'Aros', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aro'), ['controller' => 'Aros', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acos'), ['controller' => 'Acos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aco'), ['controller' => 'Acos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="arosAcos index large-9 medium-8 columns content">
    <h3><?= __('Aros Acos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('aro_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('aco_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('_create') ?></th>
                <th scope="col"><?= $this->Paginator->sort('_read') ?></th>
                <th scope="col"><?= $this->Paginator->sort('_update') ?></th>
                <th scope="col"><?= $this->Paginator->sort('_delete') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arosAcos as $arosAco): ?>
            <tr>
                <td><?= $this->Number->format($arosAco->id) ?></td>
                <td><?= $arosAco->has('aro') ? $this->Html->link($arosAco->aro->id, ['controller' => 'Aros', 'action' => 'view', $arosAco->aro->id]) : '' ?></td>
                <td><?= $arosAco->has('aco') ? $this->Html->link($arosAco->aco->id, ['controller' => 'Acos', 'action' => 'view', $arosAco->aco->id]) : '' ?></td>
                <td><?= h($arosAco->_create) ?></td>
                <td><?= h($arosAco->_read) ?></td>
                <td><?= h($arosAco->_update) ?></td>
                <td><?= h($arosAco->_delete) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $arosAco->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $arosAco->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $arosAco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $arosAco->id)]) ?>
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
