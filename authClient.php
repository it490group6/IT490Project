#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function authentication($email, $password) {

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");//Check this part in the .ini file
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Login";
}

$request = array();
$request['type'] = "login";
$request['email'] = $email;
$request['password'] = $password;
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
}
