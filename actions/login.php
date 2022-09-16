<?php
//start the session
session_start();
if (isset($_POST['login'])){
    // require database
    require_once '../connections/db.php';

    // Login Handler
    // get post data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password=md5($password);
    $query = mysqli_query($con, "SELECT * FROM users WHERE email='$username' AND password='$password' ");
    if (mysqli_num_rows($query) > 0) {
        // login users
        $row = mysqli_fetch_assoc($query);

      if ($row['type'] == 'player') {
            $_SESSION['loggedUser_name']=$row['name'];
            $_SESSION['loggedUser'] = $row['uid'];
            header('Location: ../pages/player_dashboard.php');
        }
        elseif ($row['type'] == 'futsal') {
            $uid=$row['uid'];
            $_SESSION['loggedUser'] = $row['uid'];
            $_SESSION['loggedUser_name']=$row['name'];
            //query to check whether a futsal owner has a futsal or not
            $query_fut=mysqli_query($con,"SELECT * from futsal where uid=$uid");
            if(mysqli_num_rows($query_fut)>0){
                header('Location: ../pages/futsal_dashboard.php');
            }else{
                header('Location: ../pages/create_futsal_form.php');
            }
        }
        else {
            $_SESSION['loggedUser'] = $row['uid'];
            $_SESSION['loggedUser_name']=$row['name'];
            header('Location: ../pages/admin_dashboard.php');
        }
    }else{
        header('Location:../index.php?err_login');    
    }
}

?>
