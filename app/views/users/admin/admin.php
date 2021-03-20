<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="function-section">
  <div class="functions">

    <a href="<?php echo URLROOT; ?>/issue/viewAll" class="function-card">
      <div class="funcard">
        <img src="<?php echo URLROOT ?>/public/images/text_files.svg" alt="">
        <h3 class="white">View All Issues</h3>
      </div>
    </a>

    <a href="<?php echo URLROOT; ?>/issue/updateIssue" class="function-card w-inline-block">
      <div class="funcard">
        <img src="<?php echo URLROOT ?>/public/images/update.svg" alt="">
        <h3 class="white">Update issue Progress</h3>
      </div>
    </a>

    <a href="<?php echo URLROOT; ?>/feedback/viewFeedback" class="function-card w-inline-block">
      <div class="funcard">
        <img src="<?php echo URLROOT ?>/public/images/view_reviews.svg" alt="">
        <h3 class="white">View Feedback</h3>
      </div>
    </a>

    <a href="#" class="function-card w-inline-block">
      <div class="funcard">
        <img src="<?php echo URLROOT ?>/public/images/date_picker.svg" alt="">
        <h3 class="white">Schedule<br>Maintenance</h3>
      </div>
    </a>

    <a href="#" class="function-card w-inline-block">
      <div class="funcard">
        <img src="<?php echo URLROOT ?>/public/images/reports.svg" alt="">
        <h3 class="white">Generate Reports</h3>
      </div>
    </a>

    <a href="<?php echo URLROOT; ?>/resident/addResident" class="function-card w-inline-block">
      <div class="funcard">
        <img src="<?php echo URLROOT ?>/public/images/add_user.svg" alt="">
        <h3 class="white">Add Resident</h3>
      </div>
    </a>

    <a href="<?php echo URLROOT; ?>/mtnpersonnel/addMaintenance" class="function-card w-inline-block">
      <div class="funcard">
        <img src="<?php echo URLROOT ?>/public/images/add_user.svg" alt="">
        <h3 class="white">Add Maintenance Personnel</h3>
      </div>
    </a>
  </div>
</div>
<?php
require APPROOT . '/views/includes/footer.php';
?>