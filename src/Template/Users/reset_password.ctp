<h1 class="page_title">
	<?= $titleForLayout; ?>
</h1>

<?php
    echo $this->Form->create(
        'User',
        [
            'url' => [
                'controller' => 'users',
                'action' => 'resetPassword',
                $userId,
                $resetPasswordHash
            ]
        ]
    );
    echo $this->Form->input(
        'new_password',
        [
            'label' => 'New Password',
            'type' => 'password',
            'autocomplete' => 'off'
        ]
    );
    echo $this->Form->input(
        'confirm_password',
        [
            'label' => 'Confirm Password',
            'type' => 'password',
            'autocomplete' => 'off'
        ]
    );
    echo $this->Form->submit('Reset password');
    echo $this->Form->end();
