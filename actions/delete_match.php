<?php
include "../connections/db.php";
$gid=$_GET['id'];
//Retrive team info
$query_info=mysqli_query($con,"SELECT * from game where gid=$gid");
$result=mysqli_fetch_assoc($query_info);
$team1=$result['team1'];
$team2=$result['team2'];
$s_time=$result['start_time'];
$e_time=$result['end_time'];
$gdate=$result['gdate'];
$query=mysqli_query($con,"DELETE from game where gid = $gid");
if($query){
	$url="../mail/mail.php?tid1=$team1&tid2=$team2&st=$s_time&et=$e_time&gd=$gdate";
	 header("Location:".$url);
}else{
	header('Location:../pages/player_dashboard.php?gamecancel_failed=1');
}
?>
