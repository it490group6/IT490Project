<?php

require ('./authClient.php');
$email = $_POST['username'];
$pass = $_POST['password'];

$response = authentication($email, $pass);

if($response == false){
      echo "Login Failed";
      $_SESSION['message'] = "Invalid email or password, try again!";
      header("location: fail.php");
}
else{
      echo "Login Successful";
      $userinfo = json_decode($response, true);
      $_SESSION['logged_in'] = true;
      $_SESSION['email'] = $userinfo['email'];
      $_SESSION['first_name'] = $userinfo['first_name'];
      $_SESSION['last_name'] = $userinfo['last_name'];
      $_SESSION['active'] = $userinfo['active'];
      header("location: success.php");
}
?>





