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
    $todaydate = date("Y-m-d");
    $sql = "select datetaken from taken where usertaken = '$user' and booktaken = '$book'";
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $date = new DateTime($row["datetaken"]); 
	    $today = new DateTime("today");
        $diff=date_diff($date,$today);
        $d= $diff->format("%R%a");
        
        if($d<15) {
            echo "<script>alert('There is no fine amount')</script>";
        }
        else if($d>=15){
            $fine = $d*0.5;
            echo '<script>alert("The fine amount is '.$fine.' ")</script>';
        }
        $sql = "delete from taken where usertaken='$user' and booktaken='$book'";
        $result = mysqli_query($conn,$sql);
        echo "<script>alert('The book is returned successfully')</script>";
    }
}
?>

<body id="page-top">
    <div>
        <ul id="navbarul">
            <li id="navbarli"><a id="navbara" href="../">
                    <div class="container">Home</div>
                </a></li>
            <li id="navbarli"><a id="navbara" href="../login/">
                    <div class="container">Student Login</div>
                </a></li>
            <li id="navbarli"><a id="navbara" href="../get/">
                    <div class="container">Get Books</div>
                </a></li>
            <li id="navbarli"><a id="navbara" class="active" href="/library/return/">
                    <div class="container">Return Books</div>
                </a></li>
        </ul>
    </div>
    </nav>

    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Return your books here!</h1>
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
                <input type="text" class="form-control" id="user"
                    placeholder="Place your Student ID Card near the RFID Scanner" name="user" required>
            </div>
            <div class="form-group">
                <label for="pwd">Book Reference Number:</label>
                <input type="text" class="form-control" id="book" placeholder="Place your Book near the RFID Scanner"
                    name="book" required>
            </div>
            <input type="hidden" name="flag" value="1" />
            <center><button type="submit" class="btn btn-primary">Return your Book</button></center>
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