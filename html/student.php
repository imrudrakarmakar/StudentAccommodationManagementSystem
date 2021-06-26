<?php
    session_start();

    // Import Rooms array list
    $studentRooms = json_decode($_COOKIE['RoomsArrayList'], true);
    // CReate cookies for each student
    $sCookie = $_SESSION['userStudent'] . 'Pos';

    // Checked the login student
    $loggedUser = $_SESSION['userStudent'];

    if(isset($_COOKIE[$loggedUser])){
        if(!empty($_SESSION['userStudent'])){
            header("location:checkIn.php");
        }
    }
    // Check in request
    if($_POST['CheckIn']) {
        // Check for checkbox
        if (isset($_POST['CheckinC'])) {
            // Set cookies for checkin 
            $checkIn = $_POST["CheckinC"];
            setcookie($sCookie, $checkIn);
            // Updated with checked in 
            $checkedIn = $studentRooms[$checkIn];
            setcookie($_SESSION['userStudent'], json_encode($checkedIn));
            // Update room status
            $studentRooms[$checkIn][4] = "Occupied";
            // Update Room array list value
            setcookie('RoomsArrayList', json_encode($studentRooms));
            header("location:checkIn.php");
            exit;
        }
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
                    <th>ROOM STATUS</th>
                    <th>CHECK IN</th>
                </tr>
                <tr>
                    <?php
                        $n = 0;
                        for($i=0; $i<count($studentRooms); $i++) {
                            echo("<tr>");
                            if($studentRooms[$i][4] == "Available") {
                                $n += 1; 
                                for($j=0;$j<4;$j++) {
                                    echo("<td>" . $studentRooms[$i][$j] . "</td>");
                                }                                
                                echo("<td><form action='student.php' method='POST'><input type='checkbox' name='CheckinC' value=$i> Available</td>
                                <td><input type='submit' value='Check In' name='CheckIn'></td></form>");
                            }                            
                            echo("</tr>");
                        }
                    ?>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>