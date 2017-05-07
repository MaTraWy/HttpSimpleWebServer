<?php SESSION_start();
if(!isset($_SESSION['firstname']))
header("Location: http://localhost:80/sro/index.html");;
 ?>
<DOCTYPE html>
<html>
    
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <title>Faculty of science</title>
            <link rel="stylesheet" href="../css/main.css">
		</head>
        <body>
            <div id="head">
                <header>
                    <h1>Faculty of science</h1>
                </header>
                <nav>
						<ul class="main_menu">
						<li><a href="index.html">home</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="change.php">Change Password</a></li>
                        <li><a href="logout.php">logout</a></li>
						<li><a href="about.php">about</a></li>
						</ul>
                </nav>
            </div>
            <div id="container"><center>
			<p> welcome <?php echo $_SESSION['firstname']; ?> to our societey
			</div></center>
			</body>