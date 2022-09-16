<?php
session_start();
include "../connections/db.php";
$id=$_SESSION['loggedUser'];

//query to check whether user is associated with a team or not
$query=mysqli_query($con,"SELECT tid from users where uid=$id");
$result=mysqli_fetch_assoc($query);
$tid1=$result['tid'];

//query to check if there is any team with tid set, whose owner is current user 
$query=mysqli_query($con,"SELECT tid from teams where owner_id=$id");
$result=mysqli_fetch_assoc($query);
$tid=$result['tid'];

//query to check whether team has a accepted game or not
$query_accgame=mysqli_query($con,"SELECT * from game where (team1=$tid or team2=$tid) and confirm=1");
if(mysqli_num_rows($query_accgame)>0){
	header('Location:../pages/player_dashboard.php?err_accgame=1');
}else{
	if($result['tid']>0){
		//query to delete row from teams table
		$del_query=mysqli_query($con,"DELETE from teams where owner_id=$id");
		//deleting game associated with the team.
		$del_game=mysqli_query($con,"DELETE from game where team1=$tid or team2=$tid");
		if($del_query){
			// //query to retrive tid of user
			// $tid_query=mysqli_query($con,"SELECT tid from users where uid=$id");
			// $tid_result=mysqli_fetch_assoc($tid_query);
			// $tid=$tid_result['tid'];
			// 

			//query to retrive users with the retrived tid
			$uid_query=mysqli_query($con,"SELECT uid from users where tid=$tid1");
			while($uid_result=mysqli_fetch_assoc($uid_query)){			
				
				$uid_value=$uid_result['uid'];
				
				//update users table entry set tid as null
				$update_query=mysqli_query($con,"UPDATE users SET tid=0 where uid=$uid_value");
				//deleting entries of member table
				$del_query1=mysqli_query($con,"DELETE from member where uid=$uid_value");
				if(!$del_query1){
					header('Refresh:5,URL=../pages/player_dashboard.php');
					echo("Failed to delete member table");
				}
			}
			header('Location:../pages/player_dashboard.php?delteam=1');
		}else{
			header('Refresh:5,URL=../pages/player_dashboard.php');
			echo("Failed to delete record from teams table");
		}
	}else{
		header('Location:../pages/player_dashboard.php?err_delteam=1');
		// echo("You are not a team captain, you cannot delete a team.");
	}
}
?>