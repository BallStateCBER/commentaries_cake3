<h1 class="page_title">
	<?= $titleForLayout; ?>
</h1>
<div class="content_box col-lg-6">
    <?= $this->Form->create('User', ['url' => [
            'controller' => 'users',
            'action' => 'resetPassword',
            $userId,
            $resetPasswordHash
        ]]);
    ?>

    <?= $this->Form->control('new_password', [
            'class' => 'form-control',
            'label' => 'New Password',
            'type' => 'password',
            'autocomplete' => 'off'
        ]);
    ?>
    <?= $this->Form->control('new_confirm_password', [
            'class' => 'form-control',
            'label' => 'Confirm Password',
            'type' => 'password',
            'autocomplete' => 'off'
        ]);
    ?>
    <?= $this->Form->submit('Reset Password', ['class' => 'btn btn-default']); ?>
    <?= $this->Form->end(); ?>
</div>
