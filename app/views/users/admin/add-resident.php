<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navbar.php';
?>
<div class="hero-section">
  <div class="form-columns w-row">
    <div class="w-col w-col-6">
      <div class="form-card">
        <h2>Az Preston Hall Maintenance System</h2>
        <h5>Add Resident</h5>

        <span class="invalidFeedback"><?php echo $data['addUserError']; ?></span>
        <span class="invalidFeedback"><?php echo $data['message']; ?></span>

        <div class="form w-form">
          <form action="<?php echo URLROOT; ?>/admin/addResident" method="POST" id="add-resident-form" name="add-resident-form" data-name="Add Resident Form" class="w-clearfix">
            <div class="form-group">
              <label for="rid">ID Number</label> 
              <input id="rid" name="rid" type="text" class="w-input" maxlength="256"  data-name="ID number" placeholder="Enter user id number" required>
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
              <label for="cluster">Cluster Name</label>
              <select id="cluster" name="cluster" required="" data-name="cluster" class="w-select">
                <option value="AMSTERDAM">Amsterdam</option>
                <option value="BELGIQUE">Belgique</option>
                <option value="BURGPLATZ">Burgplatz</option>
                <option value="EINHEIT">Einheit</option>
                <option value="ITALIA">Italia</option>
                <option value="LA MAISON">La Maison</option>
                <option value="LOS MATADORES">Los Matadores</option>
                <option value="OLIMPIA">Olimpia</option>
                <option value="PORTO SANTO">Porto Santo</option>
                <option value="SHERWOOD MANOR">Sherwood Manor</option>
                <option value="REGENSEN">Regensen</option>
                <option value="SHAMROCK">Shamrock</option>
                <option value="VIKINGS">Vikings</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="household">Household</label>
              <input id="household" name="household" type="text" class="w-input" maxlength="256"  data-name="household" placeholder="Enter user household"  required>
            </div>

            <div class="form-group">
              <label for="rnum">Room Number</label>
              <input id="rnum" name="rnum" type="text" class="w-input" maxlength="256"  data-name="Issue description" placeholder="Enter user room number" required>
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
