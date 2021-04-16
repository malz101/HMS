<div id="all-repairs-section">
    <h6>Repairs scheduled</h6>
    <?php if($slots):?>
    <table style="max-width:180px; margin-bottom:2rem;">
        <thead>
        <tr>
            <th>Date Time</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($slots as $slot): ?>
            <tr id=".<?php echo $slot->getIssueID()?>" data-href="">
                <td><?php echo $slot->getDateTime()?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table> 
    <?php else: ?>
    <p>Issue has not been scheduled for repair as yet.</p>
    <?php endif?>
</div>