<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Futsal Management System</title>

    <!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles template -->
    <link href="../css/blog-home.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script> 
      $(function(){
        $("#header").load("header.php"); 
       // $("#search").load("../pages/search.php");
      });
    </script> 
     <style>
     .btn1{
      padding: 10px 80px !important;
      font-size: 20px !important;
      border-radius: 10px !important;
      background-color:#343a40 !important; 
     }
     .colorcustom{
      color: #00004d !important;
     }
     .colorcustom2{
      background-color: #343a40 !important;
     }
      
     </style> 
  </head>

<body class="body">
   
  <!-- Calling header -->
  <div id="header"></div>
  <?php if(isset($_GET['success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Game delete successful.</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
  <?php }?>
  <!-- alert showing  delete sucess -->
  <?php if(isset($_GET['bookdelsuccess'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successfully Cancelled.<br>Amount Rs.300 has been added to your bank account.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  <!-- alert showing team no game -->
  <?php if(isset($_GET['already'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Match create failed.<br>You already have accepted game for this date and time.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  <!-- alert showing team no game -->
  <?php if(isset($_GET['nogame_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>You dont have any accepted game.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  <!-- alert showing team no present -->
  <?php if(isset($_GET['team_err'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Opponent team with this name doesnot exists.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  <!--   Showing team create alert preventing player from creating multiple team -->
  <?php if(isset($_GET['err'])){ ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>You are already in a team.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php }?>
  <!--   Showing alert if player tries to create team with already present team name -->
  <?php if(isset($_GET['sameteamname'])){ ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>There is already a team with this name.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php }?>
  <!--   Showing view myteam and leave team error creating alert if player is not in any team -->
  <?php if(isset($_GET['err_myteam'])){ ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>You are not in any team.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php }?>
  <!--   Showing view myteam and leave team error creating alert if player is not in any team -->
  <?php if(isset($_GET['noteam'])){ ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>You are not in any team, you need to be in team.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php }?> 
  <!--   Showing delete team alert preventing unauthorized player to delete a team -->
  <?php if(isset($_GET['err_delteam'])){ ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>You are not a team captain, you cannot delete a team
  </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php }?>
  <!-- Delete success -->
  <?php if(isset($_GET['delteam'])){ ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Team successfully deleted.
  </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php }?>
  <!-- alert showing captain cannot leave the team -->
  <?php if(isset($_GET['err_leaveteam'])){ ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>You are the captain of the team, you cannot leave the team.<br>If you want to leave the team you have to delete it.
  </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php }?>
  <!-- leave success -->
  <?php if(isset($_GET['leaveteam'])){ ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successfully left team.
  </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php }?> 
  <!-- match create success -->
  <?php if(isset($_GET['matchreq'])){ ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successfully created a match.
  </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php }?> 
  <!-- match create failed -->
  <?php if(isset($_GET['err_matchreq'])){?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Failed to create Match.
      </strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <?php } ?>
  <!-- Error during create team same id as current user -->
  <?php if(isset($_GET['err_sameid'])){?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Create team failed, do no select yourself as a member.
      </strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <?php } ?>
  <!-- Error during create team same members-->
  <?php if(isset($_GET['err_same'])){?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Create team failed, Select different members.
      </strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <?php } ?>
  <!-- create team success -->
  <?php if(isset($_GET['create_team'])){ ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successfully created a team.
  </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php }?> 
  <!-- Error during create team -->
  <?php if(isset($_GET['err_create_team'])){?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Create team failed.
      </strong>
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

<!-- Search pgae inserted -->
<!-- alert showing not available -->
<?php if(isset($_GET['err_time'])){ ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>No opponent teams are available at specified time.</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
<?php } ?>

<!-- alert showing venue not present -->
<?php if(isset($_GET['venue_err'])){ ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>This futsal doesnot exist.</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php } ?>

  <!-- alert showing you have accepted game  -->
  <?php if(isset($_GET['err_accgame'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>You have a accepted match.<br>You cannot leave team.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>

  <!-- alert showing  game cancel failed  -->
  <?php if(isset($_GET['gamecancel_failed'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Your game cancellation was failed.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>

  <!-- alert showing game cancellation successful -->
  <?php if(isset($_GET['gamecancel_success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>You have successfully cancelled game.<br>All team members are sent a email of cancellation.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>

  <!-- alert showing game accept mail successful -->
  <?php if(isset($_GET['gameacceptmsg_success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>All team members are sent a email about the game.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  
  
  <!-- alert showing game cancellation mail successful -->
  <?php if(isset($_GET['gamecancelmsg_success'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>All team members are sent a email of cancellation.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  
  <!-- alert showing  game cancel email failed  -->
  <?php if(isset($_GET['gamecancelmsg_failed'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Your game cancel email sending failed.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>


  <!-- alert showing  game accept email failed  -->
  <?php if(isset($_GET['gameacceptmsg_failed'])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Your game accept email sending failed.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  <?php } ?>
  
  <div class="row">
    <div class="col-md-8">            
      <!-- Search Widget -->
      <div class="card my-4 colorcustom">
        <div border="1">  
          <form action="../pages/search_team.php" method="post" >
            <h4 class="card-header">Find opponent</h4>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" name="team" placeholder="Team name">
                <span class="input-group-btn"> 
                <button type="submit" name="submit" class="btn btn-secondary colorcustom2" type="button">Search</button>
                </span> 
              </div>
            </div>
          </form>
          <form action="../pages/search_venue.php" method="post">
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" name="s_venue" placeholder="Preferred venue">
                <span class="input-group-btn">
                  <button type="submit" name="submit" class="btn btn-secondary colorcustom2" type="button">Search</button>
                </span>
              </div>
            </div>
          </form>
          <form action="../pages/search_time.php" method="post">
            <div class="card-body">
              <div class="input-group">
                  <label class="form-control">From</label><br>
                  <input type="time" class="form-control" name="start_time" placeholder="From"><br>
                  <label class="form-control" >To</label>
                  <input type="time" class="form-control" name="end_time" placeholder="To">
                  <!-- </div> -->
                  <button type="submit" name="submit" class="btn btn-secondary colorcustom2" type="button">Search</button>
              </div>
            </div>
          </form>
        </div>
        <div>
          <form action="../pages/search_futsal.php" method="post">
            <h4 class="card-header">Search Futsal</h4>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" name="futsal" placeholder="Futsal name">
                <span class="input-group-btn"> 
                <button type="submit" name="submit" class="btn btn-secondary colorcustom2" type="button">Search</button>
                </span> 
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card my-4 colorcustom">
        <div border="1">
          <h4 class="card-header">Secure your place</h4>
          <div class="card-body">
            <a href="../pages/bookfutsal1.php"><button class="btn btn-primary btn1">BOOK NOW</button></a>
          </div>
        </div>
      </div>
      <div class="card my-4 colorcustom">
        <div border="1">
          <h4 class="card-header">Check Your booking</h4>
          <div class="card-body">
            <a href="../pages/notifymybooking.php"><button class="btn btn-primary btn1">MY BOOKING</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  
<!-- Footer -->
<footer id="footer">
  <p>Copyright Futsal Match Maker &copy; 2018</p>
</footer>

  
 
<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
