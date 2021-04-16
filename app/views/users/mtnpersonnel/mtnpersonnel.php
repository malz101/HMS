<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="section">
  <div class="function-section">
    <div class="functions">
      <a href="<?php echo URLROOT; ?>/user/viewAll" id="track-issue" class="function-card w-inline-block">
        <h3 class="white funcard">View All Repairs</h3>
      </a>

      <a href="<?php echo URLROOT; ?>/mtn/viewSchedule" class="function-card w-inline-block">
        <h3 class="white funcard">View Schedule</h3>
      </a>
    </div>
  </div>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>
