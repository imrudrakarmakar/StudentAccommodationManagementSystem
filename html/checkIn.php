<?php
    session_start();

    $sCookie = $_SESSION['userStudent'] . 'Pos';
    $checkedIn = json_decode($_COOKIE[$_SESSION['userStudent']], true);
    // Fetch updated room  array list
    $studentRooms = json_decode($_COOKIE['RoomsArrayList'], true);
    $arrayProp = $_COOKIE[$sCookie];
    // Handle checkout 
    if($_POST['checkOut']) {
        // Update room availability
        setcookie($_SESSION['userStudent'], "");
        $studentRooms[$arrayProp][4] = "Available";
        // Update room array list
        setcookie('RoomsArrayList', json_encode($studentRooms));
        // Redirect to student page for new rooms checkin
        header("location:student.php");
        exit;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div>
        <div class="navbar">
            <a href="logout.php" id="nav_tag">LOG OUT</a>
        </div>
        <div class="table_container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>TYPE</th>
                    <th>LOCATION</th>
                    <th>CHARGE</th>
                    <th>CHECK OUT</th>
                </tr>
                <tr>
                    <?php
                        // Iterate array upto room charge
                        for($i=0;$i<4;$i++) {
                            echo("<td>" . $checkedIn[$i] . "</td>");
                        }
                        echo("<td><form action='checkIn.php' method='POST'><input type='submit' value='CHECK OUT' name='checkOut'></form></td>");
                    ?>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>