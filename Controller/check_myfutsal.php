<?php
session_start();
include "../connections/db.php";
$id=$_SESSION['loggedUser'];

$query=mysqli_query($con,"SELECT fid from futsal where uid=$id");
$result=mysqli_fetch_assoc($query);
if(isset($_GET['up'])){
	if($result['fid']>0){
		header('Location:../pages/futsal_update.php');	
		//echo("You are already in a team.");
	}else{
		header('Location:../pages/futsal_dashboard.php?err_myfutsal=1');
	}
}else{
	if($result['fid']>0){
		header('Location:../pages/myfutsal.php');	
		//echo("You are already in a team.");
	}else{
		header('Location:../pages/futsal_dashboard.php?err_myfutsal=1');
	}
}
?>
