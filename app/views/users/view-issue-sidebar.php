<div class='sidebar'>
            <div>
                <label>Cluster:</label>
                <p><?php echo $owner->getClusterName()?></p>
                <label>Household:</label>
                <p><?php echo $owner->getHousehold()?></p>
                <label>Room Number:</label>
                <p><?php echo $owner->getRoomNum()?></p>
                <label>Assigned To:</label>
                <p><?php echo ($mtn->getFirstName().' '.$mtn->getLastName());?></p>
                <label>Type:</label>
                <p><?php echo $issue->getClassification()?></p>
                <label>Status:</label>
                <p id='status'><?php echo $issue->getStatus()?></p>
            </div>

            <?php if($_SESSION['user_type']=='admin'){require_once 'admin/update-issue-forms.php';}?>
        </div>