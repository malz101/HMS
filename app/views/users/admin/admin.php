<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="function-section">
  <div class="functions">

    <a href="<?php echo URLROOT; ?>/user/viewAll" class="function-card">
      <div class="funcard">
        <img src="<?php echo URLROOT ?>/public/images/text_files.svg" alt="">
        <h3 class="white">View All Issues</h3>
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

    <a href="<?php echo URLROOT; ?>/admin/addResident" class="function-card w-inline-block">
      <div class="funcard">
        <img src="<?php echo URLROOT ?>/public/images/add_user.svg" alt="">
        <h3 class="white">Add Resident</h3>
      </div>
    </a>

    <a href="<?php echo URLROOT; ?>/admin/addMtnPersonnel" class="function-card w-inline-block">
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