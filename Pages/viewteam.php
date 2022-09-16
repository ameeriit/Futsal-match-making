<?php
require_once '../connections/db.php';
$tid=$_GET['id'];
$query1=mysqli_query($con,"SELECT * from users where tid=$tid ");
$query2=mysqli_query($con,"SELECT * from teams where tid=$tid");
$row=mysqli_fetch_assoc($query2);
?>

<!DOCTYPE html>
<html>
<head>
<title>View team</title>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
  <link href="../css/blog-home.css" rel="stylesheet">


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script> 
$(function(){
  $("#header").load("../pages/header.php"); 
});
</script> 
</head>
<body class="body">
<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<div id="header"></div>
<!--Remaining section-->
<div class="container">
  <div class="row">
<!--Entries Column -->
  <div class="col-md-8">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Team Name: <?php echo " ".$row['team_name'] ;?></li>
      <li class="list-group-item">Preferred Venue: <?php echo " ".$row['venue'] ;?></li>
      <li class="list-group-item">Preferred Time: <?php echo " ".$row['start_time']." - ".$row['end_time'] ;?></li>
      <li class="list-group-item">Contact: <?php echo " ".$row['contact'] ;?></li>
    </ul>
    <div class="container">
      <table class="table table-hover">
        <thead><tr><th>Members Detail</th></tr></thead>
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Contact</th>
          </tr>
        </thead>
        <tbody>
           <?php while($row = mysqli_fetch_assoc($query1)) { ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['contact'];?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
<div id="sidebar" class="col-md-4"></div>
</div>
</div>



</body>
</html>