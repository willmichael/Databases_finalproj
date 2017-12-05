<?php
    session_start();
    include 'connectvarsEECS.php';

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>League Tracker Search</title>

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
          <h1 class="display-3">Search Result</h1>
            <?php

            // Escape user inputs for security
                $search_string = mysqli_real_escape_string($conn, $_POST['search']);
            // check unique username
                $team_query = "SELECT teamName, rating FROM Team WHERE teamName='$search_string'";
                $team_result = mysqli_query($conn, $team_query);
                $team_count = mysqli_num_rows( $team_result );


               if($team_count > 0) {
                    echo "<table id = 't04' border = '1'><tr>";
                    echo "<td><b>Team Name</b></td>";
                    echo "<td><b>Rating</b></td>";
                    echo "</tr>\n";
                    while($row = mysqli_fetch_row($team_result)) {
                        echo "<tr>";
                        echo "<td>$row[0]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td><a class='btn btn-secondary' href='team_page.php?teamName=$row[0]' role='button'>&raquo;</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
               } else {
                        echo "<p>";
                            echo "Could not find any teams matching this search";
                        echo "</p>";
               }

                $player_query = "SELECT playerName, rating, specialty FROM Player WHERE playerName='$search_string'";
                $player_result = mysqli_query($conn, $player_query);
                $player_count = mysqli_num_rows( $player_result );

               if($player_count > 0) {
                    echo "<table id = 't05' border = '1'><tr>";
                    echo "<td><b>Player Name</b></td>";
                    echo "<td><b>Rating</b></td>";
                    echo "<td><b>Specialty</b></td>";
                    echo "</tr>\n";
                    while($row = mysqli_fetch_row($player_result)) {
                            echo "<tr>";
                            echo "<td>$row[0]</td>";
                            echo "<td>$row[1]</td>";
                            echo "<td>$row[2]</td>";
                            echo "<td><a class='btn btn-secondary' href='player_page.php?playerName=$row[0]' role='button'>&raquo;</a></td>";
                            echo "</tr>";
                    }
                    echo "</table>";
               } else {
                        echo "<p>";
                            echo "Could not find any players matching this search";
                        echo "</p>";
               }

                $tourn_query = "SELECT name, date, location FROM Tournament WHERE name='$search_string'";
                $tourn_result = mysqli_query($conn, $tourn_query);
                $tourn_count = mysqli_num_rows( $tourn_result );

                if($tourn_count > 0) {
                    echo "<table id = 't03' border = '1'><tr>";
                    echo "<td><b>Tournament Name </b></td>";
                    echo "<td><b>Date</b></td>";
                    echo "<td><b>Location</b></td>";
                    echo "</tr>\n";
                    while($row = mysqli_fetch_row($tourn_result)) {
                            echo "<tr>";
                            echo "<td>$row[0]</td>";
                            echo "<td>$row[1]</td>";
                            echo "<td>$row[2]</td>";
                            echo "<td><a class='btn btn-secondary' href='MatchList.php?TournamentName=$row[0]' role='button'>&raquo;</a></td>";
                            echo "</tr>";
                    }
                    echo "</table>";
                } else {
                        echo "<p>";
                            echo "Could not find any Tournaments matching this search";
                        echo "</p>";
               }
            ?>
        </div>
      </div>

    </main>

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
