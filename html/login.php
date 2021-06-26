<?php
    session_start();
    // Set a session cookies
    if(isset($_COOKIE['Users'])){
		$studentLogins = json_decode($_COOKIE["Users"], true);
	} else{
        // Set a demo student for login
		$demoStudent = array('student' => 'student123');
		setcookie('Users', json_encode($demoStudent));
	}
    // Check login for student and admin
    if(isset($_POST['Submit'])) {
        $studentLogins = json_decode($_COOKIE["Users"], true);
        // Get value for new signup students
        $studentName = isset($_POST['Username']) ? $_POST['Username'] : '';
        $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
        // Check for student logins
        if(isset($studentLogins[$studentName]) && $studentLogins[$studentName]==$Password ) {
			$_SESSION['userStudent'] = $_POST['Username'] . "student";
			header("location:student.php");
			exit;
		}
    } elseif(isset($_POST['adminSubmit'])) {
        // Default admin username and password
		$admin = "admin";
		$a_passWord = "admin123";
        // Check for the admin
		if ($_POST["adminUsername"] == $admin && $_POST["adminPassword"] == $a_passWord){
			$_SESSION['UserAdmin'] = $admin;
			header("Location:admin.php");
			exit();
		}
		else{
            echo('<script>alert("Incorrect Username or Password!")</script>');
		}
	}
	// Sign up checking
	if(isset($_POST['SignUp'])) {
		header("location:signup.php");
	}

?>

<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Accommodation Management System.</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div>
		<div class="container">
			<div class="student_login">
				<h2>Login for Student</h2>
				<div class="student_login_container">
					<form action="login.php" method="POST" name="studentForm">
						<input type="text" placeholder="Enter your name" class="input_style" name="Username"><br>
						<input type="password" placeholder="Your Password" class="input_style" name="Password"><br>
						<div class="std_log">
							<input type="submit" name="Submit" class="sBtn"><br>
							<input type="submit" name="SignUp" value="Sign Up" class="sBtn"><br>
						</div>
					</form>
				</div>
			</div>
			<div class="admin_login">
				<h2>Login for Admin</h2>
				<div class="admin_login_container">
					<form action="login.php" method="POST" name="adminForm">
						<input type="text" placeholder="Enter your username" class="input_style" name="adminUsername"><br>
						<input type="password" placeholder="Your Password" class="input_style" name="adminPassword"><br>
						<input type="submit" name="adminSubmit" class="aBtn">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>