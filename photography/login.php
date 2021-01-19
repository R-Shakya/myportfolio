<?php

session_start();

$username=$_POST["username"];
$password=$_POST["password"];

$mysqli = new mysqli('127.0.0.1', 'root', '', 'brightlens', NULL);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

$sql = "select * from signup where username='$username' and password='$password' ";

$result=$mysqli->query($sql);

if ( $result->num_rows == 1) {
    $_SESSION["username"]=$username;
    header('location:http://localhost/myportfolio/photography/yourwork.php');
}
else {
    header('location:http://localhost/myportfolio/photography/login.html');
}

$mysqli->close();

?>