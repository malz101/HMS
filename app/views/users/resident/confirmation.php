<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="hero-section">
  <div class="confirm-columns w-row">
    <div class="w-col w-col-3"></div>
    <div class="w-col w-col-9">
      <div class="hero-card">
        <h1>Thank you for using the<br>AZ Preston Hall Maintenance System</h1>
        <h5>Data collected here will only be used to improve living conditions on AZ Preston Hall</h5>
        <a href="<?php echo URLROOT?>/resident/home" id="continue-button" class="btn-filled w-button">Continue --&gt;</a></div>
    </div>
</div><img src="<?php echo URLROOT?>/images/gift-1.png" srcset="<?php echo URLROOT?>/images/gift-1-p-500.png 500w, <?php echo URLROOT?>/images/gift-1-p-800.png 800w, <?php echo URLROOT?>/images/gift-1.png 1080w" sizes="100vw" alt=""></div>
<?php
require APPROOT . '/views/includes/footer.php';
?>