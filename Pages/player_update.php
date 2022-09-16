<?php
session_start();
require_once '../connections/db.php';
include '../actions/update.php';
$loggeduser_name=$_SESSION['loggedUser_name'];
$loggeduser_id=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT * FROM users where uid= $loggeduser_id");
$row = mysqli_fetch_assoc($query);
$query_acc=mysqli_query($con,"SELECT * from bank where uid= $loggeduser_id");
$result_acc=mysqli_fetch_assoc($query_acc);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Player</title>
</head>
 <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    <link href="../css/blog-home.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- JQuery confirm dependencies -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<body class="body">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navcolor">
  <div class="container">
    <a class="navbar-brand" href="../pages/player_dashboard.php">Futsal Match Maker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a href="player_dashboard.php"><button type="button" class="btn btn-info">Cancel</button></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="Container" style="max-width:600px;margin:60px auto;" >
	<h3>Update your profile</h3><br><br>
	<?php include "../actions/update_error.php" ; ?>  
		<form  name="update_form" action="player_update.php" method="post">
			<input type="hidden" name="uid" value="<?php echo $row["uid"]; ?>">
		<div class="form-group">
			<label class="control-label" for="name">Name</label>
			<div class="form-row">
				<input type="text" name="fname" class="form-control" value="<?php echo $row["name"]; ?>" required onchange="validate_name(this.value)">
 			 	<span id= "err" style="color:red;"></span>
			</div>
		</div>

		<!-- ************Email validation is removed add onchange function as onchange="validate_email(this.value)" ************ -->
		<div class="form-group">
			<label for="email" class="control-label">Email</label>
			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control" value="<?php echo $row["email"]; ?>" onchange="check_email(this.value)" required email >
				<span id='err3' style="color:red;"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label" for="pwd">Password</label>
			<div class="form-group">
				<input class="form-control" type="password" name="password" id="pwd" placeholder="Password" required onchange="validate_password(this.value)">
				<span id='err4' style="color:red;"></span>
			</div>
		</div>
		<!-- ************contact validation is stopped add onchange function as onchange="validate_contact(this.value)" ************ -->
		<div class="form-group">
			<label class="control-label" for="contact">Contact</label>
			<div class="form-group">
				<input class="form-control" type="number" name="contact" id="contact" value="<?php echo $row["contact"]; ?>" required >
				<span id= "err5" style="color:red;"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label" for="account">Account no</label>
			<div class="form-group">
				<input class="form-control" type="number" name="accno" value="<?php echo $result_acc["accno"]; ?>"  >
				<span id= "err5" style="color:red;"></span>
			</div>
		</div>
		<div style="text-align: center;" id="showBtn">
 			<button  name="update" class="btn btn-info">update</button>
 		</div>
 	</form>
</div>
<script type="text/javascript">
		var f = 1;
		var c = 1;
		var e = 1;
		var p = 1;
		var n = 1;
		function validate_name(val){
			var pat_name=/^[a-zA-Z ]+$/;
			if (!pat_name.test(val)){
		    	document.getElementById('err').innerHTML="This is invalid Name";
				f = 0;
			}else{
				document.getElementById('err').innerHTML=" ";
				f = 1;
			}
			if (f==1 && c==1 && e==1 && p==1 && n==1) {
			$('#showBtn').fadeIn('slow');
			} else {
				$('#showBtn').hide();
			}
		}
		
		// validating duplicate email id entry handled by error.php
		// function check_email(val){
		// 	alert("inside check email");
		// 	 var email_address = val;
			
		// 	$.ajax({
		// 		url:"../actions/update.php",
		// 		method:"post",
		// 		data:{
		// 			email:email_address,
		// 			uid:<?php echo $_SESSION['loggedUser']; ?>
		// 		},
		// 	success:function(data){
		// 		$('#err1').html(data);
		// 		}
		// 	})
		// }

		//Validating email using api call
		function validate_email(val){
			//alert("inside validate email");
			var email_address= val;
			
			// $.ajax({
			// 	url:"../actions/update.php",
			// 	method:"post",
			// 	data:{
			// 		email:email_address,
			// 		uid:<?php echo $_SESSION['loggedUser']; ?>
			// 	},
			// success:function(data){
			// 	$('#err1').html(data);
			// 	}
			// })

			// set endpoint and your access key
			var access_key = '4a51d0df3e83a362e1913ece36a02ace';
			
			// verify email address via AJAX call
			$.ajax({
			    url: 'http://apilayer.net/api/check?access_key=' + access_key + '&email=' + email_address+'&smtp=1&format=1',   
			    dataType: 'jsonp',
			    success: function(json) {
			    	var valid = json.format_valid;
			    	var smtp = json.smtp_check;
			    	var mx = json.mx_found;
			    	if( valid!=1 || smtp!=1 || mx!=1){
			    		e=0;
						document.getElementById('err3').innerHTML="Invaid Email";
						$('#showBtn').hide();
					}else{
						document.getElementById('err3').innerHTML="";
				    	$('#showBtn').fadeIn('slow');
					}

 
			    // Access and use your preferred validation result objects
			    console.log(json.format_valid);
			    console.log(json.smtp_check);
			    console.log(json.mx_found);
			    console.log(json.score);
			                
			    }
			});
		}


		//Validating password with 8 as valid length	
		
		function validate_password(val){			
    		if (val.length<8){
				document.getElementById('err4').innerHTML="Password must be 8 character long";
				p = 0;
    		}else{
    			document.getElementById('err4').innerHTML=" ";
    			p = 1;
    		}
    		if (f==1 && c==1 && e==1 && p==1 && n==1) {
			$('#showBtn').fadeIn('slow');
			} else {
				$('#showBtn').hide();
			}
    	}
    		
	    //Checking validity of phone number using api
	    		
		function validate_contact(val) {  
		
			// set endpoint and your access key
			var access_key = '5b4c4477c1bfc92253c9ee5c980605e4';
			var phone_number = val;
			

			// verify phone number via AJAX call
			$.ajax({
			    url: 'http://apilayer.net/api/validate?access_key=' + access_key + '&number=' + phone_number + '&format=1&country_code=NP',   
			    dataType: 'jsonp',
			    success: function(json) {

				    // Access and use your preferred validation result objects
				    var valid=json.valid;
				    var linetyp=json.line_type;
				    //alert(linetyp);
				    if (valid!=1 || linetyp=="special_services"){
				    	n=0;
				    	document.getElementById('err5').innerHTML="Invaid number";
						$('#showBtn').hide();
				  //   	$.alert({
		  		// 			title: 'Invalid Number',
		    // 				content: 'Invalid Phone number!',
						// });	
				    }
				    else{
				    	document.getElementById('err5').innerHTML="";
				    	$('#showBtn').fadeIn('slow');
				    }
				    console.log(json.country_code);
				    console.log(json.carrier);
				    console.log(json.local_format);
				    console.log(json.country_name);
				    console.log(json.international_format);
				    console.log(json.location);
				    console.log(json.line_type);
	        	},
	        	async: false // <- this turns it into synchronous

	        });
	        
	    }

	</script>
</body>
</html>
