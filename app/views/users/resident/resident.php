<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="section">
  <div class="function-section">
    <div class="functions">
      <a  href="<?php echo URLROOT; ?>/issue/logIssue" id="log-issue" class="function-card w-inline-block">
        <h3 class="white funcard">Log new issue</h3>
      </a>
      <a href="<?php echo URLROOT; ?>/issue/viewAll" id="track-issue" class="function-card w-inline-block">
        <h3 class="white funcard">View All Your Issues</h3>
      </a>

      <a href="<?php echo URLROOT; ?>/feedback/logFeedback" class="function-card w-inline-block">
        <h3 class="white funcard">Give Feedback</h3>
      </a>

      <a href="#" class="function-card w-inline-block">
        <h3 class="white funcard">Schedule<br>Maintenance</h3>
      </a>

      <a href="#" class="function-card w-inline-block">
        <h3 class="white funcard">Washroom Schedule</h3>
      </a>
    </div>
  </div>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>
