<?php
session_start();
require_once '../connections/db.php';
// $query=mysqli_query($con,"SELECT * FROM users where tid=0 and type='player'");
$loggeduser_name=$_SESSION['loggedUser_name'];
$loggeduser_id=$_SESSION['loggedUser'];
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Futsal Management System</title>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
     
 
    <!-- Custom styles  -->
    <link href="../css/blog-home.css" rel="stylesheet">

    <!-- JQuery confirm dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
  </head>

  <body class="body">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navcolor">
      <div class="container-fluid">
        <a class="navbar-brand" href="../pages/player_dashboard.php">Futsal Match Maker</a>
        <!-- Nav bar toggler button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="../controller/team_check.php" >Create team</a>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <a class="nav-link btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View</a>
                 <!--Dropdown link of view -->
                <div class="dropdown-menu color4" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="../controller/myteam_check.php">My Team</a>
                  <a class="dropdown-item" href="allteam.php">All Team</a>
                  <a class="dropdown-item" href="../pages/allfutsal.php">Futsal<a>
                  <a class="dropdown-item" href="../controller/mygame_check.php">My games</a>
                </div>
              </div>   
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <a class="nav-link btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</a>
                 <!--Dropdown link of view -->
                <div class="dropdown-menu color4" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="../pages/player_update.php">Update profile</a>
                  <a class="dropdown-item" href="../actions/leave_team.php">Leave team</a>
                  <a class="dropdown-item" href="../controller/delete_team.php">Delete team</a>
                  <a class="dropdown-item" href="../pages/bookfutsal1.php">Book Futsal</a>
                </div>
              </div>   
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <a href="../pages/notification.php" class="nav-link btn dropdown-toggle notify" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notification<span class="badge count" style="color:red;border-radius:10px;"></span></a>
                <div class="dropdown-menu color4" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="../pages/notifygame_request.php">Game request<span class="badge count" style="color:red;border-radius:10px;"></span></a>
                  <a class="dropdown-item" href="../pages/notifygame_response.php">Game response</a>
                  <a class="dropdown-item" href="../pages/notifymybooking.php">My booking</a>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <a class="nav-link btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #ffffff !important;"><?php echo $loggeduser_name; ?></a>
                 <!--Dropdown link of view -->
                <div class="dropdown-menu color4" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="../actions/logout.php">Log out</a>
                </div>
              </div>   
            </li>
          </ul>
        </div>
      </div>
    </nav>


     

<!-- Bootstrap core JavaScript -->


<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){
  function load_unseen_notification()
   {
    var view=1;
    //alert("Inside unseen_notification");
    $.ajax({
      url:"../actions/fetch_notification.php",
      method:"post",
      data:{
        view:view},
      dataType:"json",
      success:function(json){
        if(json.unseen_notification > 0){
          $('.count').html(json.unseen_notification);
          
        }
      },error: function(){
        $.alert({
               title: 'Error',
               content: 'Ajax call failed',
        })
      }
    });
  }

  load_unseen_notification();
  // $(document).on('click', '.notify', function(){
  //   alert("Clicked");
  //   $('.count').html('');
  //   load_unseen_notification('yes');
  // });

  setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>

</body>
</html>