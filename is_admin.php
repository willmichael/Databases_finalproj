<?php
    session_start();// Starting Session
    include 'connectvarsEECS.php';
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $user = $_SESSION['userName'];

    $logged = true;
    $user_exists = true;

    if(!isset($_SESSION['userName'])){
        mysqli_close($conn); 
        $logged = false;
    }

    //confirm user is logged in and check for admin
    if($logged) {
        $user_info = "select userID, userPerm from User where userName='$user'";
        $result = mysqli_query($conn, $user_info);
        $count = mysqli_num_rows( $result );

        if($count > 0) {
            $row = mysqli_fetch_row($result);
            $userID = $row[0];
            $userPerm = $row[1];
        } else {
            $user_exists = false;
        }
        mysqli_close($conn); 
    }

?>

