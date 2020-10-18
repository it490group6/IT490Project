 <?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function requestProcessor($request) {
	echo "Request received".PHP_EOL;
	var_dump($request);

	if(!isset($request['type'])) {
		return "Error: unsupported message type";
	}

	switch ($request['type']) {

		case "Login":
			return doLogin($request['email'], $request['password']);
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



function doLogin($username, $password) {

	$date = date("Y-m-d");
	$time = date("h:m:sa");

	$hostname= "25.78.212.215" ;
	$username="testuser";
	$password="Dipish_123!";
	$database="IT490PG6";
	$mysqli = new mysqli($hostname, $username, $password, $database);
	$mysqli->select_db($database) or die( "Unable to select database");
	print "<br>Successfully connected to MySQL.<br>";
	
	$result = $mysqli->prepare("SELECT password FROM users WHERE username = '{$username}'");

	$result->execute();

	$row = $result->fetchAll();

	if (!empty($row)) {
		if (password_verify($password, $row[0]["password"])) {
			
			$log = "$date $time Response Code 202: Success!";

			$response = $mysqli->prepare("SELECT username, firstname, lastname FROM users WHERE username = '{$username}'");
			$response->execute();

			$row = $response->fetchAll();

			return $row;
		
		} else {
			$response = '401';
			$log = "$date $time Response Code 401: Username $username, not authorized.\n";

		return $response;
		}
	
	} else {
		$response = "404";
		$log = "$date $time Response Code 404: Username not found.\n";

		return $response;
		
	
	}

}


function doRegister($username, $email, $password, $firstname, $lastname) {

	$date = date("Y-m-d");
	$time = date("h:m:sa");
	$options = ['length' => 1];
	$hash = password_hash($password, PASSWORD_DEFAULT, $options);
	
	$hostname= "25.78.212.215" ;
	$username="testuser";
	$password="Dipish_123!";
	$database="IT490PG6";
	$mysqli = new mysqli($hostname, $username, $password, $database);
	$mysqli->select_db($database) or die( "Unable to select database");
	print "<br>Successfully connected to MySQL.<br>";

	$result = $mysqli->prepare("SELECT * FROM users where username = '{$username}'");
	$result->execute();

	$row = $result->fetchAll();

	if (!empty($row)) {
		$response = "302";
		$log = "$date $time Response Code 302: Username $username already registered.\n";

		return $response;

	} else {


		$statement = $mysqli->prepare("INSERT INTO users (username, email, password, firstname, lastname) VALUES (:username, :email, :password, :firstname, :lastname)");

		$statement->bindParam(":username", $username);
		$statement->bindParam(":email", $email);
		$statement->bindParam(":password", $hash);
		$statement->bindParam(":firstname", $firstname);
		$statement->bindParam(":lastname", $lastname);

		$statement->execute();

		$response = "$username";
		$log = "$date $time Response Code 201: Email $email successfully added to the database. \n";

		return $response;

	}

}

/*

function getProfile($username) {
	$date = date("Y-m-d");
	$time = date("h:m:sa");

	 $host = '10.192.239.35';
      $user = 'testuser';
      $dbpass = 'Dipish_123!';
      $db = 'IT490PG6';
      print "Sucessfully Connect to Database ";
      $mysqli = new mysqli($host,$user,$dbpass,$db) or die($mysqli->error);

	$result = $pdo->prepare("SELECT * from users WHERE username = '{$username}'");
	$result->exec();
	$row = $result->fetchAll();

	return $row;


}
*/
$server = new rabbitMQServer("testRabbitMQ.ini", "testServer");
$server->process_requests('requestProcessor');

exit();

?>
