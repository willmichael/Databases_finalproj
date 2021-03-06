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
          <h1 class="display-3">Tournament</h1>
        </div>
      </div>

      <?php
        include 'connectvarsEECS.php';

        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$conn) {
          die('Could not connect: ' . mysql_error());
        }

        $query = "SELECT tournamentID, name, date, Location FROM Tournament";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query to show fields from table failed");
        }
    // setup structure
        echo "<div class='container'>";

        $userID = $_SESSION['userID'];
	echo "<table id = 't03' border = '1'><tr>";
	echo "<td><b>ID</b></td>";
	echo "<td><b>Tournament Name </b></td>";
	echo "<td><b>Date</b></td>";
	echo "<td><b>Location</b></td>";
	echo "</tr>\n";

        while($row = mysqli_fetch_row($result)) {
            echo "<div class='row'>";
	    
	    echo "<tr>";
	    foreach($row as $cell)
		echo "<td>$cell</td>";

            echo "<td><a class='btn btn-secondary' href='MatchList.php?TournamentID=$row[0]' role='button'>View details &raquo;</a></td>";
            if($userPerm == 1){
            echo "<td><a class='btn btn-secondary' href='delete_entry.php?type=to&id=$row[0]' role='button'>&times;</a></td>";
            }
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
