<!DOCTYPE html>
<html lang="en">
<head>
  <title>ERP System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<head> <link rel="stylesheet" href="styles.css"> </head>
<body>
<?php
if (isset($_POST['form_submitted'])):
    $db = mysqli_connect('localhost','root','','erp') or die('Error connecting to MySQL server.');
    
    $reference = $_POST['reference'];
    $manufacturer = $_POST['manufacturer'];
    $classification = $_POST['classification'];
    $quantity= $_POST['quantity'];
    $type = $_POST['type'];
    $date = $_POST['date'];

    $sql = "INSERT INTO ADHESIVE VALUES ('$reference','$manufacturer','$classification','$quantity','$type','$date')";
    
    if (mysqli_query($db,$sql)) {
        header("Location: adhesive_list.php");
    } else {
        header("Location: error.php");
    }
    mysqli_close($db);
endif; 
?>



    <ul>
        <li><a href="material_list.php"><div class="container">Materials</div></a></li>
        <li><a href="film_list.php"><div class="container">Film</div></a></li>
        <li><a class="active" href="adhesive_list.php"><div class="container">Adhesive</div></a></li>
        <li><a href="spare_list.php"><div class="container">Spare</div></a></li>
    </ul>
    <div class="container">
        <br>
        <h2>Enter material details here</h2><br>
        <form method="post" action="adhesive_list.php">
            <div class="form-group">
                <label for="pwd">Reference Number:</label>
                <input type="text" class="form-control" id="reference" placeholder="Enter Reference Number" name="reference" required>
            </div>
            <div class="form-group">
                <label for="pwd">Manufacturer:</label>
                <input type="text" class="form-control" id="gsm" placeholder="Enter Manufacturer" name="manufacturer" required>
            </div>
            <div class="form-group">
                <label for="pwd">Classification:</label>
                <input type="text" class="form-control" id="gsm" placeholder="Enter Classification" name="classification" required>
            </div>
            <div class="form-group">
                <label for="pwd">Quantity:</label>
                <input type="text" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity" required>
</div>


<div class="form-group">
                
                <select class="form-control" id="sel1" name="unit">
                 <datalist>   <option value="" disabled selected>Select Quantity Unit </option>
                    <option>kgs
                    <option> drums
                     </datalist>
                </select>
            </div>
                <div class="form-group">
                <label for="sel1">Select Type :</label><br>
                <input type="text" list="type" name="type" placeholder="   Select type" style="width: 1110px; height:37px;"/>
                <datalist id="type" id="sel1">
                    <option>PUR</option>
                   
                </datalist>
            </div>
            <div class="form-group">
      <label for="pwd">Expiry Date:</label>
      <input type="date" class="form-control" id="date" placeholder="Enter Expiry Date" name="date" required>
    </div>
            <input type="hidden" name="form_submitted" value="1"/>
            <center><button type="submit" class="btn btn-primary">Submit</button></center>
        </form>
    </div>
</body>
</html>