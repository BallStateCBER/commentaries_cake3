<h1 class="page_title">
    Log in
</h1>
<?= $this->Form->create('User', ['url' => ['controller' => 'Users', 'action' => 'login']]); ?>
<div class="row">
    <div class='form-group col-lg-4 col-xs-12'>
        <?= $this->Form->control('email', ['class' => 'form-control']); ?>
    </div>
</div>
<div class="row">
    <div class='form-group col-lg-4 col-xs-12'>
        <?= $this->Form->control('password', ['class' => 'form-control']); ?>
        <?= $this->Html->link(__('Forgot password?'), ['controller' => 'Users', 'action' => 'forgotPassword'], ['class' => 'nav-link']); ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-4 col-xs-12">
        <?= $this->Form->input('remember_me', [
                'type' => 'checkbox',
                'label' => [
                    'text' => ' Remember me',
                    'style' => 'display: inline;'
                ],
                'checked' => true
            ]);
        ?>
    </div>
</div>
<?= $this->Form->button(__('Login'), ['class' => 'btn btn-secondary btn-sm']); ?>
<?= $this->Form->end() ?>
