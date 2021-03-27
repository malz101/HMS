<div class='sidebar'>
            <div>
                <label>Cluster:</label>
                <p><?php echo $issue['cluster_name']?></p>
                <label>Household:</label>
                <p><?php echo $issue['household']?></p>
                <label>Room Number:</label>
                <p><?php echo $issue['room_num']?></p>
                <label>Assigned To:</label>
                <p><?php echo ($issue['mtnfname'].' '.$issue['mtnlname']);?></p>
                <label>Type:</label>
                <p><?php echo $issue['classification']?></p>
                <label>Status:</label>
                <p id='status'><?php echo $issue['status']?></p>
            </div>

            <?php if($_SESSION['user_type']=='admin'){require_once 'admin/update-issue-forms.php';}?>
        </div>