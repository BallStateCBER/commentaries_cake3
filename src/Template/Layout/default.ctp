<?php
$this->extend('DataCenter.default');
$this->assign('sidebar', $this->element('sidebar'));

$this->Html->script('script', ['block' => 'scriptBottom']);
?>

<?php $this->start('subsite_title'); ?>
    <h1 id="subsite_title" class="max_width">
        <a href="/">
            <img src="/img/Commentary.jpg" alt="Weekly Commentary Banner with Dr. Hicks holding a microphone" />
            <span class="sr-only">
                Weekly Commentary by Michael J. Hicks, Ph.D. Director of the Center for Business and Economic Research at Ball State University. George and Frances Ball Distinguished Professor of Economics.
            </span>
        </a>
    </h1>
<?php $this->end(); ?>

<?php $this->append('scriptBottom'); ?>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script>$.fn.modal || document.write('<script src="/js/bootstrap.min.js"><\/script>')</script>
<?php $this->end(); ?>

<div id="content">
    <?= $this->Flash->render('flash'); ?>
    <div id="commentaries_main">
        <?= $this->fetch('content') ?>
    </div>
</div>
