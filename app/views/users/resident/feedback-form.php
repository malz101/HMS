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