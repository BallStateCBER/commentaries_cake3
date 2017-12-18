<h1 class="page_title">
    <?= $titleForLayout; ?>
</h1>

<p>
    <?= $this->Html->link(
        'Add a New User',
        [
            'action' => 'add'
        ]
    ); ?>
</p>

<div id="manage_users_index">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>
                <?= $this->Paginator->sort('name');?>
            </th>
            <th>
                <?= $this->Paginator->sort('email');?>
            </th>
            <th>
                <?= $this->Paginator->sort('group_id');?>
            </th>
            <th class="actions">
                <?= __('Actions');?>
            </th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?= h($user->name); ?>&nbsp;
                </td>
                <td>
                    <?= $this->Text->autoLinkEmails(h($user->email)); ?>&nbsp;
                </td>
                <td>
                    <?= $user->group->name; ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(
                        'Edit',
                        [
                            'action' => 'edit',
                            $user->id
                        ]
                    ); ?>
                    <?= $this->Form->postLink(
                        'Delete',
                        [
                            'action' => 'delete',
                            $user->id
                        ],
                        [
                            'confirm' => 'Are you sure you want to delete '.$user->name.'\'s account?'
                        ]
                    ); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
