<link href="../resources/bootstrap/css/bootstrap.min.css"  rel="stylesheet">

<script type="text/javascript" src="../resources/js/popper.min.js"></script>

<link href="../resources/webfonts/css/fontawesome-all.min.css" rel="stylesheet">

<link href="../resources/css/style.css"  rel="stylesheet">

<script type="text/javascript" src="../resources/js/jquery-3.3.1.min.js"></script>

<script type="text/javascript" src="../resources/bootstrap/js/bootstrap.min.js"></script>

 
<?php 
session_start();

?>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark">
    	<a class="navbar-brand" href="../admin/admin_dashboard.php">AdminArea</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars"
        aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
        </button> 
        <div class="collapse navbar-collapse"
        id="navbars">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link" href="../admin/admin_dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="../admin/user.php">Users</a>
                </li> 
                <li class="nav-item"> <a class="nav-link" href="../admin/team.php">Teams</a>
                </li> 
                <li class="nav-item"> <a class="nav-link" href="../admin/owner.php">Owners</a>
                </li>  
                <li class="nav-item"> <a class="nav-link" href="../admin/futsal_arena.php">Futsal Arenas</a>
                </li>      
            </ul>
            <ul class="navbar-nav ml-auto">
             	 <!-- <li class="nav-item"> <a class="nav-link" href="welcome.php">Visit Site</a></li> -->
              
                <li class="nav-item"> <a class="nav-link" href="#">Welcome, <?php echo $_SESSION['loggedUser_name']?></a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="../admin_actions/admin_logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    