<?php
include "../connections/db.php";
session_start();
//if (isset($_post['addmember'])){
	$id=$_SESSION['loggedUser'];
	$uid=$_POST['uid'];
	//query to retrive team id
	$query=mysqli_query($con,"SELECT * from teams where owner_id=$id");
	$result_query=mysqli_fetch_assoc($query);
	$tid=$result_query['tid'];

	//query to update users and add members
	$update_query=mysqli_query($con,"UPDATE users set tid=$tid where uid=$uid");
	$add_query=mysqli_query($con,"INSERT INTO member(uid) values('$uid')");
	if($update_query && $add_query){
		header('Location:../pages/myteam.php?add_success=1');
	}else{
		header('Location:../pages/myteam.php?add_fail=1');
	}
// }
?>

