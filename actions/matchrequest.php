<?php
include "../connections/db.php";
session_start();
$id=$_SESSION['loggedUser'];
$query1=mysqli_query($con,"SELECT tid from users where uid='$id' ");
$result=mysqli_fetch_assoc($query1);
$tid1=$result['tid'];
if(isset($_POST["matchcreator"])){
	//opponent team id retrived from submit match from which is set in url when users click play match after search
	$tid2=$_POST['tid2'];
	echo ($tid1."<br>".$tid2);
	$venue=$_POST['fname'];
	$location=$_POST['location'];
	$s_time=$_POST['s_time'];
	$e_time=$_POST['e_time']; 
	$date=$_POST['date'];

	//To check whether time is in one hour gap or not
	$array1=explode(":",$s_time);
	$array2=explode(":",$e_time);
	$start=$array1[0];
	$end=$array2[0];
	$end=$end+0;
	$start=$start+1;
	if($start!=$end){
		header('Location:../pages/submit_matchreq.php?gap_err=1');
	}	
	//query to check whether a team has accepted game on given time and date
	$query_check=mysqli_query($con,"SELECT * from game where team1=$tid1");
	$already=0;
	while($result_query=mysqli_fetch_assoc($query_check)){
		$starting_time=$result_query['start_time'];
		$starting_time=explode(":", $starting_time);
		$st1=$starting_time[0];
		$st1=$st1+0;
		$st2=explode(":", $s_time);
		$st2=$st2[0];
		$st2=$st2+0;
		$ending_time=$result_quer['end_time'];
		$ending_time=explode(":", $endting_time);
		$et1=$ending_time[0];
		$et1=$et1+0;
		$et2=explode(":", $e_time);
		$et2=$et2[0];
		$et2=$et2+0;
		$conf=$result_query['confirm'];
		$gamedate=$result_query['gdate'];
		if($st1==$st2 && $et1=$et2 && $conf==1 && $gamedate==$date){
			$already=1;
			break;
		}
	}
	if($already==0){
		$query=mysqli_query($con,"INSERT INTO game(team1,team2,confirm,venue,location,start_time,end_time,gdate,notify,status) VALUES('$tid1' , '$tid2' , 'No' , '$venue' , '$location' , '$s_time' , '$e_time' , '$date',1,0)");
		if($query){
			header('Location:../pages/player_dashboard.php?matchreq=1');
		}else{
			header('Location:../pages/player_dashboard.php?err_matchreq=1');;
		}
	}else{
		header('Location:../pages/player_dashboard.php?already=1');
	}
}
?>
