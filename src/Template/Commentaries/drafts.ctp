<h1 class="page_title">
    <?= $titleForLayout; ?>
</h1>

<?php if (empty($commentaries)): ?>
    You currently have no commentaries saved as drafts.
<?php else: ?>
    <table class="my_commentaries">
        <thead>
            <tr>
                <th class="modified">Last Modified</th>
                <th>Title</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>
        <tfoot></tfoot>
        <tbody>
            <?php foreach ($commentaries as $key => $commentary): ?>
                <tr<?php if ($key % 2 == 1): ?> class="alternate"<?php endif; ?>>
                    <td>
                        <?= date('F j, Y', strtotime($commentary->modified)); ?>
                    </td>
                    <td>
                        <?= $this->Html->link(
                            $commentary->title,
                            [
                                'controller' => 'commentaries',
                                'action' => 'view',
                                'id' => $commentary->id,
                                'slug' => $commentary->slug
                            ]
                        ); ?>
                    </td>
                    <td>
                        <?= $this->Html->link(
                            'Edit',
                            [
                                'controller' => 'commentaries',
                                'action' => 'edit',
                                $commentary->id
                            ]
                        ); ?>
                        |
                        <?= $this->Form->postLink(
                            'Delete',
                            [
                                'controller' => 'commentaries',
                                'action' => 'delete',
                                $commentary->id
                            ],
                            [],
                            'Are you sure that you want to delete this commentary?'
                        ); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
