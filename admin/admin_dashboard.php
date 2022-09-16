<?php
  require_once "../connections/db.php";
  require_once "header.php";

  $query=mysqli_query($con,"SELECT * FROM users ORDER BY uid");

  $query1 = mysqli_query($con,"SELECT COUNT(*) FROM users");
  $result1 = mysqli_fetch_array($query1);

  $query2=mysqli_query($con,"SELECT count(type) from users where type='futsal'");
  $result2= mysqli_fetch_array($query2);

  $query3=mysqli_query($con,"SELECT COUNT(*) FROM futsal");
  $result3= mysqli_fetch_array($query3);

?>
<!Doctype html>
<html lang="en">
  <head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Area| Dashboard</title>    

  </head>

<body>

<!-- Header -->
     <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                     <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Breadcrumb -->
    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </section>
    
    <section id="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="list-group">
                 <a href="admin_dashboard.php" class="list-group-item list-group-item-action active main-color-bg">
					 Dashboard</a>
					
	 <!-- Dropdown User-->
            <div class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" class="list-group-item list-group-item-action" href="#dropdown-user">
                     Users Management  </a>
               

                <!-- Dropdown level 1 -->
                <div id="dropdown-user" class="panel-collapse collapse">
                    <div class="panel-body">
                       <a  class="list-group-item list-group-item-dark" href="user.php">Users List</a>
                </div>
             </div>
            </div>
            
          <!-- Dropdown Owner-->
          <div class="panel panel-default" id="dropdown">
              <a data-toggle="collapse" class="list-group-item list-group-item-action" href="#dropdown-owner">
                   Futsal Owner Management  </a>
             

              <!-- Dropdown level 1 -->
              <div id="dropdown-owner" class="panel-collapse collapse">
                  <div class="panel-body">
                     <a  class="list-group-item list-group-item-dark" href="owner.php">Owner List</a>
              </div>
           </div>
            
       <!-- Dropdown Team-->
            <div class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" class="list-group-item list-group-item-action" href="#dropdown-team">
                     Teams Management  </a>
               

                <!-- Dropdown level 1 -->
                <div id="dropdown-team" class="panel-collapse collapse">
                    <div class="panel-body">             
                       <a  class="list-group-item list-group-item-dark" href="team.php">Team List</a>
                </div>
             </div>
            </div>

               <!-- Dropdown Team-->
            <div class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" class="list-group-item list-group-item-action" href="#dropdown-arena">
                     Futsal Arena Management  </a>
               

                <!-- Dropdown level 1 -->
                <div id="dropdown-arena" class="panel-collapse collapse">
                    <div class="panel-body">             
                       <a  class="list-group-item list-group-item-dark" href="futsal_arena.php">Arena List</a>
                </div>
             </div>
            </div>
            
         
            </div>
					
          </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header main-color-bg">
                         <h4 class="card-title">Website Overview</h4>
                    </div>
                    <div class="card-body">
                     <div class="row">
                        <div class="col-lg-4">
                            <div class="card bg-light card-body mb-3">
							     <h3><i class="fas fa-users"></i> <?php echo $result1[0]; ?></h3>
							     <h4>Users</h4>
							</div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card bg-light card-body mb-3">
                                 <h3><i class="fas fa-user"></i> <?php echo $result2[0]; ?></h3>
                                 <h4>Owners</h4>
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="card bg-light card-body mb-3">
                                 <h3><i class="far fa-futbol"></i> <?php echo $result3[0]; ?></h3>
                                 <h4>Futsal Venues</h4>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
          
            <!--  Latest Users -->
            
            <div class="card">
			    <div class="card-header">
			         <h4 class="card-title">Latest Users</h4>
			    </div>
			    <div class="card-body">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>User Name</th>											
											<th>email</th>
											<th>Contact No</th>								
										</tr>
									</thead>
								
									<tbody>
                    <?php while($row=mysqli_fetch_assoc($query)) { ?>
											<tr>
												<td><?php echo $row['name']?></td>
												<td><?php echo $row['email']?></td>
												<td><?php echo $row['contact']?></td>
                    <?php } ?>
									</tbody>

					
									
						</table>-
				</div>
			</div>
		  </div>	
        </div>
    </div>
</section>

<!-- Footer -->
<footer id="footer">
	<p>Copyright Futsal Match Maker &copy; 2018</p>
</footer>
</body>
</html>
