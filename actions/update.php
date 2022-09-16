<?php 
include "../connections/db.php";


$update_error=array();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//handles the ajax call to check the duplcate email entry handled by error function.
// if(isset($_POST["uid"])){
// 	$uid=$_POST["uid"];
// 	$email=test_input($_POST["email"]);

// 	$check_user = mysqli_query($con,"SELECT * from users where uid !='$uid' and email='$email' limit 1");
// 	$user=mysqli_fetch_assoc($check_user);
// 	if($user){
// 		if($user["email"]==$email){
// 			echo ("Email already exists, Please try with new Email");
// 		}else{
// 			echo 'false';
// 		}
// 	}
// }

if( isset($_POST['update'])){
	$uid=$_POST["uid"];	
	$name=test_input($_POST["fname"]);
	$email=test_input($_POST["email"]);
	$password = test_input($_POST["password"]);
    $contact= test_input($_POST["contact"]);

    $check_user = mysqli_query($con,"SELECT * from users where uid !='$uid' and email='$email' limit 1");
    $user=mysqli_fetch_assoc($check_user);
    if($user){
    	if($user["email"]==$email){
    		array_push($update_error,"Email already exists try a new one");
    	}
    }

    if (count($update_error) == 0){ 
		$password=md5($password);
		$update_sql="UPDATE users SET name= '$name' ,email='$email',password='$password',contact='$contact' WHERE uid= $uid ";
		$result=mysqli_query($con, $update_sql);
		if(isset($_POST['accno'])){
			$account=$_POST['accno'];
			$update_bank="UPDATE bank set accno='$account' where uid=$uid";
		}
		if($result){
			header('Location:../pages/player_dashboard.php');
		}
		else{
		 	header('Refresh:5,URL=../pages/player_dashboard.php');
	        echo "Update failed"."<br>";
	        echo "Redirecting back to login page in 5 sec...";
		}
	}	
}