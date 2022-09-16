<?php
include "../connections/db.php";
$gid=$_GET['id'];
$query=mysqli_query($con,"UPDATE game SET confirm=2 , notify=0 Where gid=$gid");
if($query){
	header('Location:../pages/notification.php');
}else{
	header('Refresh:5,URL=../pages/notification.php');
	echo "Cancellation failed"."<br>";
	echo "Redirecting back to login page in 5 sec...";
}
?>
