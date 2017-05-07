 <DOCTYPE html>
<html>
    
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <title>Faculty of science</title>
            <link rel="stylesheet" href="../css/main.css"
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
            <div id="container">
			<center>
                      <p> Welcome  if u want to change your password </p>
                        <TABLE>
			</center>
			</div>
			<script type="text/javascript">
					 document.getElementById("old1").onchange = oldpass;
					 document.getElementById("new2").onchange = newpass;
					 document.getElementById("ok").onsubmit = done;
					 </script>
			</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "univ_shard";

	$conn= mysqli_connect($servername,$username,$password,$dbname);
	$check = "SELECT * from student_infor";
	$result = mysqli_query($conn,$check);
	if(mysqli_num_rows($result)!= 0)
	{
		while($final=mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
		extract($final);
		echo "$username <br/>";
		}
        }
	else
        {
		echo "<script> alert('the old password Wrong')</script>";
        }
?>	