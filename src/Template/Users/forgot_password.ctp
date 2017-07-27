<h1 class="page_title">
	<?= $titleForLayout; ?>
</h1>

<p>
	If you have forgotten the password to your account, you can enter the email address
	associated with it below. We'll send you an email with a link to reset your password.
	If you need assistance, please contact
	<a href="mailto:<?= Configure::read('admin_email'); ?>"><?= Configure::read('admin_email'); ?></a>.
</p>

<?php
    echo $this->Form->create(
        'User',
        [
            'controller' => 'users',
            'action' => 'forgotPassword'
        ]
    );
    echo $this->Form->input(
        'email',
        [
            'label' => false
        ]
    );
    echo $this->Form->submit('Send password-resetting email');
    echo $this->Form->end();
?>
