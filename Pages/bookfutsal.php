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
    <strong>Successully booked.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- alert showing booking error-->
<?php if(isset($_GET['insert_err'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Not booked.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<div class="Container" style="max-width:600px;margin:40px auto;" >  
<form role="form" action="bookfutsal.php" method="Post">
	<div class="form-group">
	    <label class="control-label" for="fname">Select Futsal</label>
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col">
		    		<select class="form-control" name="fname" required>
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
<?php if(isset($_POST['futsal_selected'])){ ?>
	<?php 
	$fid=$_POST['fname']; 
	//query to retrive booking table id of selected futsal
	$bid_query=mysqli_query($con,"SELECT bid from booking_table where fid=$fid");
	$retrive_bid=mysqli_fetch_assoc($bid_query);
	$bid=$retrive_bid['bid'];
	//query to retrive booking detail of selected futsal
	//$detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid"); 
	?>
	<!-- Creating a table with two heading -->
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
		<tr>
		<th scope="row">6:00 - 7:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00'");
		if(!$detail_query){ ?>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
		<tr>
		<th scope="row">7:00 - 8:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='07:00:00' and e_time='08:00:00'");
		if(!$detail_query){ ?>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='07:00:00' and e_time='08:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='07:00:00' and e_time='08:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='07:00:00' and e_time='08:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='07:00:00' and e_time='08:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='07:00:00' and e_time='08:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='07:00:00' and e_time='08:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='07:00:00' and e_time='08:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
		<tr>
		<th scope="row">8:00 - 9:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='08:00:00' and e_time='09:00:00'");
		if(!$detail_query){ ?>
			<td>milena</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='08:00:00' and e_time='09:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
		<tr>
		<th scope="row">6:00 - 7:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00'");
		if(!$detail_query){ ?>
			<td>milena</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
		<tr>
		<th scope="row">6:00 - 7:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00'");
		if(!$detail_query){ ?>
			<td>milena</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
		<tr>
		<th scope="row">6:00 - 7:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00'");
		if(!$detail_query){ ?>
			<td>milena</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
		<tr>
		<th scope="row">6:00 - 7:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00'");
		if(!$detail_query){ ?>
			<td>milena</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
		<tr>
		<th scope="row">6:00 - 7:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00'");
		if(!$detail_query){ ?>
			<td>milena</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
		<tr>
		<th scope="row">6:00 - 7:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00'");
		if(!$detail_query){ ?>
			<td>milena</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
		<tr>
		<th scope="row">6:00 - 7:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00'");
		if(!$detail_query){ ?>
			<td>milena</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
		<tr>
		<th scope="row">6:00 - 7:00</th>
		<?php $detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00'");
		if(!$detail_query){ ?>
			<td>milena</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
			<td>free</td>
		<?php }else{  ?>
			<td><?php $sun_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sun' ");
				if(mysqli_num_rows($sun_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Mon' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Tue' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Wed' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Thur' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Fri' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='06:00:00' and e_time='07:00:00' and day='Sat' ");
				if(mysqli_num_rows($day_check)>0){
				echo "Booked";
				}
				else{
					echo "Free";
				} ?>
			</td>
			<?php }?>
		</tr>
	</tbody>
	</table>

	<!-- table with days as heading --> 
	<!-- <div class="container fluid">
		<div class="row">
			<div class="col-md-1">	
				<table class="table table-hover table-bordered tableborder" >
			      <thead>
			        <tr>
			          <th scope="row">Sunday</th>
			        </tr>
			      </thead>
			      <tbody>
			      <?php //query to retrive booking detail of selected futsal
					$detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and day='Sun'"); 
					while($row_detail=mysqli_fetch_assoc($detail_query)) { ?>	
			      <tr>
			      	<td><?php echo $row_detail['s_time']."<->".$row_detail['e_time'] ; ?></td>
			      </tr>
			      <?php } ?>
			  	</tbody>
				</table>
			</div>
			<div class="col-md-1">	
				<table class="table table-hover">
			      <thead>
			        <tr>
			          <th scope="row">Monday</th>
			        </tr>
			      </thead>
			      <tbody>
			      <?php //query to retrive booking detail of selected futsal
					$detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and day='Mon'"); 
					while($row_detail=mysqli_fetch_assoc($detail_query)) { ?>	
			      <tr>
			      	<td><?php echo $row_detail['s_time']."<->".$row_detail['e_time'] ; ?></td>
			      </tr>
			      <?php } ?>
			  	</tbody>
				</table>
			</div>
			<div class="col-md-1">	
				<table class="table table-hover">
			      <thead>
			        <tr>
			          <th scope="row">Tuesday</th>
			        </tr>
			      </thead>
			      <tbody>
			      <?php //query to retrive booking detail of selected futsal
					$detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and day='Tue'"); 
					while($row_detail=mysqli_fetch_assoc($detail_query)) { ?>	
			      <tr>
			      	<td><?php echo $row_detail['s_time']."<->".$row_detail['e_time'] ; ?></td>
			      </tr>
			      <?php } ?>
			  	</tbody>
				</table>
			</div>
			<div class="col-md-1">	
				<table class="table table-hover">
			      <thead>
			        <tr>
			          <th scope="row">Wednesday</th>
			        </tr>
			      </thead>
			      <tbody>
			      <?php //query to retrive booking detail of selected futsal
					$detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and day='Wed'"); 
					while($row_detail=mysqli_fetch_assoc($detail_query)) { ?>	
			      <tr>
			      	<td><?php echo $row_detail['s_time']."<->".$row_detail['e_time'] ; ?></td>
			      </tr>
			      <?php } ?>
			  	</tbody>
				</table>
			</div>
			<div class="col-md-1">	
				<table class="table table-hover">
			      <thead>
			        <tr>
			          <th scope="row">Thursday</th>
			        </tr>
			      </thead>
			      <tbody>
			      <?php //query to retrive booking detail of selected futsal
					$detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and day='Thur'"); 
					while($row_detail=mysqli_fetch_assoc($detail_query)) { ?>	
			      <tr>
			      	<td><?php echo $row_detail['s_time']."<->".$row_detail['e_time'] ; ?></td>
			      </tr>
			      <?php } ?>
			  	</tbody>
				</table>
			</div>
			<div class="col-md-1">	
				<table class="table table-hover">
			      <thead>
			        <tr>
			          <th scope="row">Friday</th>
			        </tr>
			      </thead>
			      <tbody>
			      <?php //query to retrive booking detail of selected futsal
					$detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and day='Fri'"); 
					while($row_detail=mysqli_fetch_assoc($detail_query)) { ?>	
			      <tr>
			      	<td><?php echo $row_detail['s_time']."<->".$row_detail['e_time'] ; ?></td>
			      </tr>
			      <?php } ?>
			  	</tbody>
				</table>
			</div>
			<div class="col-md-1">	
				<table class="table table-hover">
			      <thead>
			        <tr>
			          <th scope="row">Saturday</th>
			        </tr>
			      </thead>
			      <tbody>
			      <?php //query to retrive booking detail of selected futsal
					$detail_query=mysqli_query($con,"SELECT * from booking_details where bid=$bid and day='Sat'"); 
					while($row_detail=mysqli_fetch_assoc($detail_query)) { ?>	
			      <tr>
			      	<td><?php echo $row_detail['s_time']."<->".$row_detail['e_time'] ; ?></td>
			      </tr>
			      <?php } ?>
			  	</tbody>
				</table>
			</div>
		</div>
	</div> -->	
	<!-- Booking form	 -->
	<div class="Container" style="max-width:600px;margin:40px auto;" >  
	<form role="form" action="../actions/bookingfutsal.php" method="Post">
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
			    			<option value='Thur'>Tursday</option>
			    			<option value='Fri'>Friday</option>
			    			<option value='Sat'>Saturday</option>
			    		</select>
			    	</div>
			    </div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary" name="bookfutsal">Book</button>
	</form>
<?php } ?>
<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

