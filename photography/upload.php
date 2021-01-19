<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $mysqli = new mysqli('127.0.0.1', 'root', '', 'brightlens', NULL);

    $false="";
    $true="";

    $photo_id=$_POST["photo_id"];
    $photo_name=$_POST["photo_name"];
    $username=$_POST["username"];
    $fullname=$_POST["fullname"];
    $genre=$_POST["genre"];
    $discription=$_POST["description"];
    $role=$_POST["role"];

    $f=$_FILES['img_link'];
    $path="photos/".$f['name'];


    if($role=="Add"){
        if(file_exists($path)){
            $false=$f['name']." already exists, can not add this photo";
        }
        else if($f['type']=="image/jpeg"){
            $sql = "select * from photo where photo_id='$photo_id' ";
            $result=$mysqli->query($sql);
        
            if ( $result->num_rows == 1) {
                $false="photo ID Should be Different!";
            }
            else {
                $sql = "INSERT INTO photo (photo_id,photo_name,username,fullname,genre,discription,img_link)
                VALUES ('$photo_id','$photo_name','$username','$fullname','$genre','$discription','$path')";
        
                $result=$mysqli->query($sql);
                if($result){
                    $true="Photo is Successfully Added!";
                    move_uploaded_file($f['tmp_name'],$path);
                }
            }
        }
        else{
            $false="file format is not valid, unable to upload";
        }
    }
    else if($role=="Update"){
        $sql = "select * from photo where photo_id='$photo_id' and username='$username' ";
        $result=$mysqli->query($sql);
    
        if ($result->num_rows==1) {
            if($f['type']=="image/jpeg"){

                $sql="update photo set photo_name='$photo_name',discription='$discription',genre='$genre' 
                where photo_id='$photo_id' and username='$username' ";
                $result=$mysqli->query($sql);

                if($result){
                    if(!file_exists($path)){
                        move_uploaded_file($f['tmp_name'],$path);
                    }
                    $true="Photo Details is Successfully Updated!";
                }
            }
            else{
                $false="file format is not valid, unable to upload";
            }
        }
        else {
            $false="No Photo Id is Found!";
        }
    }
    else if($role=="Delete"){
        $sql = "select * from photo where photo_id='$photo_id' and username='$username' ";
        $result=$mysqli->query($sql);
    
        if ( $result->num_rows == 1) {
            $sql = "delete from photo where photo_id='$photo_id' and username='$username' ";
            $result=$mysqli->query($sql);
    
            if($result){
                if(file_exists($path)){
                    unlink($path);
                    $true="Photo is Successfully Deleted!";
                }
            }
        }
        else {
            $false="No Photo Id is Found!";
        }
    }
    $mysqli->close();
    header('location: http://localhost/myportfolio/photography/yourwork.php?true='.$true.'&false='.$false);
}
?>