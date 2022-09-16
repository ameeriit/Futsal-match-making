<?php 
include "../connection/db.php";
session_start();
$team=$_POST["team"];
$query=mysqli_query($con,"SELECT * from teams where team_name = '$team' ");	
if($query){
	echo ("Team with this name doesnot exist, Please try with new Email");
}else{
	echo 'false';
}
?>