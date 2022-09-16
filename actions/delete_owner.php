<?php

	require_once "../connections/db.php";

		$id=$_GET['id'];
		$query= mysqli_query($con,"DELETE FROM futsal where uid=$id");
		$query1=mysqli_query($con,"DELETE FROM users where uid=$id");
		if($query && $query1){
			header('Location: ../pages/admin/owner.php');
		}

?>