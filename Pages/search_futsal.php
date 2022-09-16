<?php 
include "../connections/db.php";
session_start();
if(isset($_POST["submit"])){
	$name=$_POST["futsal"];
	$query=mysqli_query($con,"SELECT * from futsal where fname = '$name' ");
	if(mysqli_num_rows($query)>0){ ?>
		<!DOCTYPE html>
		<html>
		<head>
		<title>Futsal</title>
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
						<table class="table table-hover">
					      <thead>
					        <tr>
					          <th scope="col">Futsal</th>
					          <th scope="col">Location</th>
					          <th scope="col">Opening Time</th>
					          <th scope="col">Opening Time</th>
					          <th scope="col">Contact</th>
					          <th scope="col">Price</th>
					        </tr>
					      </thead>
					      <tbody>
					      	<?php while ($row=mysqli_fetch_assoc($query)) { ?>
					      	<tr>
								<td><?php echo $row['fname'] ;?></td>
								<td><?php echo $row['location'] ;?></td>
								<td><?php echo $row['opening_time'];?></td>
								<td><?php echo $row['closing_time'] ;?></td>
								<td><?php echo $row['contact'] ;?></td>
								<td><?php echo $row['price'] ;?></td>
								<td><a href="../pages/bookfutsal1.php?fid=<?php echo $row['fid']; ?>">Book</a></td>
					        </tr>
					        <?php } ?>
					      </tbody>
					    </table>
					</div>
		    	</div>
			</div>
		</div>

		<!-- Bootstrap core JavaScript -->
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		</body>
		</html>
	<?php }else{
		header('Location:../pages/search.php?venue_err=1');
	}	
}
?>
