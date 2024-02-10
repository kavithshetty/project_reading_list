<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
	<title>MRL</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
	<!-- <script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();   
		});
	</script> -->
</head>
<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Main -->
		<div id="main">
			<div class="inner">

				<!-- Header -->
				<header id="header">
					<a href="index.php" class="logo"><strong>MY</strong> Reading List </a>
					<ul class="icons">
						<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
						<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
					</ul>
				</header>


				<!-- Content -->
				<br>
				<h1 class="center">Home</h1>
				<a class="button mr-3 small" href="create.php">Create
				</a>
				<a class="button mr-3 small" href="read.php">
				Read
				</a>
				<hr>
				<div class="table-wrapper">
				
					<?php
						// Include config file
					require_once "config.php";

						// Attempt selected query execution
					$sql = "SELECT * FROM tbl_readinglist";
					if ($result = mysqli_query($link, $sql)){
						if(mysqli_num_rows($result) > 0){
							echo '<table class="alt">';
							echo "<thead>";
							echo "<tr>";
							// echo '<td><a class="button primary mr-3" href="create.php">Create</a>
							// 	<a class="button primary mr-3" href="read.php">Read</a></td>';
							// echo '<th><a class="button primary" href="read.php">Read</a></th>';
							echo "</tr>";
							echo "<tr>";
							echo "<th>#</th>";
							echo "<th>Name</th>";
							echo "<th>Site Link</th>";
							echo "<th>Category</th>";
							echo "<th>Comment</th>";
							echo "<th>Action</th>";
							echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							while($row = mysqli_fetch_array($result)){
								echo "<tr>";
								echo "<td>" . $row['id'] . "</td>";
								echo "<td>" . $row['fld_Name'] . "</td>";
								// echo "<td>" . $row['fld_Link'] . "</td>";

								echo "<td>";
								echo "<a href=\"" . $row['fld_Link']. "\">" . $row['fld_Link'] . "</a>";
								echo "</td>";

								echo "<td>" . $row['fld_Category'] . "</td>";
								echo "<td>" . $row['fld_Comment'] . "</td>";
								echo "<td>";
								// echo '<a href="read.php" class="mr-3" title="View Record" data-toggle="tooltip">
								// <span class="fa fa-eye"></span></a>';
								// echo '<a href="update.php" class="mr-3" title="Update Record" data-toggle="tooltip">
								// <span class="fa fa-pen"></span></a>';
								// echo '<a href="delete.php" class="mr-3" title="Delete Record" data-toggle="tooltip">
								// <span class="fa fa-trash"></span></a>';
								echo '<a href="read.php" class="mr-3 button small" title="View Record" data-toggle="tooltip">
								<span class="fa fa-eye"></span></a>
								<a href="update.php" class="mr-3 button small" title="Update Record" data-toggle="tooltip">
								<span class="fa fa-pen"></span></a>
								<a href="delete.php" class="mr-3 button small" title="Delete Record" data-toggle="tooltip">
								<span class="fa fa-trash"></span></a>';
								echo "</td>";
								echo "</tr>";
							}
							echo "</tbody>";
							echo '</table>';
							//Free result set
							mysqli_free_result($result);
						} else{
							echo '<div class="alert alert-danger"><em>No record were found</em></div>';
						}
					} else{
						echo "Oops! Something went wrong. Please try again later.";
					}

					// Close connection
					mysqli_close($link);
					?>

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
								<li><a href="create.php">Create List</a></li>
								<li><a href="read.php">Read List</a></li>
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