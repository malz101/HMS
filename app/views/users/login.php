<?php
require APPROOT . '/views/includes/header.php';
?>
<div class="hero-section">
  <form action="<?php echo URLROOT; ?>/user/login" method="POST" id="loginform" name="login-form" class="log-in-form form">
    <h4>Log In to AZ Preston HMS</h3>
    <span class="invalidFeedback">
          <?php echo $data['loginError']; ?>
    </span>
    <div class='form-group'>
      <label for="id">ID number:</label>
      <input id="id" name="id" type="text" class="w-input" maxlength="256"  data-name="ID"  required>
      <span class="invalidFeedback">
              <?php echo $data['idError']; ?>
      </span>
    </div>

    <div class='form-group'>
      <label for="email">Password:</label>
      <input id="password" name="password" type="password" class="w-input" maxlength="256"  data-name="Password"  required>
      <span class="invalidFeedback">
        <?php echo $data['passwordError']; ?>
      </span>
    </div>

      <input type="submit" value="Login" data-wait="Please wait..." class="submit-button w-button">

  </form>
<img src="<?php echo URLROOT ?>/public/images/buildings-1.png" srcset="<?php echo URLROOT ?>/public/images/buildings-1-p-500.png 500w, <?php echo URLROOT ?>/public/images/buildings-1-p-800.png 800w, <?php echo URLROOT ?>/public/images/buildings-1.png 1137w" sizes="(max-width: 1137px) 100vw, 1137px" alt="" class="image">
<?php
require APPROOT . '/views/includes/footer.php';
?>