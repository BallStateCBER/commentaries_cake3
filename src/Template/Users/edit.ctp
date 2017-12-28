<h1 class="page_title">
    <?= $titleForLayout ?>
</h1>
<?= $this->CKEditor->loadJs() ?>
<?= $this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'edit']]) ?>
<div class="col-lg-6">
    <?= $this->Form->control('name', [
        'class' => 'form-control'
    ]) ?>
    <?= $this->Form->control('email', [
        'class' => 'form-control'
    ]) ?>
    <?= $this->Form->control('gender', [
        'class' => 'form-control'
    ]) ?>
    <label for="group-id">
        Group
    </label>
    <?= $this->Form->select('group_id', [
        1 => 'Administrators',
        2 => 'Commentary authors',
        3 => 'Newsmedia'
    ], ['class' => 'form-control', 'id' => 'group-id']) ?>
</div>

<div class="col-lg-8">
    <?= $this->Form->input('bio') ?>
    <?= $this->CKEditor->replace('bio') ?>
</div>

<div class="col-lg-6">
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-secondary btn-sm']) ?>
</div>
<?= $this->Form->end(); ?>
