<h1 class="page_title">
    Log in
</h1>
<?= $this->Form->create('User', ['url' => ['controller' => 'Users', 'action' => 'login']]); ?>

<div class="col-lg-12">
    <div class='col-lg-6'>
        <?= $this->Form->control('email', ['class' => 'form-control']); ?>
    </div>
</div>

<div class="col-lg-12">
    <div class='col-lg-6'>
        <?= $this->Form->control('password', ['class' => 'form-control']); ?>
    </div>
</div>

<div class="col-lg-6">
    <?= $this->Form->input('remember_me', [
            'type' => 'checkbox',
            'label' => [
                'text' => ' Remember me',
                'style' => 'display: inline;'
            ],
            'checked' => true
        ]);
    ?>
    <?= $this->Form->button(__('Login'), ['class' => 'btn btn-default', 'id' => 'login-btn']); ?>
</div>
<div class="col-lg-12">
    <div class="col-lg-6" style='margin:5px;'>
        <?= $this->Html->link(__('Forgot password?'),
            ['controller' => 'Users', 'action' => 'forgotPassword'],
            ['class' => 'nav-link']
        ); ?>
    </div>
</div>

<?= $this->Form->end() ?>
