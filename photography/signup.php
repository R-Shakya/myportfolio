<?php

$fullname=$_POST['fullname'];
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];

$user = 'root';
$pass = ''; //To be completed if you have set a password to root
$database = 'brightlens'; //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$mysqli = new mysqli('127.0.0.1', $user, $pass, $database, $port);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

$sql = "INSERT INTO signup (fullname,email,username,password)
VALUES ('$fullname', '$email', '$username', '$password')";

if ($mysqli->query($sql) === TRUE) {
  echo "Account created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();


?>