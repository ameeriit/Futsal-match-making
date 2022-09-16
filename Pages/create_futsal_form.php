<?php
include "../connections/db.php";
session_start();
$id=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT * from users where uid=$id");
$result=mysqli_fetch_assoc($query);
$contact=$result['contact'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create team form</title>
<!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  


    <!-- Custom styles template -->
    <link href="../css/blog-home.css" rel="stylesheet">

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
     <!-- JQuery confirm dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<!-- custom css for body -->
<body class="body">
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navcolor">
  <div class="container">
    <a class="navbar-brand" href="../pages/player_dashboard.php">Futsal Match Maker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>
<!--Remaining section-->
  <!--Alert showing delete success -->
  <?php if(isset($_GET['del_success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Futsal deleted successfully.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  <!--Alert showing futsal create error-->
  <?php if(isset($_GET['create_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Futsal with this name and location already present.<br>Please enter your actual futsal detail.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>

<div class="Container" style="max-width:600px;margin:60px auto;" >  

  <form type="form-inline" role="form" action="../actions/create_futsal.php" method="Post">
    <div class="form-group">
      <label class="control-label" for="name">Futsal name</label>
      <div class="form-group">
        <input type="text" class="form-control" name="futsalname" placeholder="Futsal name" onchange="validate_name(this.value)" required>
        <span id= "err1" style="color:red;"></span>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label" for="venue">Location</label>
      <div class="form-group">
        <input class="form-control" type="text" name="venue" id="venue" placeholder="Location" onchange=" validate_location(this.value)" required>
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
        <input class="form-control" type="text" name="price" id="price" onchange="validate_prive(this.value)" placeholder="per hr">
        <span id= "err3" style="color:red;"></span>
      </div>
    </div>  
    <div class="form-group">
      <label class="control-label" for="contact">Contact</label>
      <div class="form-group">
        <input class="form-control" type="number" name="contact" id="contact" onchange="validate_contact(this.value)" value="<?php echo $contact ;?>">
        <span id= "err4" style="color:red;"></span>
      </div>
    </div>
    <div id="showBtn">
      <button type="submit" class="btn btn-primary" class="btn btn-default">Create</button>
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