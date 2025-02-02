<?php
ob_start();
if(file_exists("config.php")) {
require_once("config.php");

$con=mysqli_connect($server,$userid,$password,$database);
if($con)
{
   
       echo " & database connected";
   
}
else
{
    echo "server connection error";
    header("location:$errorpage?error=1");
}


   }else {
	   echo "not found";
	   header("Location:new_website.php");
	   exit;
   }
?>