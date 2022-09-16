<?php
include "../connections/db.php";
session_start();
$id=$_SESSION['loggedUser'];
if(isset($_GET['id'])){
	$bd_id=$_GET['id'];
	$query=mysqli_query($con,"DELETE from booking_details where bd_id='$bd_id' ");
	if($query){
		header('Location:../actions/fowner_booking.php?bookdel_success=1');
	}else{
		header('Location:../actions/fowner_booking.php?bookdel_failed=1');
	}
}
?>
