<h1 class="page_title">
    <?= $titleForLayout; ?>
</h1>

<?php
$years = range($latestYear, $earliestYear);
$totalYears = count($years);

?>

<ul class="commentary_years">
    <li>
        Select a year &rarr;
    </li>
    <select class="form-control" data-url="/browse/<?= $year; ?>">
        <?php foreach ($years as $y): ?>
            <option <?php if ($y == $year): ?>selected="selected"<?php endif; ?>>
                <?= $y; ?>
            </option>
        <?php endforeach; ?>
    </select>
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
