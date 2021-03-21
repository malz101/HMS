<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
$issue = $data['issue'][0];
$feedbacks = $data['issue'][1];
?>
<div id='issue'>
    <div class='container hero-card'>
        <div class='header'>
            <h1 class="issue-subject"><?php echo $issue['subject']?></h1>
            <h3>Issue <?php echo $issue['issueID']?></h3>
        </div>
        <div class='issue-body'>
            <p class='description'><?php echo $issue['description']?></p>
            <p class='creation-date'>> Issue created on <?php echo $issue['date']?> by <?php echo $issue['rfname']?> <?php echo $issue['rlname']?> (<?php echo $issue['HMemberIDnum']?>)</p>
            <p class='updated-date'>> Last updated on <?php echo $issue['updated_on']?> by <?php echo ($issue['afname'].' '.$issue['alname']);?></p>
        </div>

        <div class="feedback-section form-card">
            <h4>Feedbacks</h4>
            <div class="issue-Feedbacks">
                <?php foreach($feedbacks as $feedback):?>
                    <p class="feedback"><?php echo $feedback['comment']?></p>
                        <p class="feedback-meta-data">>Logged on: <?php echo $feedback['date']?></p>
                        <p class="feedback-meta-data"><?php if($feedback['isRead']==1){echo '> Read';}?>
                        </p>
                    </p>
                <?php endforeach?>
            </div>

            <?php if($_SESSION['user_type']=='resident'){require_once 'resident/feedback-form.php';}?>
        </div>
        
        <div class='sidebar'>
            <div>
                <label>Cluster:</label>
                <p><?php echo $issue['cluster_name']?></p>
                <label>Household:</label>
                <p><?php echo $issue['household']?></p>
                <label>Room Number:</label>
                <p><?php echo $issue['room_num']?></p>
                <label>Assigned To:</label>
                <p><?php echo ($issue['mtnfname'].' '.$issue['mtnlname']);?></p>
                <label>Type:</label>
                <p><?php echo $issue['classification']?></p>
                <label>Status:</label>
                <p id='status'><?php echo $issue['status']?></p>
            </div>

            <?php if($_SESSION['user_type']=='admin'){require_once 'admin/update-issue-form.php';}?>
        </div>
    </div>
</div>
<?php
require APPROOT . '/views/includes/footer.php';
?>
