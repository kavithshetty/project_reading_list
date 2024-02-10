<!-- Backend PHP code Start here -->
<!-- Create.php page to insert data into MySql -->
<?php
    // Include config file
require_once "config.php";

    // Define variables and initialize with empty values
$name = $sitelink = $category = $comment = "";
$name_err = $sitelink_err = $category_err = $comment_err = "";

    // Processing form data when form is submitted
if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Validate name
    $input_name = trim($_POST['Name']);
    if(empty($input_name)){
        $name_err = "Please enter a name. ";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name. ";
    } else{
        $name = $input_name;
    }

        // Validate Sitelink
    $input_sitelink = trim($_POST["Sitelink"]);
    if(empty($input_sitelink)){
        $sitelink_err = "Please enter the link. ";
    } else{
        $sitelink = $input_sitelink;
    }

        // Validate category
    $input_category = trim($_POST["Category"]);
    if(empty($input_category)){
        $category_err = "Please select category. ";
    } else{
        $category = $input_category;
    }

        // Validate comment
    $input_comment = trim($_POST["Comment"]);
    if(empty($input_comment)){
        $comment_err = "Please enter comment. ";
    } else{
        $comment = $input_comment;
    }

        // Check input errors before inserting in database
    if(empty($name_err) && empty($sitelink_err) && empty($category_err) && empty($comment_err)){
            //Prepare an insert statement
        $sql = "INSERT INTO tbl_readinglist (fld_Name, fld_Link, fld_Category, fld_Comment) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
                    //Bind variable to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_Link, $param_category, $param_comment);

            // Set parameters
            $param_name = $name;
            $param_Link = $sitelink;
            $param_category = $category;
            $param_comment = $comment;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Record created successfully. Redirect to landing page
                header("location: index.php");
                exite();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);

}
?>
<!-- // Backend PHP code end here -->


<!DOCTYPE HTML>
<!--
    Editorial by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>MY Reading List</title>
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
                    <a href="index.php" class="logo"><strong>MY</strong> Reading List </a>
                    <ul class="icons">
                        <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
                        <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                        <li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
                    </ul>
                </header>


                <!-- Form -->
                
                <br>
                <h3>Create new List</h3>
                <br>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="row gtr-uniform">
                        <div class="col-6 col-12-xsmall">
                            <input type="text" name="Name" id="name" class="<?php echo(!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" placeholder="Novel/Manga/Manhwa/Manhua Name" /> 
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <input type="text" name="Sitelink" id="sitelink" class="<?php echo(!empty($sitelink_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sitelink; ?>" placeholder="Site Link" />
                            <span class="invalid-feedback"><?php echo $sitelink_err; ?></span>
                        </div>
                        <!-- Break -->
                        <div class="col-12">
                            <select name="Category" id="category" class="<?php echo(!empty($category_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo $category; ?>">
                                <option value="">- Category -</option>
                                <option value="Reading">Reading</option>
                                <option value="Completed">Completed</option>
                                <option value="Droped">Droped</option>
                                <option value="Plan to Read">Plan to Read</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $category_err; ?></span>
                        </div>
                        <!-- Break -->
                        <!-- <div class="col-4 col-12-small">
                            <input type="radio" id="demo-priority-low" name="demo-priority" checked>
                            <label for="demo-priority-low">Low</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <input type="radio" id="demo-priority-normal" name="demo-priority">
                            <label for="demo-priority-normal">Normal</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <input type="radio" id="demo-priority-high" name="demo-priority">
                            <label for="demo-priority-high">High</label>
                        </div> -->
                        <!-- Break -->
                        <!-- <div class="col-6 col-12-small">
                            <input type="checkbox" id="demo-copy" name="demo-copy">
                            <label for="demo-copy">Email me a copy</label>
                        </div>
                        <div class="col-6 col-12-small">
                            <input type="checkbox" id="demo-human" name="demo-human" checked>
                            <label for="demo-human">I am a human</label>
                        </div> -->
                        <!-- Break -->
                        <div class="col-12">
                            <textarea name="Comment" id="comment" class="<?php echo(!empty($comment_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $comment; ?>" placeholder="Comment" rows="6"></textarea>
                            <span class="invalid-feedback"><?php echo $comment_err;?></span>
                        </div>
                        <!-- Break -->
                        <div class="col-12">
                            <ul class="actions">
                                <li><input type="submit" name="Submit" id="Submit" value="Save List" class="primary" /></li>
                                <li><input type="reset" value="Reset" /></li>
                            </ul>
                        </div>
                    </div>
                </form>





                <!-- Content end -->
            </div>
        </div>
        <!-- Main End -->


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