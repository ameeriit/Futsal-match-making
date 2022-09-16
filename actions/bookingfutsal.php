<?php
include '../connections/db.php';
session_start();
if(isset($_POST['bookfutsal'])){
	$id=$_SESSION['loggedUser'];
	$fid=$_POST['fid'];
	$owner_query=mysqli_query($con,"SELECT uid from futsal where fid=$fid ");
	$result=mysqli_fetch_assoc($owner_query);
	$owner_id=$result['uid'];

	// //query to get type of user currently active
	// $type_query=mysqli_query($con,"SELECT type from users where uid='$id'");
	// $type_result=mysqli_fetch_assoc($type_query);
	// $type_val=$type_result['type'];
	// if($type_val=="player"){
		//$query to check bank acount of player only
	$query_bank=mysqli_query($con,"SELECT bnk_id from bank where uid=$id ");
	$resultbank=mysqli_num_rows($query_bank);
	$resultbank=$resultbank+0;
	var_dump($resultbank);
	if($resultbank==0){
		header('Location:../pages/bookfutsal1.php?bank_err=1');
	}else{
		$bid=$_POST['bid'];
		$s_time=$_POST['s_time'];
		$e_time=$_POST['e_time'];
		$day=$_POST['day'];
		$array1=explode(":",$s_time);
		$array2=explode(":",$e_time);
		$st=$array1[0];
		$et=$array2[0];
		$et=$et+0;
		$st=$st+1;
		if($st!=$et){
			header('Location:../pages/bookfutsal1.php?error=1');
		}else{
			//query to check whether user has made booking to another futsal for same day and time
			$same_query=mysqli_query($con,"SELECT * from booking_details where uid='$id' and s_time='$s_time' and e_time='$e_time' and day='$day' ");
			if(mysqli_num_rows($same_query)>0){
				header('Location:../pages/bookfutsal1.php?same_time=1');
			}else{
				$query=mysqli_query($con,"SELECT * from booking_details where bid='$bid' and s_time='$s_time' and e_time='$e_time' and day='$day' ");
				if(!$query){
					echo ("Search query failed.");
				}else{
					$row_count=mysqli_num_rows($query);
					if($row_count>0){
						header('Location:../pages/bookfutsal1.php?book_err=1');
					}else{
						$insert_query=mysqli_query($con,"INSERT INTO booking_details(bid,uid,s_time,e_time,day) VALUES($bid,'$id','$s_time','$e_time','$day')");
						if($insert_query){
							//to update bank we need owner id or uid of futsal owner
							//querying bank updating data of current user to transfer money
							$bank_query1=mysqli_query($con,"UPDATE bank set amount=amount-500 where uid=$id");
							//querying bank updating data of current user to transfer money
							$bank_query2=mysqli_query($con,"UPDATE bank set amount=amount+500 where uid=$owner_id");
							//header('Location:../pages/bookfutsal1.php?transc_success=1');
						}else{
							header('Location:../pages/bookfutsal1.php?insert_err=1');
						}
						$url="../mail/booked.php?fid=$fid&s=$s_time&e=$e_time";
						header("Location:".$url);
					}
				}
			}
		}
	}
}
?>