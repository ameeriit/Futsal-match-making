<?php
include "../connections/db.php";
session_start();
$id=$_SESSION['loggedUser'];
//query to display futsal name present in database
$query=mysqli_query($con,"SELECT * from futsal");
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Futsal Management System</title>

  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap core CSS -->

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles template -->
    <link href="../css/blog-home.css" rel="stylesheet">

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script> 
      $(function(){
        $("#header").load("header.php"); 
       // $("#sidebar").load("sidebar.html"); 
      });
    </script> 
    <style>
    .tableborder{
    border:1px solid black;
	}
	</style>
  </head>

<body class="body">
   
<!-- Calling header -->
<div id="header"></div>
<!-- alert showing not booked due to time range -->
<?php if(isset($_GET['same_time'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Check the time you entered.<br>You already have booking with this time.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- alert showing not booked due to time range -->
<?php if(isset($_GET['error'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Booking unsuccessful. Please select time with one hour gap. Eg 6-7 , 4-5</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- alert showing not free -->
<?php if(isset($_GET['book_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>It is already booked.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- alert showing booking success-->
<?php if(isset($_GET['book_success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successully booked.<br>Rs.500 has been deducted from your account as booking charge.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- alert showing booking success-->
<?php if(isset($_GET['msg'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Confirmation mail has been sent to your address.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- alert showing booking success-->
<?php if(isset($_GET['msgerr'])){ ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Couldnot send Confirmation mail to your address.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- alert showing transac success-->
<!-- <?php if(isset($_GET['transc_success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Booking successful.<br>Rs.500 has been deducted from your account for booking.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?> -->

<!-- alert showing booking error-->
<?php if(isset($_GET['insert_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Not booked.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- alert showing bank error-->
<?php if(isset($_GET['bank_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>You need to have bank account inorder to book futsal.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>

<div class="Container" style="max-width:600px;margin:40px auto;" >  
<form role="form" action="bookfutsal1.php" method="GET">
	<div class="form-group">
	    <label class="control-label" for="fname">Select Futsal</label>
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col">
		    		<select class="form-control" name="fid" required>
		    			<?php
		            	while($result = mysqli_fetch_assoc($query)) { ?>
							<option value="<?php echo $result['fid']; ?>"><?php echo $result['fname']; ?></option>
		            	<?php } ?>
					</select>
				</div>
				<div clas="col">
					<button type="submit" name="futsal_selected" class="btn btn-primary">Ok</button>
				</div>
			</div>
		</div>
  	</div>
</form>
</div>
<?php if(isset($_GET['fid'])){ ?>
	<?php 
	$fid=$_GET['fid'];
	//query to retrive start time and end time of selected futsal
	$time_query=mysqli_query($con,"SELECT * from futsal where fid=$fid");
	$time_result=mysqli_fetch_assoc($time_query);
	$fname=$time_result['fname'];
	$open_time=$time_result['opening_time'];
	$close_time=$time_result['closing_time']; 
	//query to retrive booking table id of selected futsal
	$bid_query=mysqli_query($con,"SELECT bid from booking_table where fid=$fid");
	$retrive_bid=mysqli_fetch_assoc($bid_query);
	$bid=$retrive_bid['bid'];
	//query to retrive booking detail of selected futsal
	//$detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid"); 
	?>
	<!-- Creating a table with two heading -->
	<h3 style="text-align: center"><?php echo $fname ;?></h3>
	<table class="table table-hover table-bordered tableborder" >
	<thead>
	<tr>
	    <td></td>
	    <th scope="col">Sunday</th>
	    <th scope="col">Monday</th>
	    <th scope="col">Tuesday</th>
	    <th scope="col">Wednesday</th>
	    <th scope="col">Thursday</th>
	    <th scope="col">Friday</th>
	    <th scope="col">Saturday</th>
	</tr>
	</thead>
	<tbody>
		<?php 
			$array1=explode(":",$open_time);
			$array2=explode(":",$close_time);
			$op_time=$array1[0];
			$cl_time=$array2[0];
			//Converting string type to integer type 
			$op_time=$op_time+0;
			$cl_time=$cl_time+0;
			for($x=$op_time;$x<$cl_time;$x++){ ?> 
			<tr>
				<th scope="row"><?php 
				$y=$x+1;
				echo $x.":00 -".$y.":00"; ?></th>
				<?php 
				$s_time=$x;
				$e_time=$y;
				if($s_time<10){
					// converting back to string 
					$as_time=(string)$s_time;
					$as_time='0'.$as_time.':00:00';
				}else{
					$as_time=(string)$s_time;
					$as_time=$as_time.':00:00';
				}
				if($e_time<10){
					// converting back to string 
					$ae_time=(string)$e_time;
					$ae_time='0'.$ae_time.':00:00';
				}else{
					$ae_time=(string)$e_time;
					$ae_time=$ae_time.':00:00';
				}
				// echo($as_time.<"br">.$ae_time);
				// die();
				$detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time'");
				if(!$detail_query){ ?>
					<td>free</td>
					<td>free</td>
					<td>free</td>
					<td>free</td>
					<td>free</td>
					<td>free</td>
					<td>free</td>
				<?php }else{  ?>
					<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Sun' ");
						if(mysqli_num_rows($sun_check)>0){
						echo "Booked";
						}
						else{
							echo "Free";
						} ?>
					</td>
					<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Mon' ");
						if(mysqli_num_rows($day_check)>0){
						echo "Booked";
						}
						else{
							echo "Free";
						} ?>
					</td>
					<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Tue' ");
						if(mysqli_num_rows($day_check)>0){
						echo "Booked";
						}
						else{
							echo "Free";
						} ?>
					</td>
					<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Wed' ");
						if(mysqli_num_rows($day_check)>0){
						echo "Booked";
						}
						else{
							echo "Free";
						} ?>
					</td>
					<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Thur' ");
						if(mysqli_num_rows($day_check)>0){
						echo "Booked";
						}
						else{
							echo "Free";
						} ?>
					</td>
					<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Fri' ");
						if(mysqli_num_rows($day_check)>0){
						echo "Booked";
						}
						else{
							echo "Free";
						} ?>
					</td>
					<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Sat' ");
						if(mysqli_num_rows($day_check)>0){
						echo "Booked";
						}
						else{
							echo "Free";
						} ?>
					</td>
				<?php } ?>
			</tr>
		<?php } ?>
	</tbody>
	</table>	
	<!-- Booking form	 -->
	<div class="Container" style="max-width:600px;margin:40px auto;" >  
	<form role="form" action="../actions/bookingfutsal.php" method="Post">
		<h4>Book Futsal</h4>
		<div class="form-group">
		    <label class="control-label">Time</label>
		    <div class="form-group">
		    	<div class="row">
		    		<div class="col">
		    			<label>From</label>
		    			<input type="hidden" name="bid" value="<?php echo $bid; ?>">
		    			<input type="time" name="s_time" required>
		    		</div>
		    		<div class="col">
		    			<label>To</label>
		    			<input type="time" name="e_time" required>
		    		</div>	
		    	</div>
		    </div>
		</div>
		<div class="form-group">
		 	<label class="control-label" for="day">Day</label>
		    <div class="form-group">
		    	<div class="row">
		    		<div class="col">
			    		<select class="form-control" name="day">
			    			<option value='Sun'>Sunday</option>
			    			<option value='Mon'>Monday</option>
			    			<option value='Tue'>Tuesday</option>
			    			<option value='Wed'>Wednesday</option>
			    			<option value='Thur'>Thursday</option>
			    			<option value='Fri'>Friday</option>
			    			<option value='Sat'>Saturday</option>
			    		</select>
			    	</div>
			    </div>
			</div>
		</div>
		<input type="hidden" name=fid value="<?php echo $fid;?>">
		<button type="submit" class="btn btn-primary" name="bookfutsal">Book</button>
	</form>
<?php } ?>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

