<h1 class="page_title">
    <?= $titleForLayout; ?>
</h1>

<div id="tag_management_tabs" class="clearfix">
    <ul>
        <li><a href="#tab-arrange">Arrange</a></li>
        <li><a href="#tab-add">Add</a></li>
        <li><a href="#tab-remove">Remove</a></li>
        <li><a href="#tab-edit">Edit</a></li>
        <li><a href="#tab-merge">Merge</a></li>
        <li><a href="#tab-find">Find</a></li>
        <li><a href="#tab-fix">Fix</a></li>
    </ul>
    <div id="tab-arrange">
        <div id="tree-div" style="height: 400px; overflow: auto;"></div>
        <ul>
            <li>
                PROTIP: Move a tag by clicking to the right of it and dragging
                it to the right of another tag, rather than clicking on its name and
                dragging it on top of another tag's name. For some reason, this
                is the only way to do it when root-level tags are involved.
            </li>
        </ul>
    </div>

    <div id="tab-add">
        <?= $this->Form->create('Tag', ['url' => ['controller' => 'tags', 'action' => 'add']]); ?>
        <strong>Tag</strong>(s)<br />
        Multiple tags go on separate lines. Child-tags can be indented under parent-tags with one hyphen or tab per level. Example:
    <pre style="background-color: #eee; font-size: 80%; margin-left: 20px; width: 200px;">Fruits
-Apples
--Granny Smith
--Red Delicious
-Nanners
Vegetables
-Taters</pre>
        <?= $this->Form->input('name', ['type' => 'textarea', 'label' => false, 'style' => 'width: 100%;']); ?>
        <p>
            All tags will be created as selectable.
        </p>
        <?= $this->Form->submit('Add', ['class' => 'btn']) ?>
        <?= $this->Form->end(); ?>

        <div id="add_results"></div>
    </div>

    <div id="tab-remove">
        <p class="alert alert-info">
            Warning: If a tag is removed, all child-tags will also be removed. This cannot be undone.
        </p>
        <?= $this->Html->link('Remove all tags in the "Delete" group', [
            'controller' => 'tags', 'action' => 'emptyDeleteGroup'
        ]); ?>
        <p>
            Or start typing a tag name:
        </p>
        <form id="tag_remove_form">
            <input type="text" id="tag_remove_field" class="search_field form-control" />
            <input type="submit" value="Remove" class="btn" />
        </form>
        <div class="results"></div>
    </div>

    <div id="tab-edit">
        <p>
            Start typing a tag name:
        </p>
        <div>
            <form id="tag_edit_search_form">
                <input type="text" class="search_field form-control" />
                <br />
                <input type="submit" value="Edit this tag" class="btn" />
            </form>
        </div>
        <div class="results" id="edit_results"></div>
    </div>

    <div id="tab-merge">
        <p>
            Start typing tag names:
        </p>
        <form id="tag_merge_form">
            Merge
            <input type="text" id="tag_merge_from_field" class="search_field form-control"/>
            into
            <input type="text" id="tag_merge_into_field" class="search_field form-control"/>

            <span class="footnote">(The first tag will be <strong>removed</strong>.)</span>
            <br />
            <input type="submit" value="Merge" class="btn" />
        </form>
        <div class="results" id="merge_results"></div>
    </div>

    <div id="tab-find">
        <p>
            Start typing a tag name:
        </p>
        <div>
            <form id="tag_search_form">
                <input type="text" class="search_field form-control" />
                <br />
                <input type="submit" value="Trace path to this tag" class="btn" />
            </form>
        </div>
        <div class="results" id="trace_results"></div>
    </div>

    <div id="tab-fix">
        <p>
            These functions are safe to use at any time, and should be used to fix relevant problems
            that come up. But these were initially only set up to assist in the transition from
            The Muncie Scene's tag system to the new system.
        </p>
        <ul>
            <li>
                <?= $this->Html->link('Recover tag tree', ['controller' => 'tags', 'action' => 'recover']); ?>
                <br />If the tree structure in the database (lft and rght fields) has gotten screwed up
            </li>
            <li>
                <?= $this->Html->link('Remove duplicate tags', ['controller' => 'tags', 'action' => 'duplicates']); ?>
                <br />And merge associations into the retained tags
            </li>
            <li>
                <?= $this->Html->link('Remove broken associations', ['controller' => 'tags', 'action' => 'removeBrokenAssociations']); ?>
                <br />Associations in the events_tags table involving either nonexistent tags or events.
            </li>
        </ul>
        <div class="results"></div>
    </div>
</div>

<h2>Notes:</h2>
<ul>
    <li>
        Working with any tag that has a slash (/) in its name (and possibly other punctuation) may cause errors.
        This is because the <a href="http://httpd.apache.org/docs/2.2/mod/core.html#allowencodedslashes">AllowEncodedSlashes directive</a> in Apache creates a 404 error when an
        encoded slash (%2F) is in a URL, e.g. when the name of such a tag is included in a URL by
        an AJAX request.
    </li>
</ul>

<?= $this->Html->css('/ext-2.0.1/resources/css/ext-custom.css', [null], ['inline' => false]); ?>
<?= $this->Html->script('/ext-2.0.1/ext-custom.js', ['inline' => false]); ?>
<?= $this->Html->script('jquery.form.js', ['inline' => false]); ?>
<?= $this->Html->script('admin.js', ['inline' => false]); ?>
<?= $this->element('DataCenter.jquery_ui'); ?>
<script>
    setupTagManager();
</script>
