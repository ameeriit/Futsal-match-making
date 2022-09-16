<?php
include "../connections/db.php";

$tid2=$_GET['id1'];

$query=mysqli_query($con,"SELECT * from futsal");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Match request page</title>

</head>
<!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
   <link href="../css/blog-home.css" rel="stylesheet">

  

  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- JQuery confirm dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<body class="body">

<!-- Navigation -->
<!-- alert showing not booked due to time range -->
<?php if(isset($_GET['gap_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Booking unsuccessful. Please select time with one hour gap. Eg 6-7 , 4-5</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navcolor">
	<div class="container">
		<a class="navbar-brand" href="#">Futsal Match Maker</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
		    	<li class="nav-item active">
		    		<a href="../pages/player_dashboard.php"><button type="button" class="btn btn-info">Cancel</button></a> 
		    	</li>
		    </ul>
		</div>
	</div>
</nav>
<div class="Container" style="max-width:600px;margin:60px auto;" >
<h3>Send game request</h3><br><br>  
<form role="form" action="../actions/matchrequest.php" method="Post">
	<div class="form-group">
		<label class="control-label" for="fname">Venue</label>
		<input type="hidden" name="tid2" value="<?php echo $tid2; ?>">
      	<div class="form-group">
      		<select class="form-control" name="fname">
            	<?php while($row = mysqli_fetch_assoc($query)) { ?>
                	<option value="<?php echo $row['fname']; ?>"><?php echo $row['fname']; ?></option>
            	<?php } ?>
        	</select>
        </div>
    </div>
    <div class="form-group">
  		<label class="control-label" for="location">Location</label>
  		<div class="form-group">
  			<input class="form-control" type="text" name="location" onchange="validate_location(this.value)" placeholder="Location" required>
  		  <span id="err1" style="color:red;">
      </div>
    </div>  
    <div class="form-group">
    	<div class="form-row">
        	<div class="col">
				<label class="control-label" for="time">From</label>
				<input class="form-group" type="time" name="s_time" id="time" placeholder="HR:MM" >
			</div>
        <div class="col">
	        <label class="control-label" for="time">To</label>
	        <input class="form-group" type="time" name="e_time" id="time" placeholder="HR:MM" >
        </div>
      </div>
    </div>
    <div class="form-group">
    	<label class="control-label" for="date">Date</label>
    	<div class="form-group">
    		<input type="date" name="date" placeholder="date">
    	</div>
    </div>
    <div class="form-group showBtn">
    	<button type="submit" name="matchcreator" class="btn btn-info">Create Match</button>
    </div>
</form>
</div>
<script type="text/javascript">
  f=0;
  // l=0;
  // function validate_name(val){
  //   var pat_name=/^[a-zA-Z ]+$/;
  //   if (!pat_name.test(val)){
  //       document.getElementById('err').innerHTML="This is invalid Name";
  //     f = 0;
  //   }else{
  //     document.getElementById('err').innerHTML=" ";
  //     f = 1;
  //   }
  //   if (f==1 && l==1) {
  //   $('#showBtn').fadeIn('slow');
  //   } else {
  //     $('#showBtn').hide();
  //   }
  // }

  function validate_location(val){
    var pat_name=/^[a-zA-Z ]+$/;
    if (!pat_name.test(val)){
        document.getElementById('err1').innerHTML="This is invalid Location, please enter text.";
      f = 0;
    }else{
      document.getElementById('err1').innerHTML=" ";
      f = 1;
    }
    if (f==1) {
    $('#showBtn').fadeIn('slow');
    } else {
      $('#showBtn').hide();
    }
  }

</script>
</body>
</html>