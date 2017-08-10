<?php
use Cake\Core\Configure;

?>
<h1 class="page_title">
    <?= $titleForLayout; ?>
</h1>
<?php
    echo $this->Form->create(
        'Commentary',
        [
            'url' => [
                'controller' => 'commentaries',
                'action' => 'add'
            ]
        ]
    );
    echo $this->Form->input(
        'user_id',
        [
            'label' => 'Author',
            'options' => $authors,
            'style' => 'width: 400px;'
        ]
    );
    echo $this->Form->input(
        'title',
        [
            'label' => 'Title',
            'style' => 'width: 400px;',
            'value' => $commentary->title
        ]
    );
    echo $this->Form->input(
        'summary',
        [
            'label' => 'Summary',
            'style' => 'width: 400px;',
            'value' => $commentary->summary
        ]
    );
    echo $this->Form->input(
        'published_date',
        [
            'type' => 'date',
            'dateFormat' => 'MDY',
            'label' => 'Date',
            'minYear' => 2001,
            'maxYear' => date('Y') + 1
        ]
    );
    echo $this->Form->input('body');
    echo $this->CKEditor->replace('body');
    echo $this->element('DataCenter.jquery_ui');
    echo $this->element(
        'DataCenter.tags/editor',
        [
            'available_tags' => $availableTags,
            'selected_tags' => isset($this->request->data['Tags']) ? $this->request->data['Tags'] : [],
            'hide_label' => true,
            'allow_custom' => true,
            'options' => [
                'show_list' => true
            ]
        ],
        [
            'plugin' => 'DataCenter'
        ]
    );
?>
<fieldset>
    <legend>Publishing</legend>
    <?php
        echo $this->Form->radio(
            'is_published',
            [
                1 => ' Publish <span id="delayed_publishing_date"></span>',
                0 => ' Save as Draft'
            ],
            [
                'value' => 1,
                'legend' => false,
                'separator' => '<br />'
            ]
        );
    ?>
</fieldset>
<?php
    echo $this->Form->submit('Submit');
    echo $this->Form->end();
    echo $this->element(
        'DataCenter.rich_text_editor_init',
        [
            'customConfig' => Configure::read('ckeditor_custom_config')
        ]
    );
    echo $this->Html->script('admin.js', ['inline' => false]);
    $this->Js->buffer("
        toggleDelayPublishing();
        var input_ids = [
            '#CommentaryPublishedDateMonth',
            '#CommentaryPublishedDateDay',
            '#CommentaryPublishedDateYear',
            '#CommentaryIsPublished1',
            '#CommentaryIsPublished0'
        ];
        var selector = input_ids.join(', ');
        $(selector).change(function() {
            toggleDelayPublishing();
        });
    ");
