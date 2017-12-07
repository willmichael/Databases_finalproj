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
          <h1 class="display-3">Players</h1>
        </div>
      </div>

    <?php
    // change the value of $dbuser and $dbpass to your username and password
        include 'connectvarsEECS.php';

        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$conn) {
            die('Could not connect: ' . mysql_error());
        }
    // Retrieve name of table selected

        $query = "SELECT playerName, rating, specialty, playerID FROM Player ";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query to show fields from table failed");
        }

    // setup structure
        echo "<div class='container'>";

        $userID = $_SESSION['userID'];
	
	echo "<table id = 't05' border = '1'><tr>";
	echo "<td><b>Player Name</b></td>";
	echo "<td><b>Rating</b></td>";
	echo "<td><b>Specialty</b></td>";
	echo "<td><b>Player ID</b></td>";
	echo "</tr>\n";
        while($row = mysqli_fetch_row($result)) {
            echo "<tr>";
            foreach($row as $cell)
		echo "<td>$cell</td>";

            $is_following = "Select * from FollowingPlayer where playerID = $row[3] and userID = $userID";
            $result_follow = mysqli_query($conn, $is_following);
            $count_follow = mysqli_num_rows( $result_follow );
            
            if ($count_follow == 0){
                echo "<td><a class='btn btn-primary' href='follow.php?genID=$row[3]&isplayer=true' role='button'>Follow Me!</a></td>";
            } else {
                echo "<td><a class='btn btn-secondary' href='stop_follow.php?genID=$row[3]&isplayer=true' role='button'>Stop Following!</a></td>";
            }
            echo "<td><a class='btn btn-secondary' href='player_page.php?playerName=$row[0]' role='button'>View details &raquo;</a></td>";
            if($userPerm == 1){
            echo "<td><a class='btn btn-secondary' href='delete_entry.php?type=p&id=$row[3]' role='button'>&times;</a></td>";
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
