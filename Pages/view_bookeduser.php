<?php
include "../connections/db.php";
if(isset($_POST['uid'])){
	$uid=$_POST['uid'];
	$query=mysqli_query($con,"SELECT * from users where uid=$uid");
	if($query){
		$result=mysqli_fetch_assoc($query);
		$name=$result['name'];
		$email=$result['email'];
		$contact=$result['contact'];
		$value=array(
			'name' =>$name,
			'email' =>$email,
			'contact' =>$contact,
		);
		echo json_encode($value);
	}else{
		 header('Location:../pages/futsal_dashboard.php?viewdetail_err=1');
	}
}else{
	header('Location:../pages/futsal_dashboard.php?select_err=1');
}
?>