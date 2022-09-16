<?php
require_once '../connections/db.php';
session_start();
$id=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT * from futsal where uid=$id");
$result=mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
<title>My futsal</title>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<!-- Bootstrap core CSS -->
<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
  <link href="../css/blog-home.css" rel="stylesheet">


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script> 
$(function(){
  $("#header").load("fheader.php"); 
  //$("#sidebar").load("sidebar.html"); 
});
</script> 
</head>
<body class="body">
<div id="header"></div>
<!--Remaining section-->
<div class="container">
  <div class="row">
<!--Entries Column -->
  <div class="col-md-8">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Futsal Name: <?php echo " ".$result['fname'] ;?></li>
      <li class="list-group-item">Location: <?php echo " ".$result['location'] ;?></li>
      <li class="list-group-item">Opening Time: <?php echo " ".$result['opening_time'] ;?></li>
      <li class="list-group-item">Closing Time: <?php echo " ".$result['closing_time'] ;?></li>
      <li class="list-group-item">Price: <?php echo " ".$result['price'] ;?></li>
      <li class="list-group-item">Contact: <?php echo " ".$result['contact'] ;?></li>
    </ul>
<!-- <div id="sidebar" class="col-md-4"></div> -->
  </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>