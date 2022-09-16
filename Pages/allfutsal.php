<?php 
include_once "../connections/db.php";
session_start();
$id=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT * from futsal");
?>
<!DOCTYPE html>
<html>
<head>
<title>Other team</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<script src="../vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    
     
 
    <!-- Custom styles  -->
    <link href="../css/blog-home.css" rel="stylesheet">


	
	  
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script>
	  	$(function(){
	  		$("#header").load("header.php");
	  	//	$("#sidebar").load("sidebar.html");
	  	});
	</script>
</head>
<body class="body">
	<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Navigation header -->
<div id="header"></div>
	<div class="container">
		<div class="row">
			<!--Entries Column -->
  			<div class="col-md-8">
  				<ul class="list-group list-group-flush">
      				<li class="list-group-item body"><h3>All Futsal<h3> </li>
      			</ul>
      			<div class="container">
					<table class="table table-hover">
				      <thead>
				        <tr>
				          <th scope="col">Futsal</th>
				          <th scope="col">Location</th>
				          <th scope="col">Starting Time</th>
				          <th scope="col">Closing Time</th>
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
				          <td><?php echo $row['price']; ?></td>	
				      	</tr>
				        <?php } ?>
				      </tbody>
				    </table>
				</div>
			</div>
			<div id="sidebar" class="col-md-4"></div>
		</div>
	</div>
	

<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>
</html>