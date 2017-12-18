<?php
use Cake\Core\Configure;

?>
<h1 class="page_title">
	<?= $titleForLayout; ?>
</h1>

<p>
	If you have forgotten the password to your account, you can enter the email address
	associated with it below. We'll send you an email with a link to reset your password.
	If you need assistance, please contact
	<a href="mailto:<?= Configure::read('admin_email'); ?>"><?= Configure::read('admin_email'); ?></a>.
</p>

<?= $this->Form->create('User', ['url' => ['controller' => 'Users', 'action' => 'forgotPassword']]); ?>
<div class="col-lg-12" align="center">
    <?php
        echo $this->Form->input('email', ['class' => 'form-control', 'label' => false]);
        echo $this->Form->button('Send password-resetting email', ['class' => 'btn btn-default']);
        echo $this->Form->end();
    ?>
</div>
