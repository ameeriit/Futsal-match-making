<?php 
include_once "../connections/db.php";
session_start();
$id=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT tid from users where uid=$id");
$result=mysqli_fetch_assoc($query);
$tid=$result['tid'];
$query=mysqli_query($con,"SELECT * from teams where tid !='$tid' ");
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
  				<!-- Showing error message if a user without a team tries to create match request -->
  				<?php if(isset($_GET['err_matchreq'])){ ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>You are not associated with any team, you cannot create match
				</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<?php }?>

				<!-- Showing error message if a user's team has insufficient members -->
  				<?php if(isset($_GET['insuff'])){ ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Your team does not have sufficient members. You cannot send match request.
				</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<?php }?>
				
  				<!-- Showing error message if a opponent team has insufficient members -->
  				<?php if(isset($_GET['insuffoppo'])){ ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Opponent team does not have sufficient members. You cannot send match request.
				</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<?php }?>
  				<ul class="list-group list-group-flush">
      				<li class="list-group-item body"><h3>All Other Teams</h3></li>
      			</ul>
      			<div class="container">
					<table class="table table-hover">
				      <thead>
				        <tr>
				          <th scope="col">Team Name</th>
				          <th scope="col">Preferred Venue</th>
				          <th scope="col">Preferred Time</th>
				          <th scope="col">Contact</th>
				          <th scope="col">Action</th>
				        </tr>
				      </thead>
				      <tbody>
				      	<?php while ($row=mysqli_fetch_assoc($query)) { ?>
				      	<tr>
				          <td><?php echo $row['team_name'] ;?></td>
				          <td><?php echo $row['venue'] ;?></td>
				          <td><?php echo $row['start_time']." - ".$row['end_time'] ;?></td>
				          <td><?php echo $row['contact'] ;?></td>
				          <td><a href="../pages/viewteam.php?id=<?php echo $row['tid']; ?>">View</a> | <a href="../Controller/myteam_check.php?id1=<?php echo $row['tid']; ?>">Play</a></td>
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