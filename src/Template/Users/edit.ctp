<?php
use Cake\Core\Configure;

?>
<div style="<?= $authUser->group_id == 1 ? '' : 'display:none;' ;?>">
    <?= $this->CKEditor->loadJs(); ?>
    <?= $this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'myAccount']]); ?>
    <div class="col-lg-6">
        <?= $this->Form->control('name', [
            'class' => 'form-control'
        ]); ?>
        <?= $this->Form->control('email', [
            'class' => 'form-control'
        ]); ?>
        <?= $this->Form->radio('sex', [
            'm' => 'Male',
            'f' => 'Female'
        ]); ?>
    </div>

    <div class="col-lg-12">
        <?= $this->Form->input('bio'); ?>
        <?= $this->CKEditor->replace('bio'); ?>
    </div>

    <div class="col-lg-6">
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-secondary btn-sm']); ?>
    </div>
    <?= $this->Form->end(); ?>
</div>
