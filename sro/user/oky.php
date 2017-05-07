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
            <script type ="text/javascript">
                function oldpass()
                {
                    var oldpasss=document.getElementById("old1");
                    if(oldpasss.value == "")
                    {
                        document.getElementById(1).innerHTML="its blank !!";
                        return false;
                    }
                    else
                    {
                        document.getElementById(1).innerHTML="";
                        return true;
                        
                    }   
                   
                }
				function newpass()
				{
					var init = document.getElementById("new1");
					var sec = document.getElementById("new2");
					if (init.value == "")
                    {
		                  document.getElementById("2").innerHTML = "its blank";
		                  init.focus();
		                  return false;
	                }
	  
                    else if (init.value != sec.value) 
                    {
		                  document.getElementById("3").innerHTML = "not match";	
	  	                  init.focus();
		                  init.select();
		                  return false;
	               } 
                    else
					{
						document.getElementById("2").innerHTML = "";
						document.getElementById("3").innerHTML = "";
                        return true;
					}	
					
				}
				function done()
				{
					var x =oldpass();
					var y =newpass();
					if(x&&y)
					{
						return true;
					}
					else
					{
						alert ('alert error');
						return false;
					}
				}

            </script>
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
                      <p> Welcome <?php echo $_SESSION['firstname']; ?> if u want to change your password </p>
                        <TABLE>
			<form action="" method="post" id="ok" colspan="2">
                     <p><tr><td> Old password</td><td>	<input type="password" name="old" id="old1"></td><td> <p id="1" style="color:red;"></p></td></tr></p>
                     <p> <tr><td>New password</td><td>	<input type="password" name="new" id="new1"</td><td><p id="2" style="color:red;"></p></td></tr></p>
                     <p><tr><td>Replay new password</td><td>	<input type="password" id="new2"></td><td> <p id="3" style="color:red;"></p></td></tr></p>
                     <p><tr><td colspan="2"><input type="submit" name ="koko"></td></tr></p>
			</form>
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

if(isset($_POST['koko']))
    {
	$conn= mysqli_connect($servername,$username,$password,$dbname);
	$oldpass = mysqli_real_escape_string($conn,$_POST['old']);
	$newpass = mysqli_real_escape_string($conn,$_POST['new']);
    $lol = $_SESSION['username'];
	$check = "SELECT * from student_infor WHERE username = '$lol' AND pass = '$oldpass'";
	$insert = "UPDATE student_infor set pass ='$newpass' where username ='$lol'";
	$result = mysqli_query($conn,$check);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	if(mysqli_num_rows($result)!= 0)
	{
		if(mysqli_multi_query($conn,$insert))
                {
			echo "<script> alert('done')</script>";
	
                }
        }
	else
        {
		echo "<script> alert('the old password Wrong')</script>";
        }
}
?>	