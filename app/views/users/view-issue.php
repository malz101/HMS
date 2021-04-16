<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
$issue = $data['issue']['issue'];
$mtn = $data['issue']['mtn'];
$admin = $data['issue']['admin'];
$owner = $data['issue']['owner'];
$feedbacks = $issue->getFeedbacks();
?>
<div id='<?php echo $issue->getID()?>' class="issue hero-section">
    <div class='container hero-card'>
        <div class='header'>
            <h1 class="issue-subject"><?php echo $issue->getSubject()?></h1>
            <h3>Issue <?php echo $issue->getID()?></h3>
        </div>
        <div class='issue-body'>
            <p class='description'><?php echo $issue->getDescription()?></p>
            <p class='creation-date'>> Issue created on <?php echo $issue->getDate()?> by <?php echo $owner->getFirstName()?> <?php echo $owner->getLastName()?> (<?php echo $owner->getID()?>)</p>
            <p class='updated-date'>> Last updated on <?php echo $issue->getUpdatedOn()?> by <?php if(gettype($admin)=='object'){echo ($admin->getFirstName().' '.$admin->getLastName());}else{echo "";} ?></p>
        </div>

        <div class="feedback-section form-card">
            <h4>Feedbacks</h4>
            <div class="issue-Feedbacks">
                <?php foreach($feedbacks as $feedback):?>
                    <p class="feedback"><?php echo $feedback->getComment()?></p>
                        <p class="feedback-meta-data">>Logged on: <?php echo $feedback->getDate()?></p>
                        <p class="feedback-meta-data"><?php if($feedback->getRead()==1){echo '> Read';}?></p>
                    </p>
                <?php endforeach?>
            </div>

            <?php if($_SESSION['user_type']=='resident'){require_once 'resident/feedback-form.php';}?>
        </div>
        
        <?php require_once 'view-issue-sidebar.php'?>
    </div>

    <?php if($_SESSION['user_type']=='admin'){require_once 'admin/assign-mtn-personnel.php';}?>

    <?php if($_SESSION['user_type']=='mtnpersonnel'){require_once 'mtnpersonnel/schedule-repair.php';}?>
</div>
<?php
require APPROOT . '/views/includes/footer.php';
?>
