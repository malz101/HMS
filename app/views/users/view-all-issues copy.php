<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="hero-section">
    <div class="hero-card table-container">
      <h2>AZ Preston Hall Management System</h2>
      <h3>View All Issues</h3>
      <?php require_once 'filter-search-bar.php'?>
      <?php if($data['message']!='empty'):?>
        <table>
          <thead>
            <tr>
              <th class="issue-id-column">Issue #</th>
              <th>Subject</th>
              <th>Type</th>
              <th>Status</th>
              <th>Assigned To</th>
              <th>Created</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data['issues'] as $issue): ?>
              <tr id=".<?php echo $issue['issue']->getID()?>" data-href="<?php echo URLROOT ?>/user/viewIssue/<?php echo $issue['issue']->getID()?>">
                <td class="issue-id-column"><?php echo $issue['issue']->getID()?></td>
                <td><?php echo $issue['issue']->getSubject()?></td>
                <td><?php echo $issue['issue']->getClassification()?></td>
                <td><?php echo $issue['issue']->getStatus() ?></td>
                <td><?php echo ($issue['mtn']->getFirstName().' '.$issue['mtn']->getLastName());?></td>
                <td><?php echo date($issue['issue']->getDate())?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table> 
      <?php else: ?>
        <p>No Issues Found.</p>
      <?php endif?>
    </div>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>
