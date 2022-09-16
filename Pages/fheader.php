<?php
session_start();
$loggeduser_name=$_SESSION['loggedUser_name'];
$loggeduser_id=$_SESSION['loggedUser'];
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Futsal Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles  -->
    <link href="../css/blog-home.css" rel="stylesheet">

</head>

<body class="body">
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navcolor">
  <div class="container">
    <a class="navbar-brand" href="../pages/futsal_dashboard.php">Futsal Match Maker</a>
   <!--  <h6 style="color: green !important;"><?php echo $loggeduser_name; ?></h6>
    --> <!-- Nav bar toggler button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="../controller/check_futsal.php">Create Futsal</a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View</a>
             <!--Dropdown link of view -->
            <div class="dropdown-menu color4" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="../controller/check_myfutsal.php">My Futsal</a>
              <a class="dropdown-item" href="../actions/fowner_booking.php">My booking</a>
            </div>
          </div>   
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</a>
             <!--Dropdown link of view -->
            <div class="dropdown-menu color4" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="../controller/check_myfutsal.php?up=1">Update Futsal</a>
              <a class="dropdown-item" href="../controller/delete_myfutsal.php?">Delete Futsal</a>
              <a class="dropdown-item" href="#update_bookingtable">Update Booking Table<a>
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
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
