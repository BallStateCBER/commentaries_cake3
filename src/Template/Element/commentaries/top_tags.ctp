<table>
    <?php foreach ($topTags as $tag): ?>
        <tr>
            <th>
                <?= $this->Html->link(
                    $tag['name'],
                    [
                        'controller' => 'commentaries',
                        'action' => 'tagged',
                        'id' => $tag['tag_id'],
                        'admin' => false,
                        'plugin' => false
                    ]
                ); ?>
            </th>
            <td>
                <?= $tag['occurrences']; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
