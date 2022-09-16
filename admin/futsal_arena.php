<?php
  require_once"../connections/db.php";
  include_once "header.php";

  $query=mysqli_query($con,"SELECT * FROM futsal");

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Admin Area| Users</title>
</head>

<body>
	<!-- Header -->
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-10">
					<h1>Futsal Arenas</h1>
				</div>
			</div>
		</div>
	</header>
	<!-- Breadcrumb -->
	<section id="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="../admin/admin_dashboard.php">Dashboard</a></li>
				<li class="active"><a href="../admin/futsal_arena.php">Futsal Arenas</a></li>
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
                     Futsal Arena Management  </a>
               

                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">

                       <a  class="list-group-item list-group-item-dark active main-color-bg" href="../admin/futsal_arena.php">Arena List</a>
                </div>
             </div>
            </div>
				</div>
				</div>


				<div class="col-lg-9">
					<div class="card">
						<div class="card-header main-color-bg">
							<h4 class="card-title">Futsal Arenas List</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">

	    <form method="POST" action="../admin_actions/search_futsal.php">
	   	<input class="form-control" name="fname" type="text" placeholder="filter futsal...."><br>
	          <button type="submit" name="submit"  class="btn btn-default">Submit</button>
		</form>
								</div>
							</div>

							<br>
							
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Futsal Name</th>								
											<th>Location</th>
											<th>Opening Time</th>
											<th>Closing Time</th>
											<th>Contact</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
											 <?php while($row=mysqli_fetch_assoc($query)) { ?>
											<tr>
												<td><?php echo $row['fname']?></td>
												<td><?php echo $row['location']?></td>
												<td><?php echo $row['opening_time']?></td>
												<td><?php echo $row['closing_time']?></td>
												<td><?php echo $row['contact']?></td>

                        						<td>
                          						<a
                          					class="btn btn-danger" href="../admin_actions/delete_arena.php?id=<?php echo $row['fid']?>">Delete</a></td>
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
