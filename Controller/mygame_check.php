<?php
session_start();
include "../connections/db.php";
$id=$_SESSION['loggedUser'];

//query to give user details from user table
$query1=mysqli_query($con,"SELECT * from users where uid=$id");
$result1=mysqli_fetch_assoc($query1);
$tid=$result1['tid'];
if($tid==0){
	header('Location:../pages/player_dashboard.php?noteam=1');
}else{
	$query=mysqli_query($con,"SELECT * from game where (team1=$tid or team2=$tid) and confirm=1");
	//$result=mysqli_fetch_assoc($query);
	if(mysqli_num_rows($query)==0){
		header('Location:../pages/player_dashboard.php?nogame_err=1');	
		//echo("You are already in a team.");
	}else{
		header('Location:../pages/mygame.php');
	}
}
?>