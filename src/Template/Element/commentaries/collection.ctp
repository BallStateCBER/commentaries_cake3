<?php if (isset($commentaries) && ! empty($commentaries)): ?>
    <table class="commentaries">
        <?php foreach ($commentaries as $commentary): ?>
            <tr>
                <th>
                    <?= date('F j, Y', strtotime($commentary->published_date)); ?>
                </th>
                <td>
                    <?= $this->Html->link(
                        '<span class="title">'.$commentary->title.'</span><span class="summary">'.$commentary->summary.'</span>',
                        ['controller' => 'commentaries', 'action' => 'view', 'id' => $commentary->id, 'slug' => $commentary->slug],
                        ['escape' => false]
                    ); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
