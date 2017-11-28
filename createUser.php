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
          <h1 class="display-3">Account Creation</h1>
            <?php
            // change the value of $dbuser and $dbpass to your username and password
                include 'connectvarsEECS.php';

                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                if (!$conn) {
                    die('Could not connect: ' . mysql_error());
                }

            // Escape user inputs for security
                $user = mysqli_real_escape_string($conn, $_POST['user']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $pass = mysqli_real_escape_string($conn, $_POST['password']);
                $addr = mysqli_real_escape_string($conn, $_POST['address']);
            // check unique username
                $query = "SELECT * FROM User WHERE username='$user'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows( $result );

                $error_missing = "You are missing the following fields: ";
                $error = 0;

                if(empty($user)){
                    $error_missing = $error_missing . "User, ";
                    $error = 1;
                }
                if(empty($pass)){
                    $error_missing = $error_missing . "password, ";
                    $error = 1;
                }
                if(empty($email)){
                    $error_missing = $error_missing . "email, ";
                    $error = 1;
                }
                if($error == 0) {
                    if ($count == 0) {
                    // attempt insert query
                        $pass = password_hash($pass, PASSWORD_DEFAULT);
                        list(, $hashalgo, $cost, $saltedpass) = explode('$', $pass);
                        $salt = substr($saltedpass, 0, 22);
                        $query = "INSERT INTO User (userName, email, password, address, userPerm) VALUES ('$user', '$email', '$pass', '$addr', 0)";
                        if(mysqli_query($conn, $query)){
                            echo "Record added successfully.";
                        } else{
                            echo $query;
                            echo mysqli_error($conn) . "\nERROR: Couldn't add user ";
                        }
                    }
                    else {
                        echo "Sorry that username is already taken";
                    }
                } else {
                    echo "$error_missing";
                }

            // close connection
            mysqli_close($conn);
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
