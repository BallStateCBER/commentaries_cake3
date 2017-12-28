<h1 class="page_title">
    <?= $titleForLayout ?>
</h1>
<?= $this->CKEditor->loadJs(); ?>
<?= $this->Form->create('User', ['url' => ['controller' => 'Users', 'action' => 'myAccount']]); ?>
<div class="col-lg-6">
    <?= $this->Form->control('name', [
        'class' => 'form-control',
        'value' => $authUser->name
    ]); ?>
    <?= $this->Form->control('email', [
        'class' => 'form-control',
        'value' => $authUser->email
    ]); ?>
    <?= $this->Form->control('gender', [
        'class' => 'form-control',
        'value' => $authUser->gender
    ]); ?>
</div>

<div class="col-lg-8">
    <?= $this->Form->input('bio'); ?>
    <?= $this->CKEditor->replace('bio'); ?>
</div>

<div class="col-lg-6">
    <?= $this->Form->control('password', [
        'class' => 'form-control'
    ]) ?>
    <?= $this->Form->control('confirm_password', [
        'class' => 'form-control'
    ]) ?>
</div>

<div class="col-lg-12">
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-secondary btn-sm']); ?>
</div>

<?= $this->Form->end(); ?>
