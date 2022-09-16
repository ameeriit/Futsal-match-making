m<?php

	require_once "../connections/db.php";

		$id=$_GET['id'];
		$query= mysqli_query($con,"DELETE FROM users where uid=$id");
		if($query){
			header('Location: ../admin/user.php');
		}

?>