<?php
session_start();
include '../connections/db.php';
$id=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT tid from users where uid=$id");
$result=mysqli_fetch_assoc($query);
$tid=$result['tid'];
//If user dont have a team
if(isset($_GET['id1'])){
	$tid2=$_GET['id1'];
	if($tid==0){
		header('Location:../pages/allteam.php?err_matchreq=1');
	}else{
		
		//query to count number of players in team
		$query_count1=mysqli_query($con,"SELECT tid from users where tid=$tid");
		$row_count1=mysqli_num_rows($query_count1);
		var_dump($row_count1);
		//query to count the number of players in oppoent team
		$query_count2=mysqli_query($con,"SELECT tid from users where tid=$tid2");
		$row_count2=mysqli_num_rows($query_count2);
		var_dump($row_count2);
		if($row_count1<5){
			//echo("Less than five");
			header('Location:../pages/allteam.php?insuff=1');
		}else{
			if($row_count2<5){
				header('Location:../pages/allteam.php?insuffoppo=1');
			}else{
				$url="../pages/submit_matchreq.php?id1=$tid2";
				header("Location:".$url);
			}
		}	
	}
}else{
	if($tid==0){
		header('Location:../pages/player_dashboard.php?err_myteam=1');
		//echo("You are not in any team.");
	}else{
		header('Location:../pages/myteam.php');
	}
}
?>