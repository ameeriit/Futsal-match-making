<?php
  require_once "../connections/db.php";
 include_once "../admin/header.php";

  if(isset($_POST["submit"])){
	$teamname=$_POST["team_name"];
	$query=mysqli_query($con,"SELECT * from teams where team_name = '$teamname'");	
}

  
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Admin Area| Teams</title>
</head>
<body>
<!-- Header -->
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-10">
					<h1>Teams</h1>
				</div>
			</div>
		</div>
	</header>
	<!-- Breadcrumb -->
	<section id="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="../admin/admin_dashboard.php">Dashboard</a></li>
				<li class="active"><a href="../admin/team.php">Teams</a></li>
			</ol>
		</div>
	</section>

	<section id="main">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
				
					<div class="list-group">
						<a href="../admin/admin_dashboard.php" class="list-group-item list-group-item-action">
							Dashboard</a> 
	<!-- Dropdown-->
            <div class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" class="list-group-item list-group-item-action" href="#dropdown-lvl1">
                     Team Management  </a>
               

                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">                     
                       <a  class="list-group-item list-group-item-dark active main-color-bg" href="../admin/team.php">Team List</a>
                </div>
             </div>
            </div>

					</div>
				</div>
				<div class="col-lg-9">
					<div class="card">
						<div class="card-header main-color-bg">
							<h4 class="card-title">Team Found</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<input class="form-control" type="text"
										placeholder="filter Teams....">
								</div>
							</div>
							<br>
							
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Team Name</th>
											<th>Owner Name</th>
											<th>Venue</th>
											 <th>Preferred Time</th>									
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
											 <?php while($row=mysqli_fetch_assoc($query)) { ?>
											<tr>
												<td><?php echo $row['team_name'];?></td>
												<td><?php echo $row['owner_name'];?></td>
												<td><?php echo $row['venue'];?></td>
												<td><?php echo $row['start_time'];?>-<?php echo $row['end_time']?></td>
                        						<td>
                          						<a
                          					class="btn btn-danger" href="../admin_actions/delete_team.php?id=<?php echo $row['tid']?>">Delete</a></td>
											</tr>
                   						 <?php } ?>
									</tbody>
								</table>
							
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