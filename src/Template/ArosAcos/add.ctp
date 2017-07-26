<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Aros Acos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Aros'), ['controller' => 'Aros', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aro'), ['controller' => 'Aros', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acos'), ['controller' => 'Acos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aco'), ['controller' => 'Acos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="arosAcos form large-9 medium-8 columns content">
    <?= $this->Form->create($arosAco) ?>
    <fieldset>
        <legend><?= __('Add Aros Aco') ?></legend>
        <?php
            echo $this->Form->control('aro_id', ['options' => $aros]);
            echo $this->Form->control('aco_id', ['options' => $acos]);
            echo $this->Form->control('_create');
            echo $this->Form->control('_read');
            echo $this->Form->control('_update');
            echo $this->Form->control('_delete');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
