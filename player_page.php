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
                $player = mysqli_real_escape_string($conn, $_GET['playerName']);

            // Display team name up top
                echo "<h1 class='display-3'>$player</h1>";

            // check unique username
                $query = "SELECT playerID, playerName, bio, dob, rating, specialty FROM Player WHERE playerName='$player'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows( $result );

                if ($count == 1) {
                // attempt validate password
                    $row = mysqli_fetch_row($result);
                    echo "<h1 class='display-6'>Rating: $row[4]</h1>";
                    echo "<h1 class='display-6'>Specialty: $row[5]</h1>";
                }
                else {
                    echo "Could not find matching player, sorry";
                }

            // close connection
            mysqli_close($conn);
            ?>
        </div>
      </div>
        <div class='container'>
            <?php
                if ($count == 1) {
                    echo "<p>";
                    echo "DOB: $row[3]";
                    echo "</p>";

                    echo "<p>";
                    echo "BIO: $row[2]";
                    echo "</p>";
                }
            ?>
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
