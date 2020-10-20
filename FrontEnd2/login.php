<?php

require_once('rabbitMQLib.inc');
require_once('get_host_info.inc');
require_once('path.inc');

$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");


$username = ($_POST['username']);
$password =  ($_POST['password']);


$error = '';

if (isset($_POST['register'])) {
        require "register.html";

} elseif (true) {

        if (empty($username) || empty($password)) {
                $error = "Oops! Invalid Username/Password";
                header('Location: index.html');
                die();

        } else {
                $request = array();
                $request['type'] = "login";
                $request['username'] = $username;
                $request['password'] = $password;
                $request['message'] = "'{$username}' requests to login";

                $response = $client->send_request($request);
 		
		if ($response === '1') {
                        $error = "Oops! Invalid Username/Password";
                        header('Location: index.html');
                        die();

                } elseif ($response === '2') {
                        $error = "Oops! Username not found!";
                        header('Location: index.html');
                        die();

                } else {
                        $_SESSION['username'] = $response[0]['username'];
                        $_SESSION['firstname'] = $response[0]['firstname'];
                        $_SESSION['lastname'] = $response[0]['lastname'];
                        header("Location: success.php");
                }
        }

}


?>

