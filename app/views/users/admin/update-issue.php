<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>

<div class="hero-section">
  <div class="form-columns w-row">
    <div class="w-col w-col-6">
      <div class="form-card">
        <h2>Az Preston Hall Maintenance System</h2>
        <h5>Update Issue Status</h5>
        <div class="form w-form">
          <form action="<?php echo URLROOT; ?>/issue/updateIssue" method="POST" id="update-issue-form" name="update-issue-form" data-name="Update Issue Form" class="w-clearfix">
            <label for="name">Issue ID</label>
            <input id="iid" name="iid" type="text" class="w-input" maxlength="256"  data-name="Issue ID" placeholder="Issue ID"  required="">
            
            <label for="status">Issue Status</label>
            <select id="status" name="status" required="" data-name="Status" class="w-select">
              <option value="PENDING">Pending</option>
              <option value="FIXING">Fixing</option>
              <option value="FOLLOW UP">Follow up</option>
              <option value="RESOLVED">Resolved</option>
            </select>

            <h6>All Fields are Mandatory</h6>
            <input id="submit-update-issue" type="submit" value="Submit" data-wait="Please wait..." class="btn-filled blue w-button">
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
    <div class="w-col w-col-6"><img src="<?php echo URLROOT ?>/public/images/status.png" srcset="<?php echo URLROOT ?>/public/images/status.png 500w, <?php echo URLROOT ?>/public/images/status.png 800w, <?php echo URLROOT ?>/public/images/status.png 1080w, <?php echo URLROOT ?>/public/images/status.png 1250w" sizes="(max-width: 479px) 92vw, (max-width: 767px) 87vw, (max-width: 991px) 41vw, (max-width: 2906px) 43vw, 1250px" alt=""></div>
  </div>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>