<!-- Backend PHP Code Start Here -->
<!-- read.php page - to view stored data on MySql -->
<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
// if(isset($_GET['id'])){
	// Include config file
	require_once "config.php";

	// Prepare a select statement
	$sql = "SELECT * FROM tbl_readinglist WHERE id = ?";

	if ($stmt = mysqli_prepare($link, $sql)){
		// Bind variable to prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "i", $param_id);

		// Set parameters
		$param_id = trim($_GET["id"]);
		// $id = '';
		// $param_id = $id;

		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			$result = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($result) == 1){
				/* Fetch result row as an associative array. Since the result set contains only one row, we dont need to use while loop */
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			// Retrieve individual field value
				$name = $row["fld_Name"];
				$sitelink = $row["fld_Link"];
				$category = $row["fld_Category"];
				$comment  = $row["fld_Comment"];
			} else{
				// URL doesn't contain vaild id parameter. Redirect to error page
				header("location: error.html");
				exit();
			}
		} else{
			echo "Oops! Something went wrong.Please try again later.";
		}
	}

	//Close statement
	mysqli_stmt_close($stmt);

	//Close connection
	mysqli_close($link);
} else{
	//URL doesn't contain id parameter. Redirect to error page 
	header("location: index.php");
	exit();
}
?>
<!-- Backend PHP Code End Here -->
<!DOCTYPE HTML>
<html>
<head>
	<title>Reading List</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Main -->
		<div id="main">
			<div class="inner">

				<!-- Header -->
				<header id="header">
					<a href="index.php" class="logo"><strong>Create</strong> new list </a>
					<ul class="icons">
						<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
						<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
					</ul>
				</header>

			</br>
			<h4>READING LIST</h4>
			<div class="table-wrapper">
				<table class="alt">
					<thead>
						<tr>
							<th><a class="button primary large" href="index.php" title="">Back</a></th>
						</tr>
						<tr>
							<th>Name</th>
							<th>Link</th>
							<th>Category</th>
							<th>Comment</th>
						</tr>
					</thead>
					<tr>
						<!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
						<td><?php echo $row["fld_Name"];?></td>
						<td><?php echo $row['fld_Link'];?></td>
						<td><?php echo $row['fld_Category'];?></td>
						<td><?php echo $row['fld_Comment'];?></td>
					</tr>
				</table>
			</div>

		</div>
	</div>

	<!-- Sidebar -->
	<div id="sidebar">
		<div class="inner">

			<!-- Search -->
			<section id="search" class="alt">
				<form method="post" action="#">
					<input type="text" name="query" id="query" placeholder="Search" />
				</form>
			</section>

			<!-- Menu -->
			<nav id="menu">
				<header class="major">
					<h2>Menu</h2>
				</header>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="generic.html">Generic</a></li>
					<li><a href="elements.html">Elements</a></li>
					<li>
						<span class="opener">Edit Reading List</span>
						<ul>
							<li><a href="create.html">Create List</a></li>
							<li><a href="read.html">Read List</a></li>
							<li><a href="update.html">Update List</a></li>
							<li><a href="delete.html">Delete List</a></li>
						</ul>
					</li>
				</ul>
			</nav>

			<!-- Footer -->
		<!-- <footer id="footer">
			<p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
		</footer> -->

	</div>
</div>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>