<?php
    session_start();

    // Get update request from admin page
    $updateRoom = json_decode($_COOKIE["UpdateRooms"], true);
    $Rooms = json_decode($_COOKIE["RoomsArrayList"], true);
    // Update index value of requested room
    $uID = $updateRoom[0];
    $uType = $updateRoom[1];
    $uLoc = $updateRoom[2];
    $uChrg = $updateRoom[3];
    $uStat = $updateRoom[4];

    if($_POST['Submit']) {
        // Get new values
        $nID = $_POST['newID'];
        $nType = $_POST['newType'];
        $nLoc = $_POST['newLocation'];
        $nChrg = $_POST['newCharge'];
        $nStatus = $_POST['newStatus'];
        if($nID <= 0) {
            echo("Wrong input!");
            header("location:update.php");
        }
        // Update the room in a new Array
        $updatedRoom = array($nID, $nType, $nLoc, $nChrg, $nStatus);
        // Update room properties of selected room
        // Overwrite the cookies data on Rooms variable
        $Rooms[$_COOKIE['UpdateRoomProp']] = $updatedRoom;
        // Encode new cookies data
        setcookie('RoomsArrayList', json_encode($Rooms));
        header("location:admin.php");
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a room</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="room_container">
        <h2>UPDATE ROOM</h2>
        <div class="create_room">
            <?php
            echo("<form action='update.php' method='POST'>
                <input type='number' placeholder='Room ID' name='newID' class='input_style' value=$uID required></input><br>
                <input type='text' placeholder='Room Type' name='newType' class='input_style' value=$uType required><br>
                <input type='text' placeholder='Room Location' name='newLocation' class='input_style' value=$uLoc  required><br>
                <input type='text' placeholder='Room Charge' name='newCharge' class='input_style' value=$uChrg required><br>
                <label for='newStatus'>Choose current status of room:</label>
                <select name='newStatus'>
                    <option value='Available'>Available</option>
                    <option value='Occupied'>Occupied</option>
                </select>
                <input type='submit' class='rBtn' name='Submit' value='Update Room'>
            </form>");
            ?>
        </div>
    </div>
</body>
</html>