<?php
    session_start();
    $Rooms = json_decode($_COOKIE['RoomsArrayList'], true);

    if(isset($_POST['delete'])) {
        if (isset($_POST['deleteRoom'])) {
            $dRoom = $_POST["deleteRoom"];
            // Delete the room using unset method
            unset($Rooms[$dRoom]);
            // Update rooms
            $Rooms = array_values($Rooms);
            setcookie('RoomsArrayList', json_encode($Rooms));
            header("location:admin.php");
            exit;
        }
    } elseif(isset($_POST['update'])) {
        $updatedRoom = $Rooms[$_POST['updateRoom']];
        setcookie('UpdateRoomProp', $_POST['updateRoom']);
        setcookie('UpdateRooms', json_encode($updatedRoom));
        header("location:update.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div>
        <div class="navbar">
            <a href="room.php" id="nav_tag">INSERT ROOM</a>
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
                    <th>UPDATE</th> 
                    <th>DELETE</th> 
                </tr>
                <?php
                    for($i=0; $i<count($Rooms); $i++) {
                        echo("<tr>");
                        for($j=0; $j<count($Rooms[$i]); $j++) {
                            echo("<td>" . $Rooms[$i][$j] . "</td>");
                        }
                        echo("<td><form action='admin.php' method='POST'><input type='checkbox' name='updateRoom' value=$i><input type='submit' value='UPDATE' name='update'></form></td>");
                        echo("<td><form action='admin.php' method='POST'><input type='checkbox' name='deleteRoom' value=$i><input type='submit' value='DELETE' name='delete'></form></td></tr>");
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>