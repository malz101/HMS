<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="hero-section">
  <div class="form-columns w-row">
    <div class="w-col w-col-6">
      <div class="form-card">
        <h2>Az Preston Hall Maintenance System</h2>
        <h5>Give Feedback</h5>
        <div class="form w-form">
          <form href="<?php echo URLROOT; ?>/feedback/logFeedback" method="POST" id="feedback-form" name="feedback-form" data-name="Feedback Form" class="w-clearfix">
            <span class="invalidFeedback"><?php echo $data['giveFeedbackError']; ?></span>
            <span class="invalidFeedback"><?php echo $data['message']; ?></span>
            <div class="form-group">
              <label for="iid">Issue ID</label>
              <input id='iid' name="iid" type="text" class="w-input" maxlength="256"  data-name="isseue id" placeholder="Enter issue number" required>
            </div>

            <div class="form-group">
              <label for="comment">Comment</label>
              <textarea id="comment" name="comment" type="text" class="description-field w-input" data-name="Feedback" placeholder="feedback" required></textarea>
              <span class="invalidFeedback"><?php echo $data['commentError']; ?></span>
            </div>
            <h6>All Fields are Mandatory</h6>
            <input id="give-feedback" type="submit" value="Submit" data-wait="Please wait..." class="btn-filled blue w-button">
          </form>

          <div class="w-form-done">
            <div>Thank you! Your submission has been received!</div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </div>
    </div>

    <div class="w-col w-col-6"><img src="<?php echo URLROOT ?>/images/feedback.png" srcset="<?php echo URLROOT ?>/images/feedback.png 500w, <?php echo URLROOT ?>/images/feedback.png 780w" sizes="100vw" alt=""></div>
  
  </div>
</div>
<?php
require APPROOT . '/views/includes/footer.php';
?>