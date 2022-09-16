<?php
include "../connections/db.php";
session_start();
//if (isset($_post['addmember'])){
$id=$_SESSION['loggedUser'];
// $query=mysqli_query($con,"SELECT * from teams where owner_id=$id ");
// $row=mysqli_fetch_assoc($query);
// $	
$uid=$_POST['uid'];
//query to retrive team id
$query=mysqli_query($con,"SELECT * from teams where owner_id=$id");
$result_query=mysqli_fetch_assoc($query);
$tid=$result_query['tid'];
if($id==$uid){
	header('Location:../pages/myteam.php?err=1');
}else{	
	//query to update users and add members
	$update_query=mysqli_query($con,"UPDATE users set tid=0 where uid=$uid");
	//deleteing from member table
	$del_query=mysqli_query($con,"DELETE from member where uid=$uid");
	if($update_query && $del_query){
		header('Location: ../pages/myteam.php?del_success=1');
	}else{
		header('Location: ../pages/myteam.php?del_fail=1');
	}
}
?>