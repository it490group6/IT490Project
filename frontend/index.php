<?php
/* Main page with two forms: sign up and log in */
require './db.php';

session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign-Up/Login Form</title>
  <?php include 'css/css.html'; ?>
  <link rel="stylesheet" href="css/style.css">
</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['login'])) { //user logging in

        require 'back/login.php';

    }

  
}
?>
<body>
  <div class="form">

      <ul class="tab-group">
        <li class="tab"><a href="#signup">Create Account</a></li>
        <li class="tab active"><a href="#login">Log In</a></li>
      </ul>
