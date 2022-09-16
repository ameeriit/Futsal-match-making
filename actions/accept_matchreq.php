<?php
include "../connections/db.php";
$gid=$_GET['id1'];

//Query to retrive game details
$query_game=mysqli_query($con,"SELECT * from game where gid=$gid");
$result_query=mysqli_fetch_assoc($query_game);
$s_time=$result_query['start_time'];
$e_time=$result_query['end_time'];
$gdate=$result_query['gdate'];
$team1=$result_query['team1'];
$team2=$result_query['team2'];

//Query to check whether accepting team has any accepted game associated to this time and date
$query_mygame=mysqli_query($con,"SELECT * from game where start_time='$s_time' and end_time='$e_time' and gdate='$gdate' and confirm=1 and ( team1=$team1 or team2=$team1)");

//Query to check whether opponent team has any accepted game associated to this time and date
$query_myoppgame=mysqli_query($con,"SELECT * from game where start_time='$s_time' and end_time='$e_time' and gdate='$gdate' and confirm=1 and (team1=$team2 or team2=$team2 )");

if(mysqli_num_rows($query_mygame)>0){
	header('Location:../pages/notifygame_request.php?accepted_game=1');
}elseif(mysqli_num_rows($query_myoppgame)>0){
	header('Location:../pages/notifygame_request.php?acceptedopp_game=1');
}else{
	$query=mysqli_query($con,"UPDATE game SET confirm=1 , notify=0 where gid=$gid");
	if($query){
		$url="../mail/accept_mail.php?gid=$gid";
		header("Location:".$url);
	}else{
		header('Location:../pages/notifygame_request.php?accept_err=1');
	}
}
?>
