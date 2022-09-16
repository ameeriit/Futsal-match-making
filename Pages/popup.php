<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<body>

<div class="container">
	<!-- <div class="alert alert-danger alert-dismissible" id="error">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Invalid Number</strong>
	 </div> -->
	<div>
		<label>Number:</label>
		<input type="number" name="phone_number" value =" " onchange="myFunction(this.value)"/>
	</div>
</div>
<script type="text/javascript">
	function myFunction(val) {  
			alert("Inside jquery");
				// set endpoint and your access key
			var access_key = '5b4c4477c1bfc92253c9ee5c980605e4';
			var phone_number = val;
			alert(phone_number);

			// verify phone number via AJAX call
			$.ajax({
			    url: 'http://apilayer.net/api/validate?access_key=' + access_key + '&number=' + phone_number + '&format=1&country_code=NP',   
			    dataType: 'jsonp',
			    success: function(json) {

			    // Access and use your preferred validation result objects
			    var v=json.valid;
			    alert(v);
			    var linetyp=json.line_type;
			    alert(linetyp);
			    if (v!=1 || linetyp=="special_services"){
			    $.alert({
  					title: 'Alert!',
    				content: 'Invalid Phone number!',
					});	
			    }
			    
			    console.log(json.country_code);
			    console.log(json.carrier);
			    console.log(json.local_format);
			    console.log(json.country_name);
			    console.log(json.international_format);
			    console.log(json.location);
			    console.log(json.line_type);
			                
			    }
			});
        };
</script>	 
</body>
</html>
