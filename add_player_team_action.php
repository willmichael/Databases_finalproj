<?php
// change the value of $dbuser and $dbpass to your username and password
    include 'connectvarsEECS.php';

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

// Escape user inputs for security
    $player = mysqli_real_escape_string($conn, $_POST['player']);
    $team = mysqli_real_escape_string($conn, $_POST['team']);

    date_default_timezone_set('America/Los_Angeles');
    $date = date('Y-m-d', time());

    $error_missing = "You are missing the following fields: ";
    $error = 0;
   
    if(empty($player)){
        $error_missing = $error_missing . "player name, ";
        $error = 1;
    }
    if(empty($team)){
        $error_missing = $error_missing . "team name, ";
        $error = 1;
    }
    if($error == 0) {
        // attempt insert query
        $query_max = "SELECT playerID, teamID from Player, Team where teamName = '$team' and playerName = '$player'";
        $result = mysqli_query($conn, $query_max);
        $row = mysqli_fetch_row($result);


        $playerID = $row[0];
        $teamID = $row[1];
        
        $query = "INSERT INTO PlaysIn (playerID, teamID, start ) VALUES ($playerID, $teamID, '$date' )";
        if(mysqli_query($conn, $query)){
            header("Location: team_page.php?teamName=$team"); 
        } else{
            echo $query;
            echo mysqli_error($conn) . "\nERROR: Couldn't add to playsin ";
        }
    } else {
        echo "$error_missing";
    }

// close connection
mysqli_close($conn);
?>
