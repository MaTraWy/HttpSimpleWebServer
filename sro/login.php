<?php SESSION_start(); ?>
<DOCTYPE html>
<html>
    
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <title>Faculty of science</title>
            <link rel="stylesheet" href="css/main.css">
            <script type="text/javascript">
			function username1()
                {
                    var User=document.getElementById("username");
                    if (User.value.length<5)
                    {
                        document.getElementById("1").innerHTML = "at least Five character";
                        User.focus();
                        User.select();
                        return false;
                    }
                    else
                    {
                        document.getElementById("1").innerHTML = "";
                        return true;
                    }
                    
                }
			function password1()
                {
                    var User=document.getElementById("password");
                    if (User.value.length<5)
                    {
                        document.getElementById("2").innerHTML = "at least Five character";
                        User.focus();
                        User.select();
                        return false;
                    }
                    else
                    {
                        document.getElementById("2").innerHTML = "";
                        return true;
                    }
                    
                }
			function done()
			{
				var x= username1();
				var y= password1();
				if(x&&y)
				{
					return true;
				}
				else
				{
					alert('there is error');
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
						<li><a href="login.php">login</a></li>
						<li><a href="about.html">About</a></li>
                    </ul>
                </nav>
            </div>
            <div id="container"><center>
			 <table>
                    <form action="" method="post" id="ok">
						<tr><td>User Name </td> <td><input    type="text"     id="username"         name="UserName"></td><td><p id="1" style="color:red"></td</tr>
						<tr><td>Password </td>  <td><input    type="password" id="password"         name="Password"></td><td><p id="2" style="color:red"></td</tr>
						<tr><td><input type="submit" name="koko" value="login"></td><td><input type="reset" value"reset"></td></tr>
					</form>

              </center>
            </div>
			<script type = "text/javascript">
						document.getElementById("ok").onsubmit = done;
                        document.getElementById("username").onchange = username1;
                        document.getElementById("password").onchange = password1;
                </script>
        </body>

<?php /* wirtten by matrawy */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "univ_shard";

if(isset($_POST['koko'])){
$conn = mysqli_connect($servername, $username, $password, $dbname);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* check if server is alive */
if (mysqli_ping($conn)) {
    printf ("Our connection is ok!\n");
} else {
    printf ("Error: %s\n", mysqli_error($link));
}

$user = mysqli_real_escape_string($conn,$_POST['UserName']);
$pass = mysqli_real_escape_string($conn,$_POST['Password']);
$sql = "SELECT * FROM student_infor WHERE username='$user' AND pass='$pass'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
if(mysqli_num_rows($result)!= 0){
	extract($row);
$_SESSION['username']=$user;
$_SESSION['firstname']=$firstname;
echo "<script>alert('Welcome')<script>";
header("location: user/user.php");

}

else {

echo "<script>alert('Email or password is not correct, try again!')</script>";
}
}
?> 		
    
</html>