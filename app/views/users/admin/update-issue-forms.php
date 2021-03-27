

<form action="<?php echo URLROOT; ?>/issue/updateIssue/<?php echo $issue['issueID']?>" method="POST" id="update-issue-form" name="update-issue-form" data-name="Update Issue Form" class="w-clearfix">

    <label for="status">Issue Status</label>
    <select id="status" name="status" required="" data-name="Status" class="w-select" onChange="this.form.submit()">
        <option value="PENDING">Pending</option>
        <option value="FIXING">Fixing</option>
        <option value="FOLLOW UP">Follow up</option>
        <option value="RESOLVED">Resolved</option>
    </select>
    <div class="update-issue-message-area">
        <span class="validFeedback"><?php echo $data['updateMessage']; ?></span>
        <span class="invalidFeedback"><?php echo $data['updateIssueError']; ?></span>
    </div>  
                     
</form>