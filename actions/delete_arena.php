<?php

	require_once "../connections/db.php";

		$id=$_GET['id'];
		$query= mysqli_query($con,"DELETE FROM futsal where fid=$id");
		if($query){
			header('Location: ../pages/admin/futsal_arena.php');
		}

?>