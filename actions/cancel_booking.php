<?php
include '../connections/db.php';
session_start();
$id=$_SESSION['loggedUser'];
if(isset($_GET['id'])){
	$bd_id=$_GET['id'];
	
	
	//query to retrive booking id using booking detail id
	$query_retrive1=mysqli_query($con,"SELECT bid from booking_details where bd_id=$bd_id");
	$result1=mysqli_fetch_assoc($query_retrive1);
	$bid=$result1['bid'];
	//query to retrive futsal detail using booking detail id
	$query_retrive2=mysqli_query($con,"SELECT fid from booking_table where bid=$bid ");
	$result2=mysqli_fetch_assoc($query_retrive2);
	$fid=$result2['fid'];
	$fid=$fid+0;
	
	//query to retrive futsal owner id
	$query_retrive3=mysqli_query($con,"SELECT * from futsal where fid='$fid' ");
	$row=mysqli_num_rows($query_retrive3);
	
	$result3=mysqli_fetch_assoc($query_retrive3);
	$owner_id=$result3['uid'];
	$query=mysqli_query($con,"DELETE from booking_details where bd_id='$bd_id' ");
	if($query){
		$query1=mysqli_query($con,"UPDATE bank SET amount=amount+300 where uid='$id'");
		// $query2=mysqli_query($con,"SELECT * bank where uid='$owner_id'");
		// $row2=mysqli_fetch_assoc($query2);
		// $amount=$row2['amount'];
		// var_dump($amount);
		// $amount=$amount-300;
		// var_dump($amount);
		// die();
		$query3=mysqli_query($con,"UPDATE bank SET amount=amount-300 where uid='$owner_id'");
		if($query1 && $query3){
			header('Location:../pages/notifymybooking.php?bookdelsuccess=1');
		}
	}else{
		header('Location:../pages/notifymybooking.php?bookdelfailed=1');
	}

}