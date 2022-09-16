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
$query1 = mysqli_query ($con,"SELECT * from game where team2=$tid and notify=1 ");
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
	  		$("#sidebar").load("../pages/sidebar.html");
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
				          <th scope="col">Action</th>
				        </tr>
				      </thead>
				      <tbody>
				      	<?php while ($row=mysqli_fetch_assoc($query1)) { ?>
				      	<tr>
				          <td><?php $opp_tid=$row['team1'];
				          $query3=mysqli_query($con,"SELECT team_name from teams where tid='$opp_tid'");
				          $result3=mysqli_fetch_assoc($query3);
				          echo $result3['team_name']; ?></td>
				          <td><?php echo $row['venue'] ;?></td>
				          <td><?php echo $row['location']; ?></td>
				          <td><?php echo $row['start_time'] ;?></td>
				          <td><?php echo $row['end_time'] ;?></td>
				          <td><a href="../actions/cancel_matchreq.php?id=<?php echo $row['gid']; ?>">Cancel</a> | <a href="../actions/accept_matchreq.php?id1=<?php echo $row['gid']; ?>">Accept</a></td>
				        </tr>
				        <?php } ?>
				      </tbody>
				    </table>
				</div>
				<div class="container">
					<div align="center">
						<h4>Game Response</h4>
					</div>
				    <table class="table table-hover">
				    	<thead>
				        <tr>
				          <th scope="col">Opponent Name</th>
				          <th scope="col">Futsal</th>
				          <th scope="col">Location</th>
				          <th scope="col">Start time</th>
				          <th scope="col">End time</th>
				          <th scope="col">Action</th>
				        </tr>
				      	</thead>
				    	<tbody>
							<?php while ($row2=mysqli_fetch_assoc($query2)) { ?>
							<tr>
								<td><?php $opp_tid=$row2['team2'];
				          		$query4=mysqli_query($con,"SELECT team_name from teams where tid='$opp_tid'");
				          		$result4=mysqli_fetch_assoc($query4);
				          		echo $result4['team_name']; ?></td>
				          		<td><?php echo $row2['venue'] ;?></td>
						        <td><?php echo $row2['location']; ?></td>
						        <td><?php echo $row2['start_time'] ;?></td>
						        <td><?php echo $row2['end_time'] ;?></td>
				          		<td><input type="button" class="btn btn-primary view" value="View" id="<?php echo $row2['gid']; ?>">|<a href="./pages/bookfutsal.php"><button type="button" class="btn btn-success" id="showBtn">Book</button></a>|<a href="../actions/delete_match.php?id=<?php echo $row2['gid']; ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>	
				          	</tr>
				          	<?php } ?>	    		
				    	</tbody>
				    </table>
				</div>
			</div>
			<div id="sidebar" class="col-md-3"></div>
		</div>
	</div>


<script>
$(document).ready(function(){
// 	//hiding book button
// 	book_button();  
// 	function book_button(){
// 		$('#showBtn').hide();
// 		// var value=val;
// 		// if(value!=1){
// 		// 	$('#showBtn').hide();
// 		// }else{
// 		// 	$('#showBtn').fadeIn('slow');
// 		// }
// 	}

	//checking confirmation condition of game request i.e notifying request sender about his game response
    $('.view').click(function(){ 
    	var gid = $(this).attr("id");
	    // alert(gid);
	    // alert("Inside response_notification");
	    $.ajax({
			url:"../actions/fetch_response_notification.php",
			method:"post",
			data:{
			gid:gid},
			dataType:"json",
			success:function(json){
				console.log(json.value);
				if(json.value == 0){
					$.alert({
			       	title: 'Response',
			       	content: 'Pending',
					})
					//$('.Pending').html("Pending");
					//document.getElementById('Pending').innerHTML="Pending";
					//$('#book').hide();
				}else if(json.value == 2){
					$.alert({
			       	title: 'Response',
			       	content: 'Rejected',
					})
					//document.getElementById('Pending').innerHTML="Rejected";
					//$('#Pending').html(json.notification);
					//$('#book').fadeIn('slow');
				}else{
					$.alert({
			       	title: 'Response',
			       	content: 'Accepted',
					})
					//document.getElementById('Pending').innerHTML="Accepted";
					//$('#showBtn').fadeIn('slow');
				}
			},error: function(){
				$.alert({
			       title: 'APi call error',
			       content: 'Unsuccessful!',
				})
			}
		});
	});
});
</script>
</body>
</html>