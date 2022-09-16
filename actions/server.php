<?php
session_start();
include '../connections/db.php';

$errors=array();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['signup'])) {
    $fname = test_input($_POST["fname"]);
    $lname = test_input($_POST["lname"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $contact= test_input($_POST["contact"]);
    $type = test_input($_POST["type"]);
   	
    $fullname=$fname.' '.$lname;

	$check_user_query="SELECT * FROM users WHERE email='$email' LIMIT 1"; 
	$result=mysqli_query($con,$check_user_query);
	$user=mysqli_fetch_assoc($result);//if $result is true
	if ($user) { // if user exists
	    if ($user['email'] === $email) {
	    	// header('Location: ../pages/signup.php');
	      array_push($errors, "Email already exists");
	    }
	}

	if (count($errors) == 0){ 
		$password=md5($password);
		$insert_sql="INSERT INTO users (tid,name,email,password,type,contact) VALUES(0,'$fullname', '$email', '$password','$type','$contact')";
		$result=mysqli_query($con, $insert_sql);
		
		if ($result) {
			$query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
			
		 // login users
		    $row = mysqli_fetch_assoc($query);

		    if($_POST['accno']!=0){
		    	$acno=$_POST['accno'];
		    	$uid=$row['uid'];
    			$accno=test_input($_POST['accno']);
    			//query to add entry to bank
		    	$bank_query=mysqli_query($con,"INSERT INTO bank(uid,accno,amount) values ('$uid','$accno',5000)");
		    	if(!$bank_query){
		    		header('Location:../pages/signup.php?bank_err=1');		
		    	}
    		}
		    
		    if ($type == 'player') {
				$_SESSION['loggedUser_name']=$row['name'];
		        $_SESSION['loggedUser'] = $row['uid'];
		        header('Location: ../pages/player_dashboard.php');
		    }
			else {
		        $_SESSION['loggedUser'] = $row['uid'];
		        $_SESSION['loggedUser_name']=$row['name'];
		        header('Location: ../pages/create_futsal_form.php');
			}
		}	
	}	
}

?>

