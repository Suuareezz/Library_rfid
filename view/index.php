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
    <nav>
        <div>
            <ul id="navbarul">
                <li id="navbarli"><a id="navbara" href="../">
                        <div class="container">Home</div>
                    </a></li>
                <li id="navbarli"><a id="navbara" class="active" href="../login/">
                        <div class="container">Student Login</div>
                    </a></li>
                <li id="navbarli"><a id="navbara" href="/library/get/">
                        <div class="container">Get Books</div>
                    </a></li>
                <li id="navbarli"><a id="navbara" href="../return/">
                        <div class="container">Return Books</div>
                    </a></li>
            </ul>
        </div>
    </nav>


    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION['userid'];
echo ' <header class="bg-primary text-white">
    <div class="container text-center">'.'<h1>'."Welcome  ". $user.'</h1>'.  '</div>'.
  '</header>';
  
$sql1= "SELECT uniqueid from users where userid='$user'";
$r1= $conn->query($sql1);

$object = mysqli_fetch_object($r1);
$name = $object->uniqueid;



$sql = "SELECT  b.name, b.author, b.publication , t.datetaken FROM books b, taken t WHERE t.booktaken=b.uniqueid and t.usertaken='$name'";
$result = $conn->query($sql);    
$tf=0;
if (!empty($result)) {
    while($row = $result->fetch_assoc()) { 
        $date = new DateTime($row["datetaken"]); 
	    $today = new DateTime('today');
        $diff=date_diff($date,$today);
        $d= $diff->format("%R%a");
  
        if($d<15){
   $Color = "green";
   echo '<section id="about">';
echo '<div class="col-lg-8 mx-auto">'.'<p class="lead">'."CURRENT BOOKS:".'</p>'.'</div>';
         echo 
    '<div class="container">'.
      '<div class="row">'.
     
        '<div class="col-lg-8 mx-auto">'. '<p class="lead">'.'<div style="Color:'.$Color.'">'. " Book name: " . $row["name"]."<br>" . "  Author: " . $row["author"]."<br>"."  Publication: " . $row["publication"]."<br>" . '</div>'."<br>" .'</p>'.'</div>'.
     ' </div>'.
   ' </div>';
   echo  '</section>';
    }
    else{
 $Color = "red";

 $d1=$d-15;
 $dd=$d1*0.5;
 $tf=$tf+$dd;
 
 echo '<section id="about">';
echo '<div class="col-lg-8 mx-auto">'.'<p class="lead">'."EXPIRED BOOKS:".'</p>'.'</div>';
         echo 
    '<div class="container">'.
      '<div class="row">'.
     
        '<div class="col-lg-8 mx-auto">'. '<p class="lead">'.'<div style="Color:'.$Color.'">'. " Book name: " . $row["name"]."<br>" . "  Author: " . $row["author"]."<br>"."  Publication: " . $row["publication"]."<br>"."  fine: " . $dd."<br>" . '</div>'."<br>" .'</p>'.'</div>'.
     ' </div>'.
   ' </div>';

echo  '</section>';

}
        
         
}
}
 else {
    echo "0 results";
}


echo ' <header class="bg-primary text-white">
    <div class="container text-center">'.'<h1>'."TOTAL FINE ". $tf.'</h1>'.  '</div>'.
  '</header>';

$conn->close();
?>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>Contact us</h2>
                    <p class="lead">
                        Queries can be contacted here.
                    </p>
                </div>
            </div>
        </div>
    </section>
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