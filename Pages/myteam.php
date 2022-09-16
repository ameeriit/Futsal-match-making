<?php
require_once '../connections/db.php';
session_start();
$id=$_SESSION['loggedUser'];
$query=mysqli_query($con,"SELECT tid from users where uid=$id");
$result=mysqli_fetch_assoc($query);
$tid=$result['tid'];
$query1=mysqli_query($con,"SELECT * from users where tid=$tid");
$query2=mysqli_query($con,"SELECT * from teams where tid=$tid");
$row=mysqli_fetch_assoc($query2);
?>

<!DOCTYPE html>
<html>
<head>
<title>My team</title>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
     
 
    <!-- Custom styles  -->
    <link href="../css/blog-home.css" rel="stylesheet">



<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script> 
$(function(){
  $("#header").load("../pages/header.php"); 
   
});
</script> 
</head>
<body class="body">
  <!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- navigation header -->
<div id="header"></div>
<!--Remaining section-->
<div class="container">
  <div class="row">
<!--Entries Column -->
  <div class="col-md-8">
    <!-- alert showing  member add sucess -->
  <?php if(isset($_GET['add_success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Member add successfully.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  <!-- alert showing member add fail -->
  <?php if(isset($_GET['add_fail'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Member add failed.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  <!-- alert showing  member delete sucess -->
  <?php if(isset($_GET['del_success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Member delete successfully.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  <!-- alert showing  member delete fail -->
  <?php if(isset($_GET['del_fail'])){ ?>
    <div class="alert alert-alert alert-dismissible fade show" role="alert">
    <strong>Member delete failed.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  <!-- alert showing  team captaion cannot delete himself-->
  <?php if(isset($_GET['err'])){ ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>You are the captain of your team you cannot delete yourself.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Team Name: <?php echo " ".$row['team_name'] ;?></li>
      <li class="list-group-item">Preferred Venue: <?php echo " ".$row['venue'] ;?></li>
      <li class="list-group-item">Preferred Time: <?php echo " ".$row['start_time']." - ".$row['end_time'] ;?></li>
      <li class="list-group-item">Contact: <?php echo " ".$row['contact'] ;?></li>
    </ul>
    <div class="container">
      <table class="table table-hover">
        <thead><tr><th>Members Detail</th></tr></thead>
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Contact</th>
          </tr>
        </thead>
        <tbody>
           <?php while($row = mysqli_fetch_assoc($query1)) { ?>
          <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['contact'];?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<?php 

//To check whether user is a team captain or not
$query_cap=mysqli_query($con,"SELECT * from teams where owner_id=$id");
if(mysqli_num_rows($query_cap)>0){
  $query3=mysqli_query($con,"SELECT * from users where tid=$tid");
  if(mysqli_num_rows($query3)<8){
    ?>
    <div class="Container" style="max-width:600px;margin:40px auto;" >
      <form action="../actions/add_member.php" method="POST">
        <div class="form-group">
          <label class="control-label" for="fname">Add Member</label>
          <!-- <option type="hidden" name="tid" value="<?php echo $tid ;?>" > -->
          <div class="form-row">
            <div class="col">
              <select class="form-control" name="uid">
                <?php
                  $query4=mysqli_query($con,"SELECT * FROM users where tid=0 and type='player'");
                  while($row4 = mysqli_fetch_assoc($query4)) { ?>
                  <option value="<?php echo $row4['uid']; ?>"><?php echo $row4['email']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div style="text-align: center;" id="showBtn">
          <button  name="addmember" class="btn btn-primary" >Add</button>
        </div>
      </form>
    </div>

  <?php }else{ ?>
      <div class="Container" style="max-width:600px;margin:40px auto;" >
      <form action="../actions/del_member.php" method="POST">
        <div class="form-group">
          <label class="control-label" for="fname">Delete Member</label>
          <!-- <option type="hidden" name="tid" value="<?php echo $tid ;?>" > -->
          <div class="form-row">
            <div class="col">
              <select class="form-control" name="uid">
                <?php
                //query to retrive players in the team
                  $team_players=mysqli_query($con,"SELECT * from users where tid=$tid");
                  while($result_players=mysqli_fetch_assoc($team_players)) { ?>
                  <option value="<?php echo $result_players['uid']; ?>"><?php echo $result_players['name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div style="text-align: center;" id="showBtn">
          <button  name="delmember" class="btn btn-danger" >Delete</button>
        </div>
      </form>
    </div>  
   <?php }  
}?>

</body>
</html>