<DOCTYPE html>
<html>
    
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <title>Faculty of science</title>
            <link rel="stylesheet" href="css/main.css">
			<script type="text/javascript"> //email//
			function email()
			{
				var email=document.getElementById("Temail");
				var pos=email.value.search(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/);
				if(pos!=0)
					{
                        document.getElementById("4").innerHTML = "xxxx@xxx.xxx";
                        return false;
                    }
                    else
                    {
                    document.getElementById("4").innerHTML = "";
                    return true;
                    }
				
			}
			</script>
            <script type="text/javascript"> //user name //
            function username()
                {
                    var User=document.getElementById("TUName");
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
            </script>
            <script type="text/javascript"> //first name //
            function name1()
                {
                    var Fname=document.getElementById("TFname");
                    var pos1 = Fname.value.search(/^[A-Z][a-z]+$/);
                    if (pos1 != 0)
                    {
                        document.getElementById("2").innerHTML = "Xxx.";
                        return false;
                    }
                    else
                    {
                    document.getElementById("2").innerHTML = "";
                    return true;
                    }
                }
            </script>
            <script type="text/javascript">// last name //
            function name2()
                {
                    var Lname=document.getElementById("TLname");
                    var pos1 = Lname.value.search(/^[A-Z][a-z]+$/);
                    if (pos1 != 0)
                    {
                        document.getElementById("3").innerHTML = "Xxx";
                        return false;
                    }
                    else
                    {
                    document.getElementById("3").innerHTML = "";
                    return true;
                    }
				}
            </script>
            <script type="text/javascript"> // password //
            function password1()
                {
                    var init=document.getElementById("intial");
                    var sec=document.getElementById("other");
                    
                    if (init.value == "")
                    {
		                  document.getElementById("5").innerHTML = "its blank";
		                  init.focus();
		                  return false;
	                }
	  
                    else if (init.value != sec.value) 
                    {
		                  document.getElementById("6").innerHTML = "not match";	
	  	                  init.focus();
		                  init.select();
		                  return false;
	               } 
                    else
					{
						document.getElementById("5").innerHTML = "";
						document.getElementById("6").innerHTML = "";
                        return true;
					}	
                }
            
            </script>
			<script type="text/javascript">
			function done1()
			{
				var x = username();
				var y = name1();
				var z = name2();
				var k = password1();
				var l = email();
				if (x&&y&&z&&k&&l)
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
                    <form action="" method="post" id="reg">
                        <tr><td>User Name </td> <td><input    type="text"          id="TUName"         name="UserName"></td><td><p id="1" style="color:red"></td</tr>
                        <tr><td>First Name</td> <td><input    type="text"          id="TFname"         name="FName">   </td><td><p id="2" style="color:red"></p></td></tr>
                        <tr><td>Last Name </td> <td><input    type="text"          id="TLname"         name="LName">   </td><td><p id="3" style="color:red"></p></td></tr>
                        <tr><td>Email     </td> <td><input    type="text"          id="Temail"         name="Email">   </td><td><p id="4" style="color:red"></p></td></tr>
                         <tr><td>password  </td><td><input    type="password"      id="intial"         name="Pass">    </td><td><p id="5" style="color:red"></p></td></tr>
                    <tr><td>Replay password</td><td><input    type="password"      id="other"          name="pas">     </td><td><p id="6" style="color:red"></p></td></tr>
                        <tr><td><input type="submit" name="koko" value="Register"></td><td><input type="reset" value"reset"></td></tr>
                </table>
                    </form>
                </div>
                <script type = "text/javascript">
						document.getElementById("reg").onsubmit = done1;
                        document.getElementById("TUName").onchange = username;
                        document.getElementById("TFname").onchange = name1;
                        document.getElementById("TLname").onchange = name2;
                        document.getElementById("other").onchange = password1;
						document.getElementById("Temail").onchange = email;
						
						
						
                </script>
 </body> 
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "univ_shard";

if(isset($_POST['koko'])){
$conn = mysqli_connect($servername, $username, $password, $dbname,3306);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* check if server is alive 
if (mysqli_ping($conn)) {
    printf ("Our connection is ok!\n");
} else {
    printf ("Error: %s\n", mysqli_error($link));
}
*/

$user = mysqli_real_escape_string($conn,$_POST['UserName']);
$pass = mysqli_real_escape_string($conn,$_POST['Pass']);
$FName = mysqli_real_escape_string($conn,$_POST['FName']);
$LName = mysqli_real_escape_string($conn,$_POST['LName']);
$Email = mysqli_real_escape_string($conn,$_POST['Email']);
$sql = "SELECT username FROM student_infor WHERE username='$user'";
$insert = "INSERT INTO student_infor (username, firstname, lastname, email, pass) VALUES ('$user','$FName','$LName','$Email','$pass')";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

if(mysqli_num_rows($result)!=0)
{
echo "<script>alert('user name already exsist');</script>";
}
else
{	
if (mysqli_multi_query($conn, $insert)) {
    echo "<script>alert('your account has been recorded');</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

}
?> 