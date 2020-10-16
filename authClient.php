equire_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function authentication($email, $pass){
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
$request['password'] = $pass;
$request['message'] = $msg;
$response = $client->send_request($request);
/$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
return ($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
}
?>
