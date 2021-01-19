<?php
session_start(); 
$username=$_SESSION['username'];

$photo_id=$_GET['photo_id'];

$mysqli = new mysqli('127.0.0.1', 'root', '', 'brightlens', NULL);

$sql = " select * from photo where photo_id='$photo_id' and username='$username'";
$result=$mysqli->query($sql);

if ( $result->num_rows == 0) {
    echo 'lol';
}
else{
    $row = $result->fetch_assoc();
    $text=$row['photo_name'].'#'.$row['genre'].'#'.$row['discription'].'#'.$row['img_link'];
    echo $text;
}


$mysqli->close();

?>