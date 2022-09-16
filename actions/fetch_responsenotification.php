<?php
include	"../connections/db.php";
session_start();
$uid=$_SESSION['loggedUser'];
$query1=mysqli_query($con,"SELECT tid from users where uid= '$uid' ");
$result=mysqli_fetch_assoc($query1);
$tid=$result['tid'];
if(isset($_POST['mid'])){
	$mid=$_POST['mid'];
	$query = mysqli_query ($con,"SELECT * from game where mid= $mid and team1=$tid ");
	$result=mysqli_fetch_assoc($query);
	if($result){
		if($result['confirm']==0){
			$msg="Pending";
			$data = array(
				'confirm' ==> 0,
				'notification'==>$msg
			);
		}
		elseif($result['confirm']==1){
			$msg="Accepted";
			$data = array(
				'confirm'==>1,
				'notification'==>$msg
			);
		}else{
			$msg="Rejected";
			$data = array(
				'confirm'==>1,
				'notification'==>$msg
			);
		}
		echo json_encode($data);
	}
}
?>