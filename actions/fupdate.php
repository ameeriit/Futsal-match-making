<?php

require_once "../connections/db.php";

$fupdate_error=array();
if(isset($_POST['update'])){
	//get session detail through hidden input using $_POST
	$id=$_POST['fid'];

	$fname=$_POST['futsalname'];
	$venue=$_POST['venue'];
	$open_time=$_POST['opn_time'];
	$close_time=$_POST['cls_time'];
	$price=$_POST['price'];
	$contact=$_POST['contact'];

	$query="SELECT * FROM futsal WHERE fid !='$id' and fname='$fname' AND location='$venue' ";
	$check_query=mysqli_query($con,$query);
	$result=mysqli_fetch_assoc($check_query);
	if($result){
		array_push($fupdate_error,"Detail already exists try a new one");
	}
	if (count($fupdate_error) == 0){ 

		$update_sql="UPDATE futsal SET fname= '$fname' ,location='$venue',opening_time='$open_time',closing_time='$close_time',price='$price',contact='$contact' WHERE fid= '$id' ";
		$result=mysqli_query($con, $update_sql);

		if($result){
			header('Location:../pages/futsal_dashboard.php?update_success=1');
		}
		else{
			header('Location:../pages/futsal_dashboard.php?update_err=1');
		}
	}	
}
?>