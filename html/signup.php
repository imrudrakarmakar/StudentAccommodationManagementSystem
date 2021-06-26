<?php
    session_start();
	$students = json_decode($_COOKIE['Users'], true);

    if($_POST['Submit']){
        // Get new username and password
		$newUser = $_POST['Username'];
		$newPassword = $_POST['Password'];
        // Insert value usig PHP Associative Arrays method
		$students += [ $newUser => $newPassword ];
		setcookie('Users', json_encode($students));
        // Redirect to login page
		header("location:login.php");
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div>
    <div class="signup_container">
        <h2>SIGN UP</h2>
        <div class="signup_inner">
            <div>
                <form action="signup.php" method="POST" name="studentForm">
                    <input type="text" placeholder="Enter your name" class="input_style" name="Username"><br>
                    <div>
                        <input type="password" placeholder="Your Password" id="newPassword" class="input_style" name="Password">
                    </div><br>
                    <input type="submit" name="Submit" class="rBtn" value="Sign up"><br>
                    <p style="text-align: center;">Already logged in? <a href="login.php" id="signup_tag">Login</a> </p>
                </form>
			</div>
        </div>
    </div>
</div>
</body>
</html>