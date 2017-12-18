<?= $this->Form->create('Tag');?>
<?= $this->Form->control('id', [
    'default' => $this->request->getData('id'),
    'type' => 'hidden'
]); ?>
<?= $this->Form->control('name', [
    'class' => 'form-control',
    'default' => $this->request->getData('name')
]); ?>
<?= $this->Form->control('selectable', [
    'default' => $this->request->getData('selectable'),
    'type' => 'checkbox',
    'label' => 'Selectable?'
]); ?>
<div class="footnote">
    Unselectable tags (generally group names, like "music genres") are excluded from auto-complete suggestions and are not selectable in event forms.
</div>
<?= $this->Form->submit('Update tag #'.$this->request->getData['id'], ['class' => 'btn btn-default']); ?>
<?= $this->Form->end(); ?>
