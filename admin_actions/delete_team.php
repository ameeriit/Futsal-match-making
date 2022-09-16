<?php

	require_once "../connections/db.php";

		$id=$_GET['id'];
		$query= mysqli_query($con,"DELETE FROM teams where tid=$id");
		if($query){
			header('Location: ../admin/team.php');
		}

?>