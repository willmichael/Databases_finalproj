<?php
    session_start();
    include 'connectvarsEECS.php';
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }
    if(!isset($_SESSION['userName'])){
        mysqli_close($conn); 
        header('Location: login.php'); 
    }
    
    //some setup variables
    $genID = mysqli_real_escape_string($conn, $_GET['genID']);
    // true or false; player or team
    $isplayer = mysqli_real_escape_string($conn, $_GET['isplayer']);
    $userID = $_SESSION['userID'];


    // start following player
    
    if($isplayer == "true") {
        $query = "Delete from FollowingPlayer Where userID=$userID and playerID=$genID";
        $result = mysqli_query($conn, $query);

        if ($result == true) {
            header('Location: player.php'); 
        }
        else {
            echo "Could not un-follow player";
        }
    } else {
        $query = "delete from FollowingTeam Where userID='$userID' and teamID='$genID'";

        $result = mysqli_query($conn, $query);

        if ($result == true) {
            header('Location: team.php'); 
        }
        else {
            echo "Could not un-follow team";

        }

    }

// close connection
mysqli_close($conn);

?>

