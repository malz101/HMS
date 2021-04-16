<div class='sidebar'>
            <div>
                <label>Cluster:</label>
                <p><?php echo $owner->getClusterName()?></p>
                <label>Household:</label>
                <p><?php echo $owner->getHousehold()?></p>
                <label>Room Number:</label>
                <p><?php echo $owner->getRoomNum()?></p>
                <label>Assigned To:</label>
                <p><?php if(gettype($mtn)=='object'){echo ($mtn->getFirstName().' '.$mtn->getLastName());}else{echo "";}?></p>
                <label>Type:</label>
                <p><?php echo $issue->getClassification()?></p>
                <label>Status:</label>
                <p id='status'><?php echo $issue->getStatus()?></p>
            </div>

            <?php if($_SESSION['user_type']=='admin'):?>
                <div id="update-issue-forms">
                    <div class="update-issue-form">
                        <?php require_once 'admin/update-issue-forms.php';?>
                    </div>
                    
                    <div class="update-issue-form">
                        <label for="assign maintenance">Assign Maintenace Personnel</label>
                        <button id="assign-maintenance-btn" class="btn-filled purple w-button">Assign</button>
                    </div>
                </div>
            <?php endif ?>

            <?php if($_SESSION['user_type']=='mtnpersonnel'):?>
                <div class="update-issue-form">
                    <?php require_once 'mtnpersonnel/schedule-repair.php'?>
                </div>
            <?php endif ?>
            
        </div>