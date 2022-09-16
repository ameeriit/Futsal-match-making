<?php
include '../connections/db.php';
session_start();
if(isset($_POST['bookfutsal'])){
	$id=$_SESSION['loggedUser'];
	$bid=$_POST['bid'];	
	$s_time=$_POST['s_time'];
	$e_time=$_POST['e_time'];
	$day=$_POST['day'];
	//var_dump($s_time);
	$array1=explode(":",$s_time);
	$array2=explode(":",$e_time);
	$st=$array1[0];
	$et=$array2[0];
	$et=$et+0;
	$st=$st+1;
	if($st!=$et){
		header('Location:../pages/futsal_dashboard.php?error=1');
	}else{
		$query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$s_time' and e_time='$e_time' and day='$day' ");
		if(!$query){
			echo ("Search query failed.");
		}else{
			$row_count=mysqli_num_rows($query);
			if($row_count>0){
				header('Location:../pages/futsal_dashboard.php?book_err=1');
			}else{
				$insert_query=mysqli_query($con,"INSERT INTO booking_details(bid,uid,s_time,e_time,day) VALUES($bid,$id,'$s_time','$e_time','$day')");
				if($insert_query){
					header('Location:../pages/futsal_dashboard.php?book_success=1');
				}else{
					header('Locatoin:../pages/futsal_dashboard.php?insert_err=1');
				}
			}
			
		}
	}
}
?>