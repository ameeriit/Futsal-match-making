<!DOCTYPE html>
<html lang="en">
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Futsal Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles template -->
    <link href="../css/blog-home.css" rel="stylesheet">

</head>
<body>

<!-- alert showing not available -->
<?php if(isset($_GET['err_time'])){ ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>No team are available at specified time.</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
<?php } ?>

<!-- alert showing team no present -->
<?php if(isset($_GET['team_err'])){ ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Team doesnot exist.</strong>
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
<div class="col-md-8">            
<!-- Search Widget -->
<div class="card my-4">
  <div border="1">  
    <form action="../pages/search_team.php" method="post" >
      <h5 class="card-header">Search Teams</h5>
      <div class="card-body">
        <div class="input-group">
          <input type="text" class="form-control" name="team" placeholder="Team name">
          <span class="input-group-btn"> 
          <button type="submit" name="submit" class="btn btn-secondary" type="button">Search</button>
          </span> 
        </div>
      </div>
    </form>
    <form action="../pages/search_venue.php" method="post">
      <div class="card-body">
        <div class="input-group">
          <input type="text" class="form-control" name="s_venue" placeholder="Preferred venue">
          <span class="input-group-btn">
            <button type="submit" name="submit" class="btn btn-secondary" type="button">Search</button>
          </span>
        </div>
      </div>
    </form>
    <form action="../pages/search_time.php" method="post">
      <div class="card-body">
        <div class="input-group">
          <div class="form-row">
            <div class="col">
              <label>From</label>
              <input type="time" class="form-control" name="start_time" placeholder="From">
            </div>
            <div class="col">
              <label>To</label>
              <input type="time" class="form-control" name="end_time" placeholder="To">
            </div>
          </div>
        </div>
      </div>

          <div style="text-align: center;" >
          <!-- <span class="input-group-btn"> -->
            <button type="submit" name="submit" class="btn btn-secondary" type="button">Search</button>
          <!-- </span> -->
          </div>
    </form>
  </div>
  <div>
  <form action="../pages/search_futsal.php" method="post">
      <h5 class="card-header">Search Futsal</h5>
      <div class="card-body">
        <div class="input-group">
          <input type="text" class="form-control" name="futsal" placeholder="Futsal name">
          <span class="input-group-btn"> 
          <button type="submit" name="submit" class="btn btn-secondary" type="button">Search</button>
          </span> 
        </div>
      </div>
    </form>
  </div>
</div>
</div>   

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>
</html>

