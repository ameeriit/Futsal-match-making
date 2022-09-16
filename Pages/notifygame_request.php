<?php
include "../connections/db.php";
session_start();
$uid=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT tid from users where uid= '$uid' ");
$result=mysqli_fetch_assoc($query);
$tid=$result['tid'];
//update query after click on notification
$update_query = "UPDATE game SET status=1 WHERE team2='$tid' and status=0";
mysqli_query($con, $update_query);
//request notification
$query1 = mysqli_query ($con,"SELECT * from game where team2='$tid' and notify=1 ");
//response notification
$query2 = mysqli_query($con,"SELECT * from game where team1='$tid'"); 
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
<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Navigation header -->
<div id="header"></div>
	<div class="container">
		<div class="row">
			<!-- alert showing accept failure -->
		  <?php if(isset($_GET['accepted_game'])){ ?>
		    <div class="alert alert-danger alert-dismissible fade show" role="alert">
		    <strong>You already have accepted game with this time and date.</strong>
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		    </button>
		    </div>
		  <?php } ?>
		  <!-- alert showing accept failure -->
		  <?php if(isset($_GET['accepted_oppgame'])){ ?>
		    <div class="alert alert-danger alert-dismissible fade show" role="alert">
		    <strong>Your opponent already have accepted game with this time and date.</strong>
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		    </button>
		    </div>
		  <?php } ?>
		  		  <!-- alert showing accepting failure -->
		  <?php if(isset($_GET['accept_err'])){ ?>
		    <div class="alert alert-danger alert-dismissible fade show" role="alert">
		    <strong>Couldnot accept game.</strong>
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		    </button>
		    </div>
		  <?php } ?>

			<!--Entries Column -->
  			<div class="col-md-9">
  				<div style="text-align: center">
  					<h4>Game Request</h4>
  				</div>
      			<div class="container">
					<table class="table table-hover">
				      <thead>
				        <tr>
				          <th scope="col">Opponent Name</th>
				          <th scope="col">Futsal</th>
				          <th scole="col">Location</th>
				          <th scope="col">Start time</th>
				          <th scope="col">End time</th>
				          <th scope="col"></th>
				        </tr>
				      </thead>
				      <tbody>
				      	<?php while ($row=mysqli_fetch_assoc($query1)) { ?>
				      	<tr>
				          <td><?php $opponent_tid=$row['team1'];
				          $query3=mysqli_query($con,"SELECT team_name from teams where tid='$opponent_tid'");
				          $result3=mysqli_fetch_assoc($query3);
				          echo $result3['team_name']; ?></td>
				          <td><?php echo $row['venue'] ;?></td>
				          <td><?php echo $row['location']; ?></td>
				          <td><?php echo $row['start_time'] ;?></td>
				          <td><?php echo $row['end_time'] ;?></td>
				          <td><?php 
				          	//Query to retrive whether current user is team captain or not
								$query_cap= mysqli_query($con,"SELECT * from teams where owner_id='$uid'");
								if(mysqli_num_rows($query_cap)>0){ ?>
								<a href="../actions/cancel_matchreq.php?id=<?php echo $row['gid']; ?>">Cancel</a> | <a href="../actions/accept_matchreq.php?id1=<?php echo $row['gid']; ?>">Accept</a><?php } ?></td>
				        </tr>
				        <?php } ?>
				      </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>

</body>
</html>