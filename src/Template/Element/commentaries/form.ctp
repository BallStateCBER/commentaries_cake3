<?php
use Cake\Core\Configure;

?>
<div style="<?= $authUser->group_id != 3 ? '' : 'display:none;' ;?>">
    <?= $this->CKEditor->loadJs(); ?>
    <h1 class="page_title">
        <?= $titleForLayout; ?>
    </h1>
    <?= $this->Form->create(
        $commentary,
        [
            'templates' => [
                'select' => '<select class="form-control dates" name="{{name}}" id="{{name}}">{{content}}</select>'
            ]
        ]
    ); ?>
    <div class="row">
        <div class="col-lg-6">
            <?=  $this->Form->input(
                'user_id',
                [
                    'label' => 'Author',
                    'options' => $authors,
                    'class' => 'form-control',
                    'value' => $commentary->user_id
                ]
            ); ?>
            <?= $this->Form->input(
                'title',
                [
                    'label' => 'Title',
                    'class' => 'form-control'
                ]
            ); ?>
            <?= $this->Form->input(
                    'summary',
                    [
                        'label' => 'Summary',
                        'class' => 'form-control'
                    ]
                ); ?>
            <?= $this->Form->input(
                    'published_date',
                    [
                        'type' => 'date',
                        'dateFormat' => 'MDY',
                        'label' => 'Date',
                        'minYear' => 2001,
                        'maxYear' => date('Y') + 1,
                        'class' => 'form-control'
                    ]
                ); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->Form->input('body'); ?>
            <?= $this->CKEditor->replace('body'); ?>
            <?= $this->element('DataCenter.jquery_ui'); ?>
            <?= $this->element(
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
                ); ?>
            <fieldset>
                <legend>Publishing</legend>
                <span id="delayed_publishing_date"></span>
                <?= $this->Form->radio(
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
                    ); ?>
            </fieldset>
            <div class="col-lg-4" style="float:right;">
                <?= $this->Form->submit('Submit', [
                    'class' => 'form-control',
                    'style' => 'margin:25px auto'
                ]); ?>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>

    <?= $this->Html->script('admin.js', ['inline' => false]); ?>
    <script>
        toggleDelayPublishing();
        var input_ids = [
            '#published_date[month]',
            '#published_date[year]',
            '#published_date[day]',
            '#is-published-1',
            '#is-published-0'
        ];
        var selector = input_ids.join(', ');
        $(selector).change(function() {
            toggleDelayPublishing();
        });
    </script>
</div>
