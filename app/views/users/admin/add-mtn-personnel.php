<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="hero-section">
  <div class="form-columns w-row">
    <div class="w-col w-col-6">
      <div class="form-card">
        <h2>Az Preston Hall Maintenance System</h2>
        <h5>Add Maintennace Personnel</h5>

        <span class="invalidFeedback"><?php echo $data['addUserError']; ?></span>
        <span class="invalidFeedback"><?php echo $data['message']; ?></span>

        <div class="form w-form">
          <form action="<?php echo URLROOT; ?>/admin/addMtnPersonnel" method="POST" id="add-resident-form" name="add-resident-form" data-name="Add Resident Form" class="w-clearfix">
            <div class="form-group">
              <label for="mid">ID Number</label> 
              <input id="mid" name="mid" type="text" class="w-input" maxlength="256"  data-name="ID number" placeholder="Enter user id number" required>
              <span class="invalidFeedback"><?php echo $data['idError']; ?></span>
            </div>

            <div class="form-group">
              <label for="fname">First Name</label> 
              <input id="fname" name="fname" type="text" class="w-input" maxlength="256"  data-name="First Name" placeholder="Enter user first name" required>
            </div>

            <div class="form-group">
              <label for="lname">Last Name</label>
              <input id="lname" name="lname" type="text" class="w-input" maxlength="256"  data-name="Last Name" placeholder="Enter user last name" required>
            </div>

            <div class="form-group">
              <label for="tele">Phone Number</label>
              <input id="tele" name="tele" type="text" class="w-input" maxlength="256"  data-name="tele" placeholder="Enter user phone number" required>
            </div>
            
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" name="email" type="text" class="w-input" maxlength="256"  data-name="email" placeholder="Enter user email"  required>
            </div>

            <div class="form-group">
              <label for="affiliation">Affiliation</label>
              <input id="affiliation" name="affiliation" type="text" class="w-input" maxlength="256"  data-name="affiliation" placeholder="Enter user affiliation" required>
            </div>

            <div class="form-group">
              <label for="password">Password</label> 
              <input id="password" name="password" type="password" class="w-input" maxlength="256"  data-name="Password" placeholder="Enter user password" required>
            </div>

            <h6>All Fields are Mandatory</h6>
            <input id="add-user" type="submit" value="Submit" data-wait="Please wait..." class="btn-filled blue w-button">
          </form>
        </div>
      </div>
    </div>

    <div class="w-col w-col-6"><img src="<?php echo URLROOT ?>/images/add-user.png" srcset="<?php echo URLROOT ?>/images/add-user.png 500w, <?php echo URLROOT ?>/images/add-user.png 751w" sizes="(max-width: 479px) 92vw, (max-width: 767px) 87vw, 41vw" alt=""></div>
  
  </div>
</div>
<?php
require APPROOT . '/views/includes/footer.php';
?>
