<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ArosAco $arosAco
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Aros Aco'), ['action' => 'edit', $arosAco->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Aros Aco'), ['action' => 'delete', $arosAco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $arosAco->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Aros Acos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aros Aco'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Aros'), ['controller' => 'Aros', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aro'), ['controller' => 'Aros', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acos'), ['controller' => 'Acos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aco'), ['controller' => 'Acos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="arosAcos view large-9 medium-8 columns content">
    <h3><?= h($arosAco->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Aro') ?></th>
            <td><?= $arosAco->has('aro') ? $this->Html->link($arosAco->aro->id, ['controller' => 'Aros', 'action' => 'view', $arosAco->aro->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Aco') ?></th>
            <td><?= $arosAco->has('aco') ? $this->Html->link($arosAco->aco->id, ['controller' => 'Acos', 'action' => 'view', $arosAco->aco->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __(' Create') ?></th>
            <td><?= h($arosAco->_create) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __(' Read') ?></th>
            <td><?= h($arosAco->_read) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __(' Update') ?></th>
            <td><?= h($arosAco->_update) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __(' Delete') ?></th>
            <td><?= h($arosAco->_delete) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($arosAco->id) ?></td>
        </tr>
    </table>
</div>
