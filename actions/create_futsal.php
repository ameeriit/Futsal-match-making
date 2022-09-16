<?php
session_start();
require_once "../connections/db.php";
//get session detail
$id=$_SESSION['loggedUser'];
$loggedUser_name=$_SESSION['loggedUser_name'];
//get post data
$fname=$_POST['futsalname'];
$venue=$_POST['venue'];
$open_time=$_POST['opn_time'];
$close_time=$_POST['cls_time'];
$price=$_POST['price'];
$contact=$_POST['contact'];


$query="SELECT * FROM futsal WHERE fname='$fname' AND location='$venue' ";
$check_query=mysqli_query($con,$query);
$result=mysqli_fetch_assoc($check_query);
if($result){
	header('Location:../pages/create_futsal_form.php?create_err=1');
}
else{
	$query=mysqli_query($con,"INSERT INTO futsal(uid,fname,location,opening_time,closing_time,price,contact) VALUES ($id,'$fname','$venue','$open_time','$close_time','$price','$contact')");
		
	//query to retrive fid 
	$retrive_query=mysqli_query($con,"SELECT fid from futsal where uid=$id");
	$retrive_result=mysqli_fetch_assoc($retrive_query);
	$fid=$retrive_result['fid'];

	//creating booking table	
	$query=mysqli_query($con,"INSERT INTO booking_table(fid) values ($fid)");
	header('Location:../pages/futsal_dashboard.php?create_success=1');
}
?>