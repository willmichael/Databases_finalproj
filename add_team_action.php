<?php
// change the value of $dbuser and $dbpass to your username and password
    include 'connectvarsEECS.php';

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

// Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $_POST['teamname']);

// check unique player
    $error_missing = "You are missing the following fields: ";
    $error = 0;
   
    if(empty($name)){
        $error_missing = $error_missing . "name, ";
        $error = 1;
    }
    if($error == 0) {
        // attempt insert query
        $query_max = "SELECT MAX(playerID) from Player";
        $result = mysqli_query($conn, $query_max);
        $row = mysqli_fetch_row($result);

        $playerID = $row[0] + 1;
        
        $query = "INSERT INTO Team (teamID, teamName, rating) VALUES ($playerID, '$name', 0)";
        if(mysqli_query($conn, $query)){
            header('Location: team.php'); 
        } else{
            echo $query;
            echo mysqli_error($conn) . "\nERROR: Couldn't add Player ";
        }
    } else {
        echo "$error_missing";
    }

// close connection
mysqli_close($conn);
?>
