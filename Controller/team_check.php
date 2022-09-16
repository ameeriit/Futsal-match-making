<?php
session_start();
include "../connections/db.php";
$id=$_SESSION['loggedUser'];

$query=mysqli_query($con,"SELECT tid from users where uid=$id");
$result=mysqli_fetch_assoc($query);
if($result['tid']>0){
	header('Location:../pages/player_dashboard.php?err=1');	
	//echo("You are already in a team.");
}else{
	header('Location:../pages/create_team_form.php');
}