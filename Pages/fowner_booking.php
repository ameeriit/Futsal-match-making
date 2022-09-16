<?php
include '../connections/db.php';
session_start();
$id=$_SESSION['loggedUser'];
//query to give booking detail of user
$query=mysqli_query($con,"SELECT * from booking_details where uid=$id");
if(mysqli_num_rows($query)==0){
	header('Location:../pages/futsal_dashboard.php?nobooking=1');
}else{ ?>
	<!DOCTYPE html>
<html>
<head>
<title>My booking</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

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
	<script>
	  	$(function(){
	  		$("#header").load("../pages/fheader.php");
	  		//$("#sidebar").load("../pages/sidebar.html");
	  	});
	</script>
</head>
<body class="body">
<!-- Navigation header -->
<div id="header"></div>
	<div class="container">
		<div class="row">
			<!--Entries Column -->
  			<div class="col-md-9">
  				<!-- alert showing successful cancel booking-->
  				<?php if(isset($_GET['bookdel_success'])){ ?>
  					<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Successfully Cancelled</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>
  				<?php } ?>
  				<!-- alert showing Error in cancel booking -->
  				<?php if(isset($_GET['bookdel_failed'])){ ?>
  					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Booking cancel failed.</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>
  				<?php } ?>
  				<div style="text-align: center">
  					<h4>My Booking</h4>
  				</div>
      			<div class="container">
					<table class="table table-hover">
				      <thead>
				        <tr>
				          <th scope="col">Start time</th>
				          <th scope="col">End time</th>
				          <th scope="col">Day</th>
				          <th scope="col">Action</th>
				        </tr>
				      </thead>
				      <tbody>
				      	<?php while ($row=mysqli_fetch_assoc($query)) { ?>
				      	<tr>
				          <td><?php echo $row['s_time'] ;?></td>
				          <td><?php echo $row['e_time'] ;?></td>
				          <td><?php echo $row['day']; ?></td>
				          <td><a href="../actions/ownercancel_booking.php?id=<?php echo $row['bd_id']; ?>">Cancel</a>
				          </td>
				        </tr>
				        <?php } ?>
				      </tbody>
				    </table>
				</div>
			</div>
			<!-- <div id="sidebar" class="col-md-3"></div> -->
		</div>
	</div>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>	
</body>
</html>

<?php }
?>