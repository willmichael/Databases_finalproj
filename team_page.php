<?php
include('is_admin.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>League Tracker</title>

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
            // change the value of $dbuser and $dbpass to your username and password
                include 'connectvarsEECS.php';

                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                if (!$conn) {
                    die('Could not connect: ' . mysql_error());
                }

            // get call to team page
                $team = mysqli_real_escape_string($conn, $_GET['teamName']);

            // Display team name up top
                echo "<h1 class='display-3'>$team</h1>";

                $query = "SELECT teamID, rating FROM Team WHERE teamName='$team'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows( $result );


                if ($count == 1) {
                // attempt validate password
                    $row = mysqli_fetch_row($result);
                    echo "<h1 class='display-6'>Rating: $row[1]</h1>";
                }
                else {
                    echo "Could not find matching Team Sorry";
                }

                $teamID = $row[0];

                echo "</div> </div> <div class='container'>";

                $players_query = "SELECT playerName, rating, specialty, Player.playerID FROM Player, PlaysIn WHERE teamID='$teamID' and Player.playerID = PlaysIn.playerID";
                $player_result = mysqli_query($conn, $players_query);
                $player_count = mysqli_num_rows( $player_result );

                if ($player_count>0) {
                    echo "<table id = 't05' border = '1'><tr>";
                    echo "<td><b>Player Name</b></td>";
                    echo "<td><b>Rating</b></td>";
                    echo "<td><b>Specialty</b></td>";
                    echo "</tr>\n";
                        while($player_row = mysqli_fetch_row($player_result)) {
                                echo "<tr>";
                                echo "<td>$player_row[0]</td>";
                                echo "<td>$player_row[1]</td>";
                                echo "<td>$player_row[2]</td>";
                                echo "<td><a class='btn btn-secondary' href='player_page.php?playerName=$player_row[0]' role='button'>&raquo;</a></td>";
                                if($userPerm == 1){
                                echo "<td><a class='btn btn-secondary' href='delete_entry.php?type=pi&id=$player_row[3]' role='button'>&times;</a></td>";
                                }
                                echo "</tr>";
                        }
                        echo "</table>";
                } else {
                    echo "No players on this team";
                }



            // close connection
            mysqli_close($conn);
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
