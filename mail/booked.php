<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'E:\xampp\php\vendor\autoload.php';

  $mail = new PHPMailer();

  include "../connections/db.php";
  session_start();
  $uid=$_SESSION['loggedUser'];
  $fid=$_GET['fid'];
  $s=$_GET['s'];
  $e=$_GET['e'];

  //query to retrive email from users table
  $query_user=mysqli_query($con,"SELECT * from users where uid=$uid");
  $result_user=mysqli_fetch_assoc($query_user);
  $id1=$result_user['email'];

   //query to retrive futsal detail using fid
   $query_game=mysqli_query($con,"SELECT * from futsal where fid=$fid");
   $result_game=mysqli_fetch_assoc($query_game);
   $venue=$result_game['fname'];
   $location=$result_game['location'];
   
   //query to retrive team1 users
   

   $mail->setFrom('fmm2071@gmail.com', 'Futsal Match Maker');
   $mail->addAddress($id1, '');
   //$mail->addCC($id2, '');
   $mail->Subject = 'Booking confirmation';
   $mail->Body = 'Booking successful. The details about your timing is present in your dashboard, Rs.500 is charged as a booking price.<br>'.$venue.'<br>'.$location.'<br>'.$s." to ".$e;

   /* SMTP parameters. */
   $mail->SMTPDebug = 1;                                 // Enable verbose debug output
   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = TRUE;
   $mail->SMTPSecure = 'tls';
   $mail->Username = 'fmm2071@gmail.com';
   $mail->Password = 'FMM20182071';
   $mail->Port = 587;
   $mail->CharSet = "UTF-8";

   /* Disable some SSL checks. */
   $mail->SMTPOptions = array(
     'ssl' => array(
     'verify_peer' => false,
     'verify_peer_name' => false,
     'allow_self_signed' => true
     )
   );

  // $mailid=array($id1,$id3);

   foreach ($team1_array as $id ){
     $mail->addCC($id);
    // $mail->send()   
   } 
   foreach ($team2_array as $id ){
     $mail->addCC($id);
    // $mail->send()   
   } 

   // foreach($mailid as $id){
   //    $mail->addCC($id);
   // }

   /* Finally send the mail. */
   if($mail->send()){
     header('Location:../pages/bookfutsal1.php?book_success=1');
   }else{
      header('Location:../pages/player_dashboard.php?gameacceptmsg_failed=1');
   }
?>