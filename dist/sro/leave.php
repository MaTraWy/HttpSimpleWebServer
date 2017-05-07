<DOCTYPE html>
<html>
    
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <title>Faculty of science</title>
            <link rel="stylesheet" href="css/main.css">
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
			
			<p> leave us a message </p>
			<form method ="get" action"">
			<textarea rows="4" cols="50" name="send" id="2"> leave us a message 
			</textarea>
			<input type="submit" name="koko" value ="send">
			
			</div>
			</body>
			<?php /* wirtten by matrawy */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_infor";

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

$comment = mysqli_real_escape_string($conn,$_POST['send']);
$insert = "INSERT INTO comment (comm) values ('$comment')";
if (mysqli_multi_query($conn, $insert)) {
    echo "<script>alert('your comment has been recorded');</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?> 		
    
</html>
			