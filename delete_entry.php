<?php
// change the value of $dbuser and $dbpass to your username and password
    include 'connectvarsEECS.php';

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

// Escape user inputs for security
    $type = mysqli_real_escape_string($conn, $_GET['type']);
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // create query
    if($type == 'p') {
        $delete_query = "Delete From Player where playerID=$id";
    } else if($type == 'pi') {
        $delete_query = "Delete From PlaysIn where playerID=$id";
    } else if($type == 'te') {
        $delete_query = "Delete From Team where teamID=$id";
    } else if($type == 'to') {
        $delete_query = "Delete From Tournament where tournamentID=$id";
    } else {
        $delete_query = "";
    }

    // attempt delete 
    if(mysqli_query($conn, $delete_query)){
        if($type == 'p') {
            header('Location: player.php'); 
        } else if($type == 'pi') {
            header('Location: team.php'); 
        } else if($type == 'te') {
            header('Location: team.php'); 
        } else if($type == 'to') {
            header('Location: tournament.php'); 
        } else {
            header('Location: index.php'); 
        }


    } else{
        echo $delete_query;
        echo mysqli_error($conn) . "\nERROR: Couldn't Delete";
    }

// close connection
mysqli_close($conn);
?>
