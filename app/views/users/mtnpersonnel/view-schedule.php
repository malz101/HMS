<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div id="all-issues-section" class="hero-section">
    <div class="hero-card table-container">
      <h2>AZ Preston Hall Management System</h2>
      <h3>View All Issues</h3>
      <?php if($data['message']!='empty'):?>
        <table>
          <thead>
            <tr>
              <th class="issue-id-column">Issue #</th>
              <th>Date Time</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data['slots'] as $slot): ?>
              <tr id=".<?php echo $slot->getIssueID()?>" data-href="">
                <td class="issue-id-column"><?php echo $slot->getIssueID()?></td>
                <td><?php echo $slot->getDateTime()?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table> 
      <?php else: ?>
        <p>No Repairs Found.</p>
      <?php endif?>
    </div>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>
