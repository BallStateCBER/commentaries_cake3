<h1 class="page_title">
    <?= $titleForLayout; ?>
</h1>

<?php $years = range($latestYear, $earliestYear); ?>

<ul class="commentary_years">
    <li>
        Select a year &rarr;
    </li>
    <?php foreach ($years as $y): ?>
        <li<?php if ($y == $year): ?> class="selected"<?php endif; ?>>
            <?= $this->Html->link(
                $y,
                ['controller' => 'commentaries', 'action' => 'browse', $y]
            ); ?>
        </li>
    <?php endforeach; ?>
</ul>

<?php if (isset($commentaries) && ! empty($commentaries)): ?>
    <table class="commentaries">
        <?php foreach ($commentaries as $commentary): ?>
            <tr>
                <th>
                    <?= date('F j, Y', strtotime($commentary->published_date)); ?>
                </th>
                <td>
                    <?php
                        echo $this->Html->link(
                            '<span class="title">'.$commentary->title.'</span><span class="summary">'.$commentary->summary.'</span>',
                            [
                                'controller' => 'commentaries',
                                'action' => 'view',
                                'id' => $commentary->id,
                                'slug' => $commentary->slug
                            ],
                            ['escape' => false]
                        );

                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
