<?php
$this->extend('DataCenter.default');
#$this->assign('sidebar', $this->element('sidebar'));

$this->Html->script('script', ['block' => 'scriptBottom']);
?>

<?php $this->start('subsite_title'); ?>
<?php // Deliberately blank?>
<?php $this->end(); ?>

<?php $this->append('scriptBottom'); ?>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script>$.fn.modal || document.write('<script src="/js/bootstrap.min.js"><\/script>')</script>
<?php $this->end(); ?>

<div id="content">
    <div id="commentaries_main">
        <?= $this->fetch('content') ?>
    </div>
</div>
