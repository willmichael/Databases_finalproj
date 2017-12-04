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
          <h1 class="display-3">Player Performance</h1>
        </div>
      </div>

      <?php
        include 'connectvarsEECS.php';

        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$conn) {
          die('Could not connect: ' . mysql_error());
        }

        $query = "SELECT DISTINCT Player.playerName, Participation.Roles, Participation.kills, Participation.deaths, Participation.assists FROM Player, Participation, PlaysIn, MatchRecord, Team WHERE Player.playerID = Participation.playerID AND MatchRecord.matchID = Participation.matchID AND PlaysIn.teamID = Team.teamID";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query to show fields from table failed");
        }
    // setup structure
        echo "<div class='container'>";

        $userID = $_SESSION['userID'];
	
	echo "<table id = 't01' border = '1'><tr>";
	
	echo "<td><b>Player Name</b></td>";
	echo "<td><b>Roles</b></td>";
	echo "<td><b>Kills</b></td>";
	echo "<td><b>Deaths</b></td>";
	echo "<td><b>Assists</b></td>";
	echo "</tr>\n";
        while($row = mysqli_fetch_row($result)) {
            	echo "<tr>";
        	foreach($row as $cell)
			echo "<td>$cell</td>";
		echo "</tr>\n";
	}
	echo "</table>";
        echo "</div> <!-- /container -->";
	
        mysqli_free_result($result);
        mysqli_close($conn);
    ?>

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
