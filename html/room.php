<?php 

    session_start();    
    $tempRooms = array();

    if(isset($_POST['Submit'])) {
        // Get the values from user
        $rID = $_POST["rID"];
        $rType = $_POST["rType"];
        $rLoc = $_POST["rLocation"];
        $rChrg = $_POST["rCharge"];
        $rStat = $_POST["rStatus"];
        // Check if ID is positive or not
        if($rID <= 0) {
            echo("Wrong input!");
        }
        // Create a  new Room array
        $newRoom = array($rID, $rType, $rLoc, $rChrg, $rStat);

        if(isset($_COOKIE['RoomsArrayList'])){
            $OldRooms = json_decode($_COOKIE["RoomsArrayList"], true);
            // Pushing the value of new array into old array and update it
            array_push($OldRooms, $newRoom);
            setcookie('RoomsArrayList', json_encode($OldRooms));
        } else{
            array_push($tempRooms, $newRoom);
            setcookie('RoomsArrayList', json_encode($tempRooms));
        }

        header("location:admin.php");

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create room</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="room_container">
        <h2>CREATE ROOM</h2>
        <div class="create_room">
            <form action="room.php" method="POST">
                <input type="number" placeholder="*Room ID" name="rID" class="input_style" required><br>
                <input type="text" placeholder="*Room Type" name="rType" class="input_style" required><br>
                <input type="text" placeholder="*Room Location" name="rLocation" class="input_style" required><br>
                <input type="text" placeholder="*Room Charge" name="rCharge" class="input_style" required><br>
                <input type="hidden" value="Available" name="rStatus" class="input_style">
                <input type="submit" class="rBtn" name="Submit" value="Create Room">
            </form>
        </div>
    </div>
</body>
</html>