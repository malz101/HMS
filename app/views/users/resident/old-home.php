<?php
session_start();
require 'backend/classes.php';
#echo "<script>console.log('From old home: " . $_SESSION['isLogged'] ."')</script>";
if($_SESSION['isLogged'] === FALSE){
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Sun Nov 24 2019 22:40:25 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5dd89354578bab02bf18ce40" data-wf-site="5dd89354578babc32818ce3f">
<head>
  <meta charset="utf-8">
  <title>AZ preston Hall Management System</title>
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script src="azph_hms.js" type="text/javascript"></script>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/az-preston-hall-management-system.webflow.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Roboto:100,300,300italic,regular,500,700,900"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body>
  <div data-collapse="medium" data-animation="default" data-duration="400" class="navbar w-nav">
    <div class="w-container">
      <nav role="navigation" class="w-nav-menu"><a href="#" class="navbtn w-button">Notifications</a></nav><a href="#" class="nav-link w-nav-link">Home</a><a href="#" class="nav-link w-nav-link">Admin</a><a class="nav-link w-nav-link sign-out">Sign Out</a>
      <div class="w-nav-button">
        <div class="w-icon-nav-menu"></div>
      </div>
    </div>
  </div>
  <div class="hero-section">
    <div class="w-row">
      <div class="w-col w-col-6"><img src="images/reading-2.png" srcset="images/reading-2-p-500.png 500w, images/reading-2.png 587w" sizes="(max-width: 479px) 67vw, (max-width: 767px) 587px, (max-width: 804px) 73vw, 41vw" alt=""></div>
      <div class="w-col w-col-6">
        <div class="hero-card">
          <h1>AZ Preston Hall Maintenance System</h1>
          <h3>&gt;&gt; All Feedback Messages</h3>
          <h5>&quot;Pursuing Excellence”</h5>
          <input type="text" class="w-input" maxlength="256" name="isseue-id" data-name="isseue id" placeholder="Enter issue number" id="feedb-load" style="width: 180px">
          <a id="load-feedback" class="btn-outline w-button">Load Feedback</a>
          <?php
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
              if(!empty($_POST['issueID'])){
                $load_feedback = new FeedbackController($data_store);
                $load_feedback->loadFeedbackFromIssue($_POST['issueID']);
                $feedback_list = $load_feedback->sendFeedback();
                ?>
                <!---->
                <?php foreach($feedback_list as $feedbackI): ?>
                  <div class="form-card"> <!---->
                    <h1>From: <?= $feedbackI->getSender();?></h1>
                    <h5>Comment: <?= $feedbackI->getComment();?></h5>
                    <div class="viewissue">
                      <!--<h6>Issue Number:</h6>-->
                      <h6>Date Logged: <?= $feedbackI->getDate();?></h6>
                      <h6>Status: <?= $feedbackI->isRead();?></h6>
                      <p id="feedback-id" style="display: hidden"></p>
                      <a href="give-feedback.php">Add feedback</a>
                    </div>
                  </div> <!---->
                <?php endforeach; ?>
                <!---->
              <?php
              #exit("PASSED");
              } else {
                exit("<script>alert('Please enter issue number')</script>");
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="section">
    <div class="function-section">
      <div class="functions">
        <a id="log-issue" class="function-card w-inline-block">
          <h3 class="white funcard">Log new issue</h3>
        </a>
        <a id="track-issue" class="function-card w-inline-block">
          <h3 class="white funcard">View All Your Issues</h3>
        </a>
        <a href="#" class="function-card w-inline-block">
          <h3 class="white funcard">View All Issues</h3>
        </a>
        <a href="#" class="function-card w-inline-block">
          <h3 class="white funcard">Schedule<br>Maintenance</h3>
        </a>
        <a href="give-feedback.php" class="function-card w-inline-block">
          <h3 class="white funcard">Give Feedback</h3>
        </a>
        <a href="#" class="function-card w-inline-block">
          <h3 class="white funcard">Washroom Schedule</h3>
        </a>
      </div>
    </div>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>
