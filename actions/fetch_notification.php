<?php
include	"../connections/db.php";
session_start();
$uid=$_SESSION['loggedUser'];
$query1=mysqli_query($con,"SELECT tid from users where uid= '$uid' ");
$result=mysqli_fetch_assoc($query1);
$tid=$result['tid'];

if(isset($_POST['view'])){
	$query = mysqli_query ($con,"SELECT gid from game where team2=$tid and status=0 ");
	$count = mysqli_num_rows ($query);
	
	$data = array(
		'unseen_notification' => $count,
	);
	echo json_encode($data);
}


?>
