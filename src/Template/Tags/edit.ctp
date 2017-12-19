<?= $this->Form->create('Tag');?>
<?= $this->Form->control('id', [
    'default' => $tag['id'],
    'type' => 'hidden'
]); ?>
<?= $this->Form->control('name', [
    'class' => 'form-control',
    'default' => $tag['name']
]); ?>
<?= $this->Form->control('selectable', [
    'default' => $tag['selectable'],
    'type' => 'checkbox',
    'label' => 'Selectable?'
]); ?>
<div class="footnote">
    Unselectable tags (generally group names, like "music genres") are excluded from auto-complete suggestions and are not selectable in event forms.
</div>
<?= $this->Form->submit('Update tag #'.$tag['id'], ['class' => 'btn btn-default']); ?>
<?= $this->Form->end(); ?>
