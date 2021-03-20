<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="hero-section">
  <div class="column w-row">
    <div class="w-col w-col-11">
      <div class="hero-card">
        <h2>AZ Preston Hall Management System</h2>
        <h5>View All Issues</h5>

        <?php foreach ($data['issues'] as $issue): ?>
          <div class="hero-card">
            <h3>Issue ID: <?php echo $issue['issueID']?></h3>
            <h6>Date: <?php echo $issue['date']?></h6>
            <h6>Classification: <?php echo $issue['classification'] ?></h6>
            <h6>Status: <?php echo $issue['status'] ?></h6>
            <h6>Description: <?php echo $issue['description'] ?></h6>
          </div>
        <?php endforeach ?>
      </div>
    </div>
    <div class="w-col w-col-1"></div>
  </div>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>
