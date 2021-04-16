<form action="<?php echo URLROOT; ?>/mtn/scheduleRepair/<?php echo $issue->getID()?>" method="POST" id="schedule-repair-form" name="schedule-repair-form" data-name="Schedule Repair Form" class="w-clearfix">

  <label for="schedule-slot">Schedule Repair</label>
  <select id="schedule-slot" name="slot" required="" data-name="Slot" class="w-select" onChange="this.form.submit()">
      <option>--Select Date and Time--</option>
      <?php $today = date("Y-m-d"); #in format "Y-m-d ", ie: "2019-11-24"
            $hour = 8;#used to keep track of the time of day to schedule repair, 24 hour format
            $enddate = date("Y-m-d",strtotime($today.''.' + 15 days'));
      ?>
      <?php for ($i=0; $i < 16; $i++):?>
        <?php for ($hcount=0; $hcount < 9; $hcount++): ?>
          <?php $slot = (date("Y-m-d",strtotime($today.''.' + '.$i.' days'))).' ';
              if ($hour+$hcount<10){
                $slot = $slot.'0'.($hour+$hcount.':00:00');
              }else{
                $slot = $slot.($hour+$hcount.':00:00');
              }
          ?>
          <option value="<?php echo $slot?>"><?php echo $slot ?></option>
        <?php endfor?>
      <?php endfor?>
  </select>
  <div class="schedule-repair-message-area">
      <span class="validFeedback"><?php echo $data['updateMessage']; ?></span>
      <span class="invalidFeedback"><?php echo $data['updateIssueError']; ?></span>
  </div>  
                 
</form>

