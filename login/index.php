<?php 
@ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PSG Tech E Library</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/scrolling-nav.css" rel="stylesheet" />
    <link href="../css/navbar.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>
</head>

<body id="page-top">
    <?php 
    if(isset($_POST['flag'])) {
      $conn = mysqli_connect('localhost','root','','library');
      if(!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }
      $userid = mysqli_real_escape_string($conn,$_POST['userid']);
      $password = mysqli_real_escape_string($conn,$_POST['pass']);
      $sql = "SELECT userid,pass from users where userid='$userid' and pass='$password'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      if($count==1) {
          $_SESSION["userid"] = $userid;
          echo "<script>window.location.href='/library/view/'</script>";
      }
      else {
          echo "<script>alert('Invalid user name or password!');</script>";
      }
      $conn->close();
  }
    ?>
    <div>
        <ul id="navbarul">
            <li id="navbarli"><a id="navbara" href="../">
                    <div class="container">Home</div>
                </a></li>
            <li id="navbarli"><a id="navbara" class="active" href="/library/login/">
                    <div class="container">Student Login</div>
                </a></li>
            <li id="navbarli"><a id="navbara" href="../get/">
                    <div class="container">Get Books</div>
                </a></li>
            <li id="navbarli"><a id="navbara" href="../return/">
                    <div class="container">Return Books</div>
                </a></li>
        </ul>
    </div>
    </nav>

    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Welcome! Login to GRD Memorial Library</h1>
            <p class="lead">
                Enter your login details to continue..
            </p>
        </div>
    </header>
    <div class="container">
        <br><br>
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="pwd">Roll Number:</label>
                <input type="text" class="form-control" id="roll" placeholder="Enter your Roll Number" name="userid"
                    required>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pass" placeholder="Enter your Password" name="pass"
                    required>
            </div>
            <input type="hidden" name="flag" value="1" />
            <center><button type="submit" class="btn btn-primary">Login</button></center>
        </form>
    </div>
    <br><br>
    <footer class="py-2 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">
                Copyright &copy; GRG Memorial Library 2020
            </p>
        </div>
        <!-- /.container -->
    </footer>
</body>

</html>