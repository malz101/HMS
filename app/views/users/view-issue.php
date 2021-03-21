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
            <h4>Feedback</h4>
            <div class="issue-Feedbacks">
                <?php foreach($feedbacks as $feedback):?>
                    <p class="feedback"><?php echo $feedback['comment']?></p>
                        <p class="feedback-meta-data">>Logged on: <?php echo $feedback['date']?></p>
                        <p class="feedback-meta-data"><?php if($feedback['isRead']==1){
                                        echo '> Read';
                                    }?>
                        </p>
                    </p>
                <?php endforeach?>
            </div>
            <?php if($_SESSION['user_type']=='resident'):?>
                <span class="invalidFeedback"><?php echo $data['giveFeedbackError']; ?></span>
                    <span class="invalidFeedback"><?php echo $data['feedback-message']; ?></span>
                <form action="<?php echo URLROOT; ?>/issue/logFeedback/<?php echo $issue['issueID'] ?>" method="POST" class="feedback-form" id="feedback-form">
                    <div class="form-group">
                        <textarea id="comment" name="comment" type="text" class="description-field w-input" data-name="Feedback" placeholder="feedback" required></textarea>
                        <span class="invalidFeedback"><?php echo $data['commentError']; ?></span>
                        <button type="submit" id='submit-feedback-btn'>Submit</button>
                    </div>
                </form>
                <button class='add-feedback-btn'>Add Feedback</button>
            <?php endif?>
        </div>
        
        <div class='sidebar'>
            <div>
                <label>Assigned To:</label>
                <p><?php echo ($issue['mtnfname'].' '.$issue['mtnlname']);?></p>
                <label>Type:</label>
                <p><?php echo $issue['classification']?></p>
                <label>Status:</label>
                <p id='status'><?php echo $issue['status']?></p>
            </div>

            <?php if($_SESSION['user_type']=='admin'):?>
                        <form action="<?php echo URLROOT; ?>/issue/updateIssue/<?php echo $issue['issueID']?>" method="POST" id="update-issue-form" name="update-issue-form" data-name="Update Issue Form" class="w-clearfix">
                            
                            <label for="status">Issue Status</label>

                            <select id="status" name="status" required="" data-name="Status" class="w-select">
                                <option value="PENDING">Pending</option>
                                <option value="FIXING">Fixing</option>
                                <option value="FOLLOW UP">Follow up</option>
                                <option value="RESOLVED">Resolved</option>
                                </select>
                                <span class="invalidFeedback"><?php echo $data['updateMessage']; ?></span>
                                <span class="invalidFeedback"><?php echo $data['updateIssueError']; ?></span>
                            <input id="submit-update-issue" type="submit" value="Submit" data-wait="Please wait..." class="btn-filled blue w-button">
                        </form>
            <?php endif?>
        </div>
    </div>
</div>
<?php
require APPROOT . '/views/includes/footer.php';
?>
