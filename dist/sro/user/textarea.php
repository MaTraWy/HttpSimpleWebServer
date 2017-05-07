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
						<li><a href="change.php">comment</a></li>
                    </ul>
                </nav>
            </div>
            <div id="container">
			<p> Hi <?php echo $_SESSION['firstname']; ?> lets change the content</p>
			<p style="color:red;font-size:50px;font-weigh:bold;"><?php koko(); ?></p> 
			<p> to edit it </p>
			<form method ="POST" action="">
			<textarea name="ali"> Change </textarea><br/>
			<input type="submit" name="koko" value="submit"/>
			<input type="reset" value="clear"/>
			</form>
			</div>
			</body>
			<?php
			function koko()
			{
				include 'conn.php';
				$conn= mysqli_connect($servername,$username,$password,$dbname);
				$l=1;
				$insert = "SELECT * FROM comment where id = '$l'";
				$output = mysqli_query($conn,$insert);
				$screen= mysqli_fetch_array($output,MYSQLI_ASSOC);
				extract($screen);
				echo "$comm";
			}
				include 'conn.php';
				if(isset($_POST['koko']))
				{
				$conn= mysqli_connect($servername,$username,$password,$dbname);
				$l=1;
				$new=$_POST['ali'];
				$insert = "update comment set comm='$new' where id ='$l'";
				$output = mysqli_query($conn,$insert);
				if($output)
				{
					echo "<script>alert('done');</script>";
							header("location: textarea.php");
				}
				}			
				?>
                      