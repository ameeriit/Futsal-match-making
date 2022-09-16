<?php
  require_once"../connections/db.php";
  include "header.php";
  $query_futsal=mysqli_query($con,"SELECT * FROM futsal"); 

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Admin Area| owners</title>
<script type="text/javascript">
    	 
</script>
</head>
<body>
<!-- Header -->
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-10">
					<h1>Futsal Owners</h1>
				</div>
			</div>
		</div>
	</header>
	<!-- Breadcrumb -->
	<section id="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="../admin/admin_dashboard.php">Dashboard</a></li>
				<li class="active"><a href="../admin/owner.php">Owners</a></li>
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
                     Futsal Owner Management  </a>
               

                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">
                       <a  class="list-group-item list-group-item-dark active main-color-bg" href="../admin/owner.php">Owner List</a>
                </div>
             </div>
            </div>

					</div>
				</div>
				<div class="col-lg-9">
					<div class="card">
						<div class="card-header main-color-bg">
							<h4 class="card-title">Owners List</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
	<form method="POST" action="../admin_actions/search_owner.php">
	   	<input class="form-control" name="name" type="text" placeholder="filter Owners...."><br>
	          <button type="submit" name="submit"  class="btn btn-default">Submit</button>
	</form>
								</div>
							</div>
							<br>
							<c:if test="${!empty owners}">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Name</th>
											<th>Contact</th>
											<th>Email</th>
											<th>Futsal Name</th>
											<th>Location</th>
											<th>Actions</th>
										</tr>
									</thead>

									<tbody>
										<?php 
										while($result_futsal=mysqli_fetch_assoc($query_futsal)){
											$uid=$result_futsal['uid'];
											$name=$result_futsal['fname'];
											$location=$result_futsal['location'];

											//query to retrive detail about futsal owner
											$query_detail=mysqli_query($con,"SELECT * from users where uid=$uid");
											while($row=mysqli_fetch_assoc($query_detail)) { ?>
											<tr>
												<td><?php echo $row['name']?></td>
												<td><?php echo $row['email']?></td>
												<td><?php echo $row['contact']?></td>

												<?php }?>

												<td><?php echo $name;?></td>
												<td><?php echo $location;?></td>
                        						<td>

                        							<a
                          					class="btn btn-danger" href="../admin_actions/delete_owner.php?id=<?php echo $row['uid']?>">Delete</a></td>
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