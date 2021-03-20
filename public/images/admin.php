<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php'
?>
<div class="function-section">
  <div class="functions">
    <a href="view-all-issues.php" class="function-card w-inline-block">
      <div class="funcard">
        <img src="images/text_files.svg" alt="" srcset="">
        <h3 class="white">View All Issues</h3>
      </div>
    </a>

    <a href="add-user.html" class="function-card w-inline-block">
      <div class="funcard">
      <img src="images/add_user.svg" alt="">
        <h3 class="white">Add User</h3>
      </div>
    </a>

    <a href="update-issue.php" class="function-card w-inline-block">
      <div class="funcard">
        <img src="images/update.svg" alt="">
        <h3 class="white">Update issue Progress</h3>
      </div>
    </a>

    <a href="view-feedback.html" class="function-card w-inline-block">
      <div class="funcard">
        <img src="images/view_reviews" alt="">
        <h3 class="white">View Feedback</h3>
      </div>
    </a>

    <a href="#" class="function-card w-inline-block">
      <div class="funcard">
        <img src="images/date_picker.svg" alt="">
        <h3 class="white">Schedule<br>Maintenance</h3>
      </div>
    </a>

    <a href="#" class="function-card w-inline-block">
      <div class="funcard">
        <img src="images/reports.svg" alt="">
        <h3 class="white">Generate Reports</h3>
      </div>
    </a>
  </div>
</div>
<?php
require APPROOT . '/views/includes/footer.php';
?>