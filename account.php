<?php
include('session.php');
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
            echo "<h1 class='display-3'>Welcome $user!</h1>";
          ?>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>Following Players</h2>
               <?php
                   $player_query = "select playerName, rating, specialty, startFollow from Player, FollowingPlayer where userID='$userID' and FollowingPlayer.playerID = Player.playerID";
                   $result = mysqli_query($conn, $player_query);
                   $count = mysqli_num_rows( $result );

                   if($count > 0) {
                        echo "<table id = 't05' border = '1'><tr>";
                        echo "<td><b>Player Name</b></td>";
                        echo "<td><b>Rating</b></td>";
                        echo "<td><b>Specialty</b></td>";
                        echo "</tr>\n";
                        while($row = mysqli_fetch_row($result)) {
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
                                echo "Not following anyone, start following below!";
                            echo "</p>";
                   }
                ?>
            </br>
            <p><a class="btn btn-secondary" href="player.php" role="button">View More Players &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Following Teams</h2>
               <?php
                   $team_query = "select teamName, rating, startFollow from Team, FollowingTeam where userID='$userID' and FollowingTeam.teamID = Team.teamID";
                   $team_result = mysqli_query($conn, $team_query);
                   $count = mysqli_num_rows( $team_result );

                   if($count > 0) {
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
                                echo "Not following any Teams, start following below!";
                            echo "</p>";
                   }

                ?>
            </br>
            <p><a class="btn btn-secondary" href="team.php" role="button">View More Teams &raquo;</a></p>
          </div>
        </div>

        <hr>

      </div> <!-- /container -->

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
