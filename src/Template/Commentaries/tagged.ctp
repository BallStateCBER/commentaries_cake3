<div class="tagged">
	<h1 class="page_title">
		Commentaries tagged with <em><?= $tagName ?></em>
	</h1>
	<?php if (empty($commentaries)): ?>
		(None found)
	<?php else: ?>
		<?= $this->element('commentaries/collection'); ?>
	<?php endif; ?>
</div>
