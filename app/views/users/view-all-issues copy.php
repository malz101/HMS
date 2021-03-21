<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="hero-section">
    <div class="hero-card table-container">
      <h2>AZ Preston Hall Management System</h2>
      <h3>View All Issues</h3>
      <?php require_once 'filter-search-bar.php'?>
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
            <tr id=".<?php echo $issue['issueID']?>" data-href="<?php echo URLROOT ?>/issue/viewIssue/<?php echo $issue['issueID']?>">
              <td class="issue-id-column"><?php echo $issue['issueID']?></td>
              <td><?php echo $issue['subject']?></td>
              <td><?php echo $issue['classification']?></td>
              <td><?php echo $issue['status'] ?></td>
              <td><?php echo ($issue['mtnfname'].' '.$issue['mtnlname']);?>
              </td>
              <td><?php echo date($issue['date'])?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>   
    |</div>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>
