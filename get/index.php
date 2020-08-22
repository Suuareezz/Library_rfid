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
<?php
   if(isset($_POST['flag'])) {
    $conn = mysqli_connect('localhost','root','','library');
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $user = mysqli_real_escape_string($conn,$_POST['user']);
    $book = mysqli_real_escape_string($conn,$_POST['book']);
    $sql = "select count(usertaken) as COUNT from taken where usertaken='$user'";
    $result = mysqli_query($conn,$sql);
    $todaydate = date("Y-m-d");
}
 if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if($row['COUNT']==6) {
        echo "<script>alert('USER HAS ALREADY TAKEN 6 BOOKS')</script>";
      }
      else {
        $sql = "insert into taken values('$user','$todaydate','$book')";
        $result = mysqli_query($conn,$sql);
        echo "<script>alert('Book taken successfully!');</script>";
      }
    }
?>

<body id="page-top">
    <nav>
        <div>
            <ul id="navbarul">
                <li id="navbarli"><a id="navbara" href="../">
                        <div class="container">Home</div>
                    </a></li>
                <li id="navbarli"><a id="navbara" href="../login/">
                        <div class="container">Student Login</div>
                    </a></li>
                <li id="navbarli"><a id="navbara" class="active" href="/library/get/">
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
            <h1>Get your books here!</h1>
            <p class="lead">
                Required: Student ID Card, Book
            </p>
        </div>
    </header>
    <div class="container">
        <br><br>
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="pwd">Student ID Card:</label>
                <input type="text" class="form-control" id="student"
                    placeholder="Place your Student ID Card near the RFID Scanner" name="user" required>
            </div>
            <div class="form-group">
                <label for="pwd">Book Reference Number:</label>
                <input type="text" class="form-control" id="book" placeholder="Place your Book near the RFID Scanner"
                    name="book" required>
            </div>
            <input type="hidden" name="flag" value="1" />
            <center><button type="submit" class="btn btn-primary">Get your Book</button></center>
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