<h1 class="page_title">
    <?= $titleForLayout; ?>
</h1>
<div id="tag_list">
    <div class="controls" align="center">
        <h2>
            Toggle mode:
        </h2>
        <h2>
            <a href="#" id="tag_cloud_handle">Cloud View</a>
        </h2>
        <h2>|</h2>
        <h2>
            <a href="#" id="tag_list_handle">List View</a>
        </h2>
    </div>

    <?php

    ?>
    <div id="tag_cloud" class="tag_cloud">
        <?php foreach ($tagCloud as $key => $tag): ?>
            <?php
                $fontSize = $maxFontSize - $minFontSize;
                $fontSize *= $tag['occurrences'] / $maxOccurrences;
                $fontSize += $minFontSize;
                $fontSize = ceil($fontSize);

                echo $this->Html->link(
                    str_replace(' ', '&nbsp;', $tag['name']),
                    ['controller' => 'commentaries', 'action' => 'tagged', 'id' => $tag['id']],
                    [
                        'style' => 'font-size: '.$fontSize.'px',
                        'title' => $tag['occurrences'].' item'.($tag['occurrences'] > 1 ? 's' : ''),
                        'class' => ($key % 2 == 0 ? 'reverse' : ''),
                        'escape' => false
                    ]
                );
            ?>
        <?php endforeach; ?>
    </div>
    <div id="tag_list_inner" style="display: none;">
        <ul>
            <?php foreach ($tagCloud as $key => $tag): ?>
                <li>
                    <?= $this->Html->link(
                        $tag['name'],
                        ['controller' => 'commentaries', 'action' => 'tagged', 'id' => $tag['id']]
                    ); ?>
                    <span class="count">
                        (<?= $tag['occurrences']; ?>)
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <script>
    $('#tag_cloud_handle').click(function(event) {
        event.preventDefault();
        $('#tag_cloud').show();
        $('#tag_list_inner').hide();
    });

    $('#tag_list_handle').click(function(event) {
        event.preventDefault();
        $('#tag_cloud').hide();
        $('#tag_list_inner').show();
    });
    </script>
</div>
