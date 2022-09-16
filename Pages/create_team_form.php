<?php
session_start();
require_once '../connections/db.php';
$query=mysqli_query($con,"SELECT * FROM users where tid=0 and type='player'");
$loggeduser_name=$_SESSION['loggedUser_name'];
$loggeduser_id=$_SESSION['loggedUser'];
//Retriveing information of the user trying to create team
$user_query=mysqli_query($con,"SELECT * from users where uid='$loggeduser_id'");
$user_result=mysqli_fetch_assoc($user_query);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create team form</title>
   <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>

<!-- Custom styles for this template -->
  <link href="../css/blog-home.css" rel="stylesheet">


<script src="//code.jquery.com/jquery-1.10.2.js"></script>

  <script> 
    $(function(){
      $("#header").load("../pages/header.php"); 
      //$("#sidebar").load("sidebar.html"); 
    });
  </script> 
</head>
<!-- custom css for body -->
<body class="body">
<!-- inserting header from javascrip function -->
<div id="header"></div>
<!--Remaining section-->
<div class="Container" style="max-width:600px;margin:60px auto;" >  
<form role="form" action="../actions/create_team.php" method="Post">
  <div class="form-group">
    <label class="control-label" for="name">Team name</label>
    <div class="form-group">
      <input type="text" class="form-control" name="teamname" placeholder="Team name" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label" for="venue">Preferred venue</label>
    <div class="form-group">
      <input class="form-control" type="text" name="venue" id="venue" placeholder="Preferred futsal" required>
    </div>
  </div>  
  <div class="form-group">
    <label class="control-label" for="time">Time</label>
      <div class="form-row">
        <div class="col">
          <input class="form-group" type="time" name="s_time" id="time" placeholder="HR:MM"  required>
        </div>
        <div class="col">
          <input class="form-group" type="time" name="e_time" id="time" placeholder="HR:MM" required>
        </div>
      </div>
  </div>  
  <div class="form-group">
    <label class="control-label" for="contact">Contact</label>
    <div class="form-group">
      <input class="form-control" type="number" name="contact" id="contact" value="<?php echo $user_result['contact'] ; ?>" placeholder="+977-XXXXXXXXXX">
      <span id= "err5" style="color:red;"></span>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" class="btn btn-default">Create</button>
</form>
</div>
</body>
</html>