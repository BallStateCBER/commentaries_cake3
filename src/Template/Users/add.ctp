<h1 class="page_title">
    Add a New User
</h1>
<?= $this->CKEditor->loadJs(); ?>
<?= $this->Form->create($user);?>

<div class="col-lg-6">
    <?= $this->Form->control('name', ['class' => 'form-control']) ?>
    <?= $this->Form->control('email', ['class' => 'form-control']) ?>
    <?= $this->Form->control('gender', ['class' => 'form-control']) ?>
</div>

<div class="col-lg-8">
    <?= $this->Form->input('bio') ?>
    <?= $this->CKEditor->replace('bio') ?>
</div>

<div class="col-lg-6">
    <?= $this->Form->control('password', ['class' => 'form-control']) ?>
    <?= $this->Form->control('group_id', ['class' => 'form-control']) ?>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-secondary btn-sm']) ?>
</div>

<?= $this->Form->end();?>
