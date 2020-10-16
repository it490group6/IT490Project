#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function authentication($email,$userpass)
{

      $host = 'localhost';
      $user = 'usr';
      $dbpass = 'password';
      $db = 'accounts';
      $mysqli = new mysqli($host,$user,$dbpass,$db);
      if($mysqli->connect_errno){
        echo "\nMaster server down, switching to backup...\n";
        $host = '192.168.43.25';
        $user = 'usr';
        $dbpass = 'password';
        $db = 'accounts';
       $mysqli = new mysqli($host,$user,$dbpass,$db) or die($mysqli->error);
      }
      else{
        echo "Using master.\n";
      }

      $userinfo = array();

      $email = $mysqli->escape_string($email);
      $result = $mysqli->query("SELECT * FROM users WHERE email='$email' and pa>

      $user = $result->fetch_assoc();

      if ( $result->num_rows == 0 ){ // User doesn't exist
          echo "Incorrect Credentials\n";
          return false;
      }
      else { // User exists
          echo "Correct Credentials, logging in...\n";
          $userinfo['email'] = $user['email'];
          $userinfo['first_name'] = $user['first_name'];
          $userinfo['last_name'] = $user['last_name'];
          $userinfo['active'] = $user['active'];
          return json_encode($userinfo);
      }

}



function requestProcessor($request)
{
echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "Login":
      return authentication($request['email'],$request['password']);
      break;
    case "Register":
      return registration($request['firstname'],$request['lastname'],$request['>
      break;
  }
  return array("returnCode" => '0', 'message'=>"Server received request and pro>
}
$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>
