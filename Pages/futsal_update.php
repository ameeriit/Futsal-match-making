<?php
session_start();
require_once '../connections/db.php';
include '../actions/fupdate.php';
$loggeduser_name=$_SESSION['loggedUser_name'];
$loggeduser_id=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT * FROM futsal where uid= $loggeduser_id");
$row = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update Futsal</title>
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
    <a class="navbar-brand" href="../pages/futsal_dashboard.php">Futsal Match Maker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a href="futsal_dashboard.php"><button type="button" class="btn btn-info">Cancel</button></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="Container" style="max-width:600px;margin:60px auto;" >
  <h3>Update your profile</h3><br><br>
  <?php include "../actions/fupdate_error.php" ; ?>  
  <form role="form" action="futsal_update.php" method="Post">
    <div class="form-group">
      <label class="control-label" for="name">Futsal name</label>
      <div class="form-group">
        <input type="hidden" name="fid" value="<?php echo $row["fid"]; ?>" >
        <input type="text" class="form-control" name="futsalname" value="<?php echo $row["fname"]; ?>" onchange="validate_name(this.value)" required>
        <span id= "err1" style="color:red;"></span>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label" for="venue">Location</label>
      <div class="form-group">
        <input class="form-control" type="text" name="venue" id="venue" value="<?php echo $row["location"]; ?> "onchange="validate_location(this.value)" required>
        <span id= "err2" style="color:red;"></span>
      </div>
    </div>  
    <div class="form-group">
      <div class="form-row">
        <div class="col">
          <label class="control-label" for="time">Opening Time</label>
          <input class="form-group" type="time" name="opn_time" id="time" placeholder="HR:MM" >
        </div>
        <div class="col">
          <label class="control-label" for="time">Closing Time</label>
          <input class="form-group" type="time" name="cls_time" id="time" placeholder="HR:MM" >
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label" for="price">Price</label>
      <div class="form-group">
        <input class="form-control" type="text" name="price" id="price" onchange="validate_price(this.value)" value="<?php echo $row["price"]; ?>">
        <span id= "err3" style="color:red;"></span>
      </div>
    </div>  
    <div class="form-group">
      <label class="control-label" for="contact">Contact</label>
      <div class="form-group">
        <input class="form-control" type="number" name="contact" id="contact" value="<?php echo $row["contact"]; ?>" onchange="validate_contact(this.value)">
        <span id= "err4" style="color:red;"></span>
      </div>
    </div >
    <div id="showBtn">
      <button class="btn btn-primary" name="update" class="btn btn-default">Update</button>
    </div>
  </form>
</div>
<script type="text/javascript">
    var f = 1;
    var c = 1;
    var l = 1;
    var p = 1;
    function validate_name(val){
      var pat_name=/^[a-zA-Z ]+$/;
      if (!pat_name.test(val)){
          document.getElementById('err1').innerHTML="This is invalid Name";
        f = 0;
      }else{
        document.getElementById('err1').innerHTML=" ";
        f = 1;
      }
      if (f==1 && c==1 && l==1 && p==1) {
      $('#showBtn').fadeIn('slow');
      } else {
        $('#showBtn').hide();
      }
    }

    function validate_location(val){
      var pat_location=/^[a-zA-Z ]+$/;
      if (!pat_location.test(val)){
          document.getElementById('err2').innerHTML="This is invalid Location";
        f = 0;
      }else{
        document.getElementById('err2').innerHTML=" ";
        f = 1;
      }
      if (f==1 && c==1 && l==1 && p==1) {
      $('#showBtn').fadeIn('slow');
      } else {
        $('#showBtn').hide();
      }
    }
    function validate_price(val){
      var pat_price=/^[0-9]+$/; 
      if (!pat_price.test(val)){
          document.getElementById('err3').innerHTML="Please provide valid price in number.";
        f = 0;
      }else{
        document.getElementById('err3').innerHTML=" ";
        f = 1;
      }
      if (f==1 && c==1 && l==1 && p==1) {
      $('#showBtn').fadeIn('slow');
      } else {
        $('#showBtn').hide();
      } 
    }

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
              document.getElementById('err4').innerHTML="Invaid number";
            $('#showBtn').hide();
          //    $.alert({
          //      title: 'Invalid Number',
        //        content: 'Invalid Phone number!',
            // });  
            }
            else{
              document.getElementById('err4').innerHTML="";
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
