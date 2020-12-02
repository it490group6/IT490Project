<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function requestProcessor($request) {
	echo "Request received".PHP_EOL;

	if(!isset($request['type'])) {
		return "Error: unsupported message type";
	}

	switch ($request['type']) {
		case "login":
			return AuthLogin($request['username'], $request['password']);
		case "register":
			print_r($request);
			return NewReg($request['username'], $request['email'], $request['firstname'], $request['lastname'],$request['password']);}

	return array("returnCode" => '0', 'message' => "Server received request and processed");
}

function AuthLogin($username, $password) {
	$hash = password_hash($password, PASSWORD_DEFAULT);
	try {
		$pdo = new PDO("mysql:host=10.147.17.65;dbname=testData", "testuser", "Dipish123!");
		//PDO("mysql:host=10.147.17.11;dbname=IT490PG6", "testuser", "Dipish_123!");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		echo "Connected Successfully".PHP_EOL;
	
	} catch (PDOException $e) {
		echo "Connection Failed:" . $e->getMessage();
	}
	$testquery= "SELECT * FROM users WHERE username = '$username' and password = '$password'";  
	echo $testquery .PHP_EOL;
	$result = $pdo->prepare($testquery);
	$result->execute();
	$row = $result->fetchAll();
	print_r($row);

	if (!empty($row)) {
		if (password_verify($password, $hash)) {
			$log = "Success!";

			$response = $pdo->prepare("SELECT username, firstname, lastname FROM users WHERE username = '{$username}'");
			$response->execute();

			$row = $response->fetchAll();
			echo "login sus ";
			return $row;
		
		} else {
			$response = '1';
			$log = " Response Code 1: Username $username, is not allowed in !!!.\n";

		return $response;
		}
	
	} else {
		$response = "2";
		$log = " Response Code 2: Username can not be found, Please try again :).\n";

		return $response;
		
	
	}
}

function NewReg($username, $email,$firstname, $lastname, $password) {
	$options = ['length' => 11];
	$hash = password_hash($password, PASSWORD_DEFAULT, $options);

	try {
		$pdo = new PDO("mysql:host=10.147.17.65;dbname=testData", "testuser", "Dipish123!");
		//PDO("mysql:host=10.147.17.11;dbname=IT490PG6", "testuser", "Dipish_123!");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		echo "Connected Successfully".PHP_EOL;

	} catch (PDOException $e) {
		echo "Connection Failed: ". $e->getMessage();
	}
	$result = $pdo->prepare("SELECT * FROM users where username = '{$username}'");
	$result->execute();
	$row = $result->fetchAll();

	if (!empty($row)) {
		$response = "3";
		$log = "Response Code 3: Username $username already registered, Please pick a new Name :).\n";

		return $response;

	} else {

		$statement = $pdo->prepare("INSERT INTO users (username, email, firstname, lastname, password, hash) VALUES (:username, :email, :firstname, :lastname, :password, :hash)");

		$statement->bindParam(":username", $username);
		$statement->bindParam(":email", $email);
		$statement->bindParam(":firstname", $firstname);
		$statement->bindParam(":lastname", $lastname);
		$statement->bindParam(":password", $password);
		$statment ->bindParam(":hash", $hash);
		$statement->execute();

		$response = "$username";
		$log = " Email $email added . \n";

		return $response;
	}
}



$server = new rabbitMQServer("testRabbitMQ.ini", "testServer");
$server->process_requests('requestProcessor');

exit();

?>
