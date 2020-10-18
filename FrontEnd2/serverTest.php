 <?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include("server.php");


require('config.php');
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
try{
  $db = new PDO($conn_string, $username, $password);
  $stmt = $db->query("SELECT * FROM users WHERE username = '$username'");
  $result = $stmt->fetch();}
  catch (Exception $e){
  echo $e->getMessage();
  exit("Something went wrong");
}  
 
function requestProcessor($request) {
	echo "Request received".PHP_EOL;
	var_dump($request);

	if(!isset($request['type'])) {
		return "Error: unsupported message type";
	}

	switch ($request['type']) {

		case "Login":
			return doLogin($request['usename'], $request['password']);
/*
		case "logout":
			return doLogout($request['logout']);

		case "profile":
			return getProfile($request['username']);
*/
		
		case "Register":
			print_r($request);
			return doRegister($request['username'], $request['email'], $request['password'], $request['firstname'], $request['lastname']);

		
	}

	return array("returnCode" => '0', 'message' => "Server received request and processed");
}





function doLogin($username, $password,$db) {

    $s = "select * from users where username='$username' and password='$password'";
print "<br>SQL Statement is: $s<br>"  ;
   ($t=mysqli_query($db,$s)) or die (mysqli_error($db));
$num = mysqli_num_rows( $t );
    print "<br>The number of rows retrieved for $ucid is: $num<br><br>"  ;
    $r = mysqli_fetch_array($t, MYSQLI_ASSOC);
    //$hash=$r['hash'];
    //if(password_verify($pass,$hash)){return true;}else{return false;};
}

function get($db,$fieldname)
{
global $db;
$v=$_GET[$fieldname];
$v=trim($v);
$v=mysqli_real_escape_string($db,$v);
return $v;
}







	

$server = new rabbitMQServer("testRabbitMQ.ini", "testServer");
$server->process_requests('requestProcessor');

exit();

?>
