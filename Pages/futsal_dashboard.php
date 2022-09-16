<?php
include "../connections/db.php";
session_start();
$id=$_SESSION['loggedUser'];
//Query to retrive fid of current user
$query=mysqli_query($con,"SELECT fid from futsal where uid=$id");
$result=mysqli_fetch_assoc($query);
$fid=$result['fid'];  
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Futsal Owner Dashboard</title>

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
    <script> 
      $(function(){
        $("#fheader").load("../pages/fheader.php"); 
      });
    </script> 
 
</head>
<body class="body"><!-- Calling header -->
  <div id="fheader"></div>
<!-- Alert showing you aleardy have a team -->
  <?php if(isset($_GET['err'])){ ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>You have already created a futsal.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
<!-- Alert showing you dont have futsal -->
  <?php if(isset($_GET['err_myfutsal'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>You dont have a futsal.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
<!-- Alert show delete error -->
  <?php if(isset($_GET['del_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Delete futsal failed.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>

  <!--Alert showing futsal create success -->
  <?php if(isset($_GET['create_success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Futsal created successfully.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  
  <!--Alert showing futsal update success -->
  <?php if(isset($_GET['update_success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Futsal updated successfully.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  <!--Alert showing futsal update error -->
  <?php if(isset($_GET['update_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Futsal update failed.</strong>
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
    <strong>Successully booked.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- alert showing booking error-->
<?php if(isset($_GET['insert_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Not booked.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- alert showing view error -->
<?php if(isset($_GET['viewdetail_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Couldnot view.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>
<!-- Error No booking made-->
  <?php if(isset($_GET['nobooking'])){?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>You dont have any booking.
      </strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <?php } ?>
  <!-- Error in booking -->
  <?php if(isset($_GET['error'])){?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Booking unsuccessful. Please select time with one hour gap. Eg 6-7 , 4-5
      </strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <?php } ?>
  <?php 
  //query to retrive start time and end time of futsal
  $time_query=mysqli_query($con,"SELECT * from futsal where fid=$fid");
  $time_result=mysqli_fetch_assoc($time_query);
  $open_time=$time_result['opening_time'];
  $close_time=$time_result['closing_time']; 
  //query to retrive booking table id of futsal
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
        echo $x.":00 - ".$y.":00"; ?></th>
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
            $result=mysqli_fetch_assoc($sun_check); 
            if(mysqli_num_rows($sun_check)>0){ ?>
            <button class="btn btn-primary view" id="<?php echo $result['uid'];?>">Booked</button>
            <?php }
            else{
              echo "Free";
            } ?>
          </td>
          <td><?php $mon_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Mon' ");
            $result=mysqli_fetch_assoc($mon_check);
            if(mysqli_num_rows($mon_check)>0){
            ?><button class="btn btn-primary view" id="<?php echo $result['uid'];?>">Booked</button>
            <?php }
            else{
              echo "Free";
            } ?>
          </td>
          <td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Tue' ");
            $result=mysqli_fetch_assoc($day_check);
            if(mysqli_num_rows($day_check)>0){
            ?><button class="btn btn-primary view" id="<?php echo $result['uid'];?>">Booked</button>
            <?php }
            else{
              echo "Free";
            } ?>
          </td>
          <td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Wed' ");
            $result=mysqli_fetch_assoc($day_check);          
            if(mysqli_num_rows($day_check)>0){
            ?><button class="btn btn-primary view" id="<?php echo $result['uid'];?>">Booked</button>
            <?php }
            else{
              echo "Free";
            } ?>
          </td>
          <td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Thur' ");
            $result=mysqli_fetch_assoc($day_check);
            if(mysqli_num_rows($day_check)>0){
            ?><button class="btn btn-primary view" id="<?php echo $result['uid'];?>">Booked</button>
            <?php }
            else{
              echo "Free";
            } ?>
          </td>
          <td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Fri' ");
            $result=mysqli_fetch_assoc($day_check);
            if(mysqli_num_rows($day_check)>0){
            ?><button class="btn btn-primary view" id="<?php echo $result['uid'];?>">Booked</button>
            <?php }
            else{
              echo "Free";
            } ?>
          </td>
          <td><?php $day_check=mysqli_query($con,"SELECT * from booking_details where bid=$bid and s_time='$as_time' and e_time='$ae_time' and day='Sat' ");
            $result=mysqli_fetch_assoc($day_check);
            if(mysqli_num_rows($day_check)>0){
            ?><button class="btn btn-primary view" id="<?php echo $result['uid'];?>">Booked</button>
            <?php }
            else{
              echo "Free";
            } ?>
          </td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
  </table>
<a name="update_bookingtable">    
  <!-- Update form  -->
  <div class="Container" style="max-width:600px;margin:40px auto;" >  
  <form role="form" action="../actions/updatefutsalbooking.php" method="Post">
    <h4>UPDATE FUTSAL</h4>
    <div class="form-group">
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
    <button type="submit" class="btn btn-primary" name="bookfutsal">Book</button>
  </form>
</div>
</a>

<!-- For Modal -->
<div id="dataModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">  
    <div class="modal-dialog" role="document">  
       <div class="modal-content">  
            <div class="modal-header" style="background-color:#212529 !important ;">  
                 <h5 class="modal-title" style="color: #ffffff !important;">Details</h5>
                 <button type="button" style="color: #ffffff !important;" class="close" data-dismiss="modal" aria-label="Close">&times;</button>  
            </div>  
            <div class="modal-body">
                <label>Name: </label><textfield id="Idname"></textfield><br>  
                <Label>Email: </Label><span id="Idemail"></span><br>
                <Label>Contact: </Label><span id="Idcontact"></span><br>
            </div>  
            <div class="modal-footer">  
                 <button type="button" style="background-color:#212529 !important ;color:#ffffff !important;" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>  
       </div>  
    </div> 
</div> 

<script>
  $(document).ready(function(){
    $('.view').click(function(){
      var uid = $(this).attr("id");
     // alert(uid); 
      //alert(assignment_id); 
      $.ajax({  
          url:"../pages/view_bookeduser.php",  
          method:"POST",  
          data:{
              uid:uid
          },  
          success:function(json){ 
              console.log(json); 
              var reply = json;
              var obj = JSON.parse(reply);
              console.log(obj);
             // document.getElementById("Idname").innerHTML = obj.name + ", " + obj.contact;
              $('#Idname').html(obj.name);
              $('#Idemail').html(obj.email);
              $('#Idcontact').html(obj.contact);  
              $('#dataModal').modal("show");  
          }  
      });  
    });
  });
</script>

</body>
</html>