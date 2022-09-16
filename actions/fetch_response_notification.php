<?php
include	"../connections/db.php";
session_start();
$uid=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT tid from users where uid= '$uid' ");
$result=mysqli_fetch_assoc($query);
$tid=$result['tid'];
// echo( $tid);

if(isset($_POST['gid'])){
	$gid=$_POST['gid'];
	$query1 = mysqli_query ($con,"SELECT * from game where gid= $gid and team1=$tid ");
	$result1=mysqli_fetch_assoc($query1);
	if($result1){
		$value=$result1['confirm'];
		// if($value==0){gid
		// 	$output.='Pending';
		// }elseif($value==1{
		// 	$output.='Accepted';
		// }else{
		// 	$output.='Rejected';
		// }
		$data=array(
			'value' => $value,
			//'output' =>$output,
		);
		
		echo json_encode($data);
	}
}
?>