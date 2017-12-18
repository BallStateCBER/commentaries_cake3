<?php
    $session = $this->request->session();
    $userGroup = $session->read('Auth.User.group_id');
?>

<div id="user_menu">
    <h2>
        <?= $session->read('Auth.User.name'); ?>
    </h2>
    <ul class="root">
        <li>
            <ul>
                <?php if ($userGroup == 3): ?>
                    <li>
                        <?= $this->Html->link(
                            'Next Article to Publish',
                            [
                                'controller' => 'commentaries',
                                'action' => 'index',
                                'admin' => false,
                                'newsmedia' => true,
                                'plugin' => false
                            ]
                        ); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'My Account',
                            [
                                'controller' => 'users',
                                'action' => 'newsmediaMyAccount',
                                'admin' => false,
                                'newsmedia' => true,
                                'plugin' => false
                            ]
                        ); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'Subscribe Another User to Newsmedia Alerts',
                            [
                                'controller' => 'users',
                                'action' => 'addNewsmedia',
                                'admin' => false,
                                'plugin' => false
                            ]
                        ); ?>
                    </li>
                <?php else: ?>
                    <li>
                        <?= $this->Html->link(
                            'My Account',
                            [
                                'controller' => 'users',
                                'action' => 'my_account',
                                'admin' => false,
                                'plugin' => false
                            ]
                        ); ?>
                    </li>
                <?php endif; ?>
                <li>
                    <?= $this->Html->link(
                        'Log out',
                        [
                            'controller' => 'users',
                            'action' => 'logout',
                            'admin' => false,
                            'plugin' => false
                        ]
                    ); ?>
                </li>
            </ul>
        </li>

        <?php if ($userGroup == 1 || $userGroup == 2): ?>
            <li>
                Weekly Commentaries
                <ul>
                    <li>
                        <?= $this->Html->link(
                            'Add',
                            [
                                'controller' => 'commentaries',
                                'action' => 'add',
                                'admin' => false,
                                'plugin' => false
                            ]
                        ); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'Drafts',
                            [
                                'controller' => 'commentaries',
                                'action' => 'drafts',
                                'admin' => false,
                                'plugin' => false
                            ]
                        ); ?>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

        <?php if ($userGroup == 1): ?>
            <li>
                Admin
                <ul>
                    <li>
                        <?= $this->Html->link(
                            'Add a User',
                            [
                                'controller' => 'users',
                                'action' => 'add',
                                'admin' => false,
                                'plugin' => false
                            ]
                        ); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'Edit Users',
                            [
                                'controller' => 'users',
                                'action' => 'adminIndex',
                                'plugin' => false
                            ]
                        ); ?>
                    </li>
                    <li>
                        <a href="/newsmedia/subscribe">
                            Add a Newsmedia Member
                        </a>
                    </li>
                    <li>
                        <a href="/newsmedia">
                            Next Article to Publish
                        </a>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'Manage Tags',
                            [
                                'controller' => 'tags',
                                'action' => 'manage'
                            ]
                        ); ?>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</div>
