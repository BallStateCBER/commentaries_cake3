<?= $this->CKEditor->loadJs(); ?>
<?= $this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'edit']]); ?>
<div class="col-lg-6">
    <?= $this->Form->control('name', [
        'class' => 'form-control'
    ]); ?>
    <?= $this->Form->control('email', [
        'class' => 'form-control'
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
