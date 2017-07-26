<?php if (empty($recentCommentaries)): ?>
    <!-- Error: No recent commentaries found -->
<?php else: ?>
    <div class="recent_commentaries">
        <h3>
            Recent
        </h3>
        <?php foreach ($recentCommentaries as $commentary): ?>
            <p>
                <?php echo $this->Html->link(
                    '<span class="title">'.$commentary->title.'</span><span class="summary">'.$commentary->summary.'</span>',
                    ['controller' => 'commentaries', 'action' => 'view', 'id' => $commentary->id, 'slug' => $commentary->slug, 'admin' => false, 'plugin' => false],
                    ['escape' => false]
                ); ?>
            </p>
        <?php endforeach; ?>
        <?php echo $this->Html->link(
            'View archives',
            ['controller' => 'commentaries', 'action' => 'browse', 'admin' => false, 'plugin' => false],
            ['class' => 'more']
        ); ?>
    </div>
<?php endif; ?>
