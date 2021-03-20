<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="hero-section">
  <div class="form-columns w-row">
    <div class="w-col w-col-5">
      <div class="form-card">
        <h1>AZ Preston Hall Maintenance System</h1>
        <h5>&gt;&gt;Log Issue</h5>
        <div class="form w-form">
          <form href="<?php echo URLROOT; ?>/issue/logIssue" method="POST" id="issue-form" name="issue-form" data-name="Issue Form" class="w-clearfix">
            <span class="invalidFeedback"><?php echo $data['logIssueError']; ?></span>
            <span class="invalidFeedback"><?php echo $data['message']; ?></span>
            <div class="form-group">
              <label for="classification">Issue category</label>
              <select id="classification" name="classification" required data-name="classification" class="w-select">
                <option value="ADMINISTRATIVE">Administrative</option>
                <option value="APPLIANCE">Appliance</option>
                <option value="ELECTRICAL">Electrical</option>
                <option value="FURNITURE">Furniture</option>
                <option value="INFRASTRUCTURE">Infrastructure</option>
                <option value="PLUMBING">Plumbing</option>
                <option value="ROOM FIXTURES">Room Fixtures</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="Issue-description">Issue description</label>
              <textarea id="description" name="description" class="description-field w-input" rows="6" cols="60" data-name="Issue description" placeholder="Give a short description of the issue..." required></textarea>
              <span class="invalidFeedback"><?php echo $data['descriptionError']; ?></span>
            </div>

            <h6>All Fields are Mandatory</h6>
            <input id="submit-issue" type="submit" value="Submit" data-wait="Please wait..." class="btn-filled blue w-button"></form>
          <div class="w-form-done">
            <div>Thank you! Your submission has been received!</div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-col w-col-7"><img src="<?php echo URLROOT ?>/public/images/form-pic.png" srcset="<?php echo URLROOT ?>/images/form-pic-p-500.png 500w, <?php echo URLROOT ?>/images/form-pic.png 750w" sizes="(max-width: 479px) 67vw, (max-width: 767px) 79vw, 48vw" alt=""></div>
  </div>
</div>
<?php
require APPROOT . '/views/includes/footer.php';
?>