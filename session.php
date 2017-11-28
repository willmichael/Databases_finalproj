<?php
    session_start();// Starting Session
    include 'connectvarsEECS.php';
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // Selecting Database
    // Storing Session
    $user = $_SESSION['userName'];
    // SQL Query To Fetch Complete Information Of User
    $user_info = "select userID from User where userName='$user'";
    $result = mysqli_query($conn, $user_info);
    $row = mysqli_fetch_row($result);

    $userID = $row[0];

    // not logged in redirect
    if(!isset($_SESSION['userName'])){
        mysqli_close($conn); 
        header('Location: login.php'); 
    }
?>

