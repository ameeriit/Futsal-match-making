<?php
include "../connections/db.php";
session_start();
$uid=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT tid from users where uid= '$uid' ");
$result=mysqli_fetch_assoc($query);
$tid=$result['tid'];
//response notification
$query2 = mysqli_query($con,"SELECT * from game where (team1='$tid' and confirm=1) or (team2='$tid' and confirm=1)"); 
?>
<!DOCTYPE html>
<html>
<head>
<title>my games</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
	  		$("#header").load("../pages/header.php");
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
				<!-- Showing delete game success -->
  				<?php if(isset($_GET['delgame_success'])){ ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Game successfully deleted.
				</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<?php }?>
				<!-- Showing error game delete failed -->
  				<?php if(isset($_GET['delgame_error'])){ ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Delete game failed
				</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<?php }?>
				<div style="text-align: center">
					<h4>My Games</h4>
			</div>
		    <table class="table table-hover">
		    	<thead>
		        <tr>
		          <th scope="col">Team 1</th>
		          <th scope="col">Team 2</th>
		          <th scope="col">Futsal</th>
		          <th scope="col">Location</th>
		          <th scope="col">Start time</th>
		          <th scope="col">End time</th>
		          <th scope="col">Date</th>
		        </tr>
		      	</thead>
		    	<tbody>
					<?php while ($row2=mysqli_fetch_assoc($query2)) { ?>
					<tr>
						<td><?php $opp_tid1=$row2['team1'];
		          		$query5=mysqli_query($con,"SELECT team_name from teams where tid='$opp_tid1'");
		          		$result5=mysqli_fetch_assoc($query5);
		          		echo $result5['team_name']; ?></td>
						<td><?php $opp_tid=$row2['team2'];
		          		$query4=mysqli_query($con,"SELECT team_name from teams where tid='$opp_tid'");
		          		$result4=mysqli_fetch_assoc($query4);
		          		echo $result4['team_name']; ?></td>
		          		<td><?php echo $row2['venue'] ;?></td>
				        <td><?php echo $row2['location']; ?></td>
				        <td><?php echo $row2['start_time'] ;?></td>
				        <td><?php echo $row2['end_time'] ;?></td>
		          		<td><?php echo $row2['gdate']; ?></td>
		          		<?php 
		          		$tid=$row2['team1'];
		          		//Query to retrive whether current user is team captain or not
						$query_cap= mysqli_query($con,"SELECT * from teams where owner_id='$uid' and tid=$tid");
						if(mysqli_num_rows($query_cap)>0){ ?>
		          		<td><a href="../actions/delete_match.php?id=<?php echo $row2['gid']; ?>"><button type="button" class="btn btn-danger">Cancel</button></a></td>
		          		<?php } ?>	
		          	</tr>
		          	<?php } ?>	    		
		    	</tbody>
		    </table>
		</div>
		<!-- <div id="sidebar" class="col-md-3"></div> -->
	</div>
</div>
