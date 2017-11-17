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
                'nestingLabel' => '{{input}}',
                'select' => '<select class="form-control dates" name="{{name}}"{{attrs}}>{{content}}</select>'
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
                        'year' => [
                            'id' => 'dateYear'
                        ],
                        'month' => [
                            'id' => 'dateMonth'
                        ],
                        'day' => [
                            'id' => 'dateDay'
                        ],
                        'type' => 'date',
                        'label' => 'Date',
                        'minYear' => 2001,
                        'maxYear' => date('Y') + 1
                    ]
                ); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->Form->input('body'); ?>
            <?= $this->CKEditor->replace('body'); ?>
            <?= $this->element('DataCenter.jquery_ui'); ?>
            <?= $this->Html->script('admin.js', ['inline' => false]); ?>
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
                <label for="is-published-1">
                    <?= $this->Form->control(
                            'is_published',
                            [
                                'type' => 'radio',
                                'options' => [
                                    1 => ''
                                ],
                                'default' => 1,
                                'legend' => false,
                                'label' => false,
                                'id' => 'is-published-1',
                                'hiddenField' => false
                            ]
                    ); ?>
                    Publish <span id="delayed_publishing_date"></span>
                </label>
                <label for="is-published-0">
                    <?= $this->Form->control(
                            'is_published',
                            [
                                'type' => 'radio',
                                'options' => [
                                    0 => ''
                                ],
                                'default' => 1,
                                'legend' => false,
                                'label' => false,
                                'id' => 'is-published-0',
                                'hiddenField' => false
                            ]
                    ); ?>
                    Save as Draft
                </label>
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
    <script>
        toggleDelayPublishing();
        var input_ids = [
            '#dateMonth',
            '#dateYear',
            '#dateDay'
        ];
        var selector = input_ids.join(', ');
        $(selector).change(function() {
            var current_time = new Date();
        	var this_month = current_time.getMonth() + 1;
        	if (this_month < 10) {
        		this_month = '0' + this_month;
        	}
        	var this_day = current_time.getDate();
        	if (this_day < 10) {
        		this_day = '0' + this_day;
        	}
        	var this_year =  current_time.getFullYear();
        	var selected_month = $('#dateMonth').val();
        	var selected_day = $('#dateDay').val();
        	var selected_year = $('#dateYear').val();
        	var selected_date = selected_year + selected_month + selected_day;
        	var this_date = this_year + this_month + this_day;
        	if (selected_date > this_date) {
        		$('#delayed_publishing_date').html('automatically on ' + selected_month + '-' + selected_day + '-' + selected_year);
        	} else {
        		$('#delayed_publishing_date').html('');
        	}
        });
    </script>
</div>
