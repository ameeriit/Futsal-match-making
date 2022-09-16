
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap core CSS -->
  <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">
    <script type="text/javascript">
      
    </script>
</head>

<body class="body">

<!-- User not found-->
<?php if(isset($_GET['err_login'])){?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>User no found.
    </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php } ?>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navcolor">
    <div class="container">
      <a class="navbar-brand" href="#">Futsal Match Maker</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      </div>
    </div>
  </nav>
<div class="Container" style="max-width:600px;margin:60px auto;" >
<h3>Login</h3><br><br>
<form  action="actions/login.php" method="Post" >
  <div class="form-group">
    <label class="control-label" for="name">Username</label>
      <div class="form-group">
        <!--  cadd this to code below to validate email onchange="validate_user(this.value)" -->
        <input type="text" class="form-control" name="username" onchange="validate_user(this.value)" placeholder="Username" required>
        <span id="err1" style="color:red;"></span>        
      </div>
  </div>
  <div class="form-group">
    <label class="control-label" for="pwd" >Password</label>
    <div class="form-group">
      <input class="form-control" type="password" name="password" id="pwd" placeholder="Password" required>
      <span id="err2" style="color:red;"></span>
    </div>
  </div>  
  <div>
    <button type="submit" name="login" class="btn btn-info" id="showBtn">Log In</button>
    <a href="./pages/signup.php">Sign up</a>
  </div>  
</form>
</div>
<script type="text/javascript">
var u=1;
var p=1;

function validate_user(val){
  // set endpoint and your access key
      var access_key = '4a51d0df3e83a362e1913ece36a02ace';
      var email_address = val;
      //alert(email_address);

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
            document.getElementById('err1').innerHTML="Invaid Email";
            $('#showBtn').hide();
          }else{
            document.getElementById('err1').innerHTML="";
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

function validate_password(val){      
  if (val.length<8){
  document.getElementById('err2').innerHTML="Password must be 8 character long";
  p = 0;
  }else{
    document.getElementById('err2').innerHTML=" ";
    p = 1;
  }
  if (u==1 && p==1) {
    $('#showBtn').fadeIn('slow');
  }else{
    $('#showBtn').hide();
  }
}   
</script>
<script type="text/javascript"></script>
<script src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
