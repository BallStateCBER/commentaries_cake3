<div style="<?= $user->group_id == 3 ? '' : 'display:none;' ;?>">
    <h1 class="page_title">
        <?= $titleForLayout; ?>
    </h1>

    <div id="newsmedia_my_account">
        <?= $this->Form->create($user); ?>

        <fieldset>
            <legend>
                Update Info
            </legend>
            <div class="col-lg-6">
                <?= $this->Form->input(
                    'name',
                    [
                        'class' => 'form-control',
                        'label' => 'Name'
                    ]
                ); ?>
            </div>
            <div class="col-lg-6">
                <?= $this->Form->input(
                    'email',
                    [
                        'class' => 'form-control',
                        'label' => 'Email'
                    ]
                ); ?>
            </div>
        </fieldset>

        <fieldset>
            <legend>
                Alerts
            </legend>
            <?= $this->Form->input(
                'nm_email_alerts',
                [
                    'label' => 'Receive email alerts when new commentaries are available',
                    'type' => 'checkbox'
                ]
            ); ?>
        </fieldset>

        <fieldset>
            <legend>
                Change password
            </legend>
            <div class="col-lg-6">
                <?= $this->Form->input(
                    'new_password',
                    [
                        'class' => 'form-control',
                        'label' => 'Password',
                        'type' => 'password',
                        'autocomplete' => 'off',
                        'required' => false
                    ]
                ); ?>
            </div>
            <div class="col-lg-6">
                <?= $this->Form->input(
                    'confirm_password',
                    [
                        'class' => 'form-control',
                        'type' => 'password',
                        'required' => false
                    ]
                ); ?>
            </div>
        </fieldset>

        <?= $this->Form->submit('Submit', [
            'class' => 'btn btn-sm'
        ]); ?>
        <?= $this->Form->end(); ?>
    </div>
</div>
