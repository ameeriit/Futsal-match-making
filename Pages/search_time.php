<?php 
include "../connections/db.php";
session_start();
$id=$_SESSION['loggedUser'];
$query_id=mysqli_query($con,"SELECT tid from users where uid=$id");
$result_id=mysqli_fetch_assoc($query_id);
$tid=$result_id['tid'];
if(isset($_POST["submit"])){
	$start_time=$_POST["start_time"];
	$end_time=$_POST["end_time"];
	$query=mysqli_query($con,"SELECT * from teams where (start_time BETWEEN '$start_time' AND '$end_time') or (end_time BETWEEN '$start_time' AND '$end_time')");
	if(mysqli_num_rows($query)>0){ ?>
		<!DOCTYPE html>
		<html>
		<head>
		<title>Team on the basis of time</title>
		 <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Bootstrap core CSS -->
		  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		  <!-- Bootstrap core JavaScript -->
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Custom styles for this template -->
		  <link href="../css/blog-home.css" rel="stylesheet">


		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script> 
		$(function(){
		  $("#header").load("../pages/header.php"); 
		 // $("#sidebar").load("../pages/sidebar.html"); 
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
		    <div class="container">
		    	<h4>Showing team available between <?php echo $start_time." and ".$end_time ?></h4> 
				<table class="table table-hover">
			      <thead>
			        <tr>
			          <th scope="col">Team Name</th>
			          <th scope="col">Preferred Venue</th>
			          <th scope="col">Preferred Time</th>
			          <th scope="col">Contact</th>
			        </tr>
			      </thead>
			      <tbody>
			      	<?php while ($row=mysqli_fetch_assoc($query)) { ?>
			      	<tr>
			          <td><?php echo $row['team_name'] ;?></td>
			          <td><?php echo $row['venue'] ;?></td>
			          <td><?php echo $row['start_time']. "-" .$row['end_time'] ;?></td>
			          <td><?php echo $row['contact'] ;?></td>
			          <td><a href="../pages/viewteam.php?id=<?php echo $row['tid']; ?>">View</a> <?php
			          if($row['tid']!=$tid){ ?>
			           | <a href="submit_matchreq.php?id1=<?php echo $row['tid']; ?>">Play</a> <?php } ?></td>
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
	<?php }else{
		header('Location:../pages/player_dashboard.php?err_time=1');
	}	
}
?>
