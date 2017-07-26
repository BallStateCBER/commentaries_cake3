<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Aros'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parent Aros'), ['controller' => 'Aros', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Aro'), ['controller' => 'Aros', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acos'), ['controller' => 'Acos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aco'), ['controller' => 'Acos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="aros form large-9 medium-8 columns content">
    <?= $this->Form->create($aro) ?>
    <fieldset>
        <legend><?= __('Add Aro') ?></legend>
        <?php
            echo $this->Form->control('parent_id', ['options' => $parentAros, 'empty' => true]);
            echo $this->Form->control('model');
            echo $this->Form->control('foreign_key');
            echo $this->Form->control('alias');
            echo $this->Form->control('acos._ids', ['options' => $acos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
