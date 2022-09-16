<?php
include "../connections/db.php";
$gid=$_GET['id'];
$query=mysqli_query($con,"DELETE from game where gid = $gid");
if($query){
	header('Location:../pages/mygame.php?delgame_success=1');
}else{
	header('Refresh:5,URL=../pages/mygame.php?delgame_error=1');
}
?>
