<?php
// change the value of $dbuser and $dbpass to your username and password
    include 'connectvarsEECS.php';

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

// Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $_POST['tournamentname']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

// check unique player

    $error_missing = "You are missing the following fields: ";
    $error = 0;
   
    if(empty($name)){
        $error_missing = $error_missing . "name, ";
        $error = 1;
    }
    if(empty($date)){
        $error_missing = $error_missing . "date, ";
        $error = 1;
    }
    if(empty($location)){
        $error_missing = $error_missing . "location, ";
        $error = 1;
    }
    if($error == 0) {
        // attempt insert query
        $query_max = "SELECT MAX(tournamentID) from Tournament";
        $result = mysqli_query($conn, $query_max);
        $row = mysqli_fetch_row($result);

        $tournID = $row[0] + 1;
        
        $query = "INSERT INTO Tournament (tournamentID, name, date, location) VALUES ($tournID, '$name', '$date', '$location')";
        if(mysqli_query($conn, $query)){
            header('Location: tournament.php'); 
        } else{
            echo $query;
            echo mysqli_error($conn) . "\nERROR: Couldn't add Tournament ";
        }
    } else {
        echo "$error_missing";
    }

// close connection
mysqli_close($conn);
?>
