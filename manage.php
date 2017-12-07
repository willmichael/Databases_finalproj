<?php
    session_start();// Starting Session
    include 'connectvarsEECS.php';
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $user = $_SESSION['userName'];
    $logged = true;
    $user_exists = true;

    // not logged
    if(!isset($_SESSION['userName'])){
        mysqli_close($conn); 
        $logged = false;
    }

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

    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>League Tracker Manager</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <!--MARK NAVIGATION-->

     <?php include("./nav.html");?>

    <!--MARK CONTENT-->

    <main role="main">
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
            <?php
                if($logged && $user_exists) {
                    if($userPerm == 1) {
                        echo "<h1 class='display-4'>Manage</h1>";
                        //echo "<p><a class='btn btn-primary btn-lg' href='add_player.php' role='button'>Add Player &raquo;</a></p>";
                        //echo "<p><a class='btn btn-primary btn-lg' href='add_team.php' role='button'>Add Team &raquo;</a></p>";
                        //echo "<p><a class='btn btn-primary btn-lg' href='add_tourn.php' role='button'>Add Tournament &raquo;</a></p>";
                    } else {
                        //insufficient permissions
                        echo "<h1 class='display-4'>Insufficient Permissions, this is only available to admins</h1>";
                    }
                } else {
                    //user dne
                    //not logged 
                    echo "<h1 class='display-4'>Please login to manage teams and players</h1>";
                }
            ?>
        </div>
      </div>


      <div class="container">
            <?php
                if($userPerm == 1) {
                    echo "<p><a class='btn btn-primary btn-lg' href='add_player.php' role='button'>Add Player &raquo;</a></p>";
                    echo "<p><a class='btn btn-primary btn-lg' href='add_player_team.php' role='button'>Add Player to Team &raquo;</a></p>";
                    echo "<p><a class='btn btn-primary btn-lg' href='add_team.php' role='button'>Add Team &raquo;</a></p>";
                    echo "<p><a class='btn btn-primary btn-lg' href='add_tourn.php' role='button'>Add Tournament &raquo;</a></p>";
                }
            ?>
      </div>
    </main>


    <br>
    <br>
    <br>
    <br>


    <footer class="container">
      <p>&copy; Michael Lee, Davian Lukman 2017</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!--<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="./assets/popper.min.js"></script>
    <script src="./assets/bootstrap.min.js"></script>
  </body>
</html>
