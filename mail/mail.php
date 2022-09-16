<?php
use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require 'E:\xampp\php\vendor\autoload.php';

   $mail = new PHPMailer();

   $team1=$_GET['tid1'];
   $team2=$_GET['tid2'];
   echo($team2."<br>");
   $s_time=$_GET['st'];
   echo $s_time."<br>";
   $e_time=$_GET['et'];
   $gdate=$_GET['gd'];
   echo $gdate."<br>";
   //die();
   
   //query to retrive team1 users
   $team1_array=array();
   $team2_array=array();
   $query_team1=mysqli_query($con,"SELECT * from users where tid=$team1");
   while($row=mysqli_fetch_assoc($query_team1)){
      $var=$row['email'];
      array_push($team1_array, $var);
   }
   

   // $query_team2=mysqli_query($con,"SELECT * from users where tid=$team2");
   while($row=mysqli_fetch_assoc($query_team2)){
      $var=$row['email'];
      array_push($team2_array, $var);
   }
   
   // //print values of team1 mail id
   // foreach ($team1_array as $email) {
   //    echo($email."<br>");
   // }

   //    //print values of team1 mail id
   // foreach ($team2_array as $email) {
   //    echo($email."<br>");
   // }


   //$id1='khadkasaroj1995@gmail.com';
   //$id2='fmm2071@gmail.com';
   //$id3='prashamsapandey47@gmail.com';
   $mail->setFrom('fmm2071@gmail.com', 'Futsal Match Maker');
   $mail->addAddress('skhadka200ns@gmail.com', '');
   //$mail->addCC($id2, '');
   $mail->Subject = 'Futsal match cancelled';
   $mail->Body = 'Your match on '.$gdate.' starting from '.$s_time.' to '.$e_time.' is cancelled.' ;

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
      header('Location:../pages/player_dashboard.php?gamecancel_success=1&gamecancelmsg_success=1');
   }else{
      header('Location:../pages/player_dashboard.php?gamecancel_success=1&gamecancelmsg_failed=1');
   }
?>