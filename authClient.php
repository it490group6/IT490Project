#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function authentication($email, $password){
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "login";
}

$request = array();
$request['type'] = "Login";
$request['email'] = $email;
$request['password'] = $password;
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
return ($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
}

function registration($firstname, $lastname, $password, $email){
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "register";
}

$request = array();
$request['type'] = "Register";
$request['email'] = $email;
$request['firstname'] = $firstname;
$request['lastname'] = $lastname;
$request['password'] = $password;
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
return ($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
}
