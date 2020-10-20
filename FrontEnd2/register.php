<?php

require_once("rabbitMQLib.inc");
require_once("get_host_info.inc");
require_once("path.inc");

$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

$username = ($_POST['username']);
$email = ($_POST['email']);
$firstname = ($_POST['firstname']);
$lastname = ($_POST['lastname']);
$password = ($_POST['password']);
$confirmPassword = ($_POST['confirmPassword']);


$missingError = '';
$valError = '';


if (isset($_POST['register'])) {
        if ((empty($username)) or ((empty($email)) or ((empty($firstname))) or ((empty($lastname))) or ((empty($password))))) {
                $missingError = "Oops! You are missing some fields."; 

                if ($confirmPassword != $password) {
                        $valError = "Oops! Password did not match.";

                }

                require 'register.html';

        } else {

                $request = array();
                $request['type'] = "register";
                $request['username'] = $username;
                $request['email'] = $email;
                $request['firstname'] = $firstname;
                $request['lastname'] = $lastname;
                $request['password'] = $password;
                $request['message'] = "'{$username}' has been registered";

                $response = $client->send_request($request);

                require 'index.html';

        }
} 



?>
