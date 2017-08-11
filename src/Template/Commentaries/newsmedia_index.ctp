<h1 class="page_title">
    <?= $titleForLayout; ?>
</h1>

<?php if (empty($commentary)): ?>
    <div class="notification_message">
        <p>
            The next article to publish has not yet been added. Please check back later.
        </p>
        <p>
            If you need immediate assistance, please contact the Ball State CBER office at 765-285-5926.
        </p>
    </div>
<?php else: ?>
    <div id="next_article_to_publish">
        <?= $this->element('commentaries/view_commentary'); ?>
    </div>
    <script>
        $('#next_article_to_publish .time_posted').prepend('Not for release before ');
    </script>
<?php endif; ?>
