<?php 
require_once '../connections/db.php';
include '../actions/server.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup as User</title>
	
		
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

  </head>

  <body class="body">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navcolor">
      <div class="container">
        <a class="navbar-brand" href="#">Futsal Match Maker</a>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a href="../index.php"><button type="button" class="btn btn-info">Log In</button></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<div class="Container" style="max-width:600px;margin:60px auto;" >
	<h3>Signup Before Continuing</h3><br><br>
	<!-- //insert into bank failed alert -->
	<?php if(isset($_GET['bank_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Couldnot create bank detail.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
	<?php } ?>

	<?php include "../actions/error.php" ; ?> 
		<form  action="signup.php" method="post">
		<div class="form-group">
			<label class="control-label" for="name">Name</label>
			<div class="form-row">
				<div class="col">
 			 		<input type="text" name="fname" class="form-control" placeholder="First name" required onchange="validate_firstname(this.value)">
 			 		<span id= "err" style="color:red;"></span>
				</div>
				<div class="col">
  					<input type="text" name="lname" class="form-control" placeholder="Last name" required onchange="validate_lastname(this.value)">
  					<span id= "err2" style="color:red;"></span>
				</div>
			</div>
		</div>

		<!-- ************Email validation is removed add onchange function as onchange="validate_email(this.value)" ************ -->
		<div class="form-group">
			<label for="email" class="control-label">Email</label>
			<div class="form-group">
				<input type="email" name="email" id="email" onchange="validate_email(this.value)" class="form-control" placeholder="someone@something.com" required email >
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
		<div class="form-group">
			<label class="control-label" for="type">Type</label>
			<div class="form-group">
				<select class="form-control" name="type">
					<option>Choose a value</option>
					<option value="player">Player</option>
					<option value="futsal">Futsal Owner</option>
				</select>
				
			</div>
		</div>
		<!-- ************contact validation is stopped add onchange function as onchange="validate_contact(this.value)" ************ -->
		<div class="form-group">
			<label class="control-label" for="contact">Contact</label>
			<div class="form-group">
				<input class="form-control" type="number" name="contact" id="contact"  onchange="validate_contact(this.value)" placeholder="skip +977" required >
				<span id= "err5" style="color:red;"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label" for="contact">Bank detail</label>
			<div class="form-group">
				<select class="form-control" id="cmbSelectType">
					<option>Choose a value</option>
					<option value="no">Dont provide</option>
					<option value="yes">Provide</option>
				</select>
			</div>
		</div>
		<div class="form-group" style="display:none;" id="Accno">
			<label class="control-label">Account number</label>
			<div class="form-group">
				<input class="form-control" type="number" name="accno" placeholder="Account number">
			</div>
		</div>
		<div style="text-align: center;" id="showBtn">
 			<button type="submit" name="signup" class="btn btn-info" >Sign up</button>
 		</div>
 	</form>
</div>
	<script type="text/javascript">
		var f = 1;
		var l = 1;
		var e = 1;
		var p = 1;
		var n = 1;
		function validate_firstname(val){
			var pat_name=/^[a-zA-Z]+$/;
			if (!pat_name.test(val)){
		    	document.getElementById('err').innerHTML="This is invalid firstname";
				f = 0;
			}else{
				document.getElementById('err').innerHTML=" ";
				f = 1;
			}
			if (f==1 && l==1 && e==1 && p==1 && n==1) {
			$('#showBtn').fadeIn('slow');
			} else {
				$('#showBtn').hide();
			}
		}
		
		function validate_lastname(val){
			var pat_name=/^[a-zA-Z]+$/;
			if (!pat_name.test(val)){
		    	
				document.getElementById('err2').innerHTML="This is invalid Lastname";
				l = 0;
			}else{
				document.getElementById('err2').innerHTML=" ";
				l = 1;
			}
			if (f==1 && l==1 && e==1 && p==1 && n==1) {
			$('#showBtn').fadeIn('slow');
			} else {
				$('#showBtn').hide();
			}
		}

		//Validating email

		function validate_email(val){
			// set endpoint and your access key
			var access_key = '4a51d0df3e83a362e1913ece36a02ace';
			var email_address = val;
			//alert(email_address);

			// verify email address via AJAX call
			$.ajax({
			    url: 'http://apilayer.net/api/check?access_key=' +access_key+ '&email=' +email_address+'&smtp=1&format=1',   
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
    		if (f==1 && l==1 && e==1 && p==1 && n==1) {
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
	<script type="text/javascript">
		$('#cmbSelectType').change(function() {
			var type = $(this).val();
			if (type == 'yes') {
				$('#Accno').fadeIn('slow');
			} else {
				$('#Accno').hide();
			}
		});
	</script>	 
	
</body>
</html>
