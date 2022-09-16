<?php
session_start();
include "../connections/db.php";
$id=$_SESSION['loggedUser'];

$query=mysqli_query($con,"SELECT fid from futsal where uid=$id");
$result=mysqli_fetch_assoc($query);
if($result['fid']>0){
	header('Location:../pages/futsal_dashboard.php?err=1');	
	//echo("You are already in a team.");
}else{
	header('Location:../pages/create_futsal_form.php');
}
