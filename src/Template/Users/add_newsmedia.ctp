<?php

use Cake\Routing\Router;

?>
<div id="add_newsmedia">
    <h1 class="page_title">
        <?= $titleForLayout; ?>
    </h1>

    <?php if (isset($authUser['group_id']) && $authUser['group_id'] == 3): ?>
        <p>
            Planning to be out of the office?  Sign up a coworker to be notified when upcoming commentaries are available for publication by your news organization.   Once signed up, your colleague will receive an email explaining that he/she will be notified when new Weekly Commentaries by Michael Hicks are available.
        </p>
        <p>
            This email will also include information for how to update contact information, unsubscribe, and/or add fellow members of your news organization to the notification list.
        </p>
    <?php else: ?>
        <p>
            When you subscribe members of the newsmedia to the Weekly Commentary newsmedia alert service,
            they will immediately receive an introductory email. This will explain that they will begin
            receiving email alerts whenever upcoming commentaries are available.
        </p>
        <p>
            The introductory email will contain login information in case the subscriber wants to change
            his or her contact information, stop receiving emails, or add other members of the newsmedia
            to this    service.
        </p>
    <?php endif; ?>

    <?php
        echo $this->Form->create($user);
        echo $this->Form->input('name');
        echo $this->Form->input('email');
        echo $this->Form->input('password', [
            'type' => 'text',
            'required' => true,
            'value' => $password
        ]);
        if (isset($nextCommentary) && ! empty($nextCommentary)) {
            $articleTitle = $nextCommentary['title'];
            $date = date('l, F jS', strtotime($nextCommentary['published_date']));
            $url = Router::url([
                'controller' => 'commentaries',
                'action' => 'view',
                'id' => $nextCommentary['id'],
                'slug' => $nextCommentary['slug']
            ]); ?>
        <label>
            <?= $this->Form->input('send_alert', [
                'type' => 'checkbox',
                'label' => false
            ]); ?>
            Immediately send this reporter an alert for the article <a href="<?= $url ?>"><?= $articleTitle ?></a>, due to be published on <?= $date ?>?
        </label>
        <?php

        }
        echo $this->Form->submit('Add');
        echo $this->Form->end();
    ?>
</div>
