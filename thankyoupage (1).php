<?php
    $status = $_GET['status'];
    if($status == "S"){
        $payment = "PAYMENT COMPLETED";
        $info = "Thank you for your patience!";
        $backgroundColor = "green";
    }elseif($status == "P"){
        $payment = "PAYMENT PENDING";
        $info = "Please complete the payment process";
        $backgroundColor = "#FFA500";
    }elseif($status == "F"){
        $payment = "PAYMENT FAILED";
        $info = "An error occured during the payment process";
        $backgroundColor = "red";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    h2{
    height: 100px;
    background-color: <?php echo $backgroundColor; ?>;
    border-radius: 6px;
    }
  </style>
</head>
<body>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <div class="container" style="margin-top:5%;">
    	<div class="row">
            <div class="jumbotron" style="box-shadow: 2px 2px 4px #000000;">
                <h2 class="text-center" style="color: white"><br><?php echo $payment; ?></h2>
              <h3 class="text-center"><?php echo $info; ?></h3>
              
              <p class="text-center">Reference No.: <?php echo $_GET['refno']; ?></p>
              <p class="text-center">Payment Status: <?php 
              if($_GET['status'] == "S"){
                  echo "SUCCESS";
              }elseif($_GET['status'] == "F"){
                  echo "FAILED";
              }elseif($_GET['status'] == "F"){
                  echo "FAILED";
              }elseif($_GET['status'] == "P"){
                  echo "PENDING";
              }elseif($_GET['status'] == "U"){
                  echo "UNKNOWN";
              }elseif($_GET['status'] == "R"){
                  echo "REFUND";
              }elseif($_GET['status'] == "K"){
                  echo "CHARGEBACK";
              }elseif($_GET['status'] == "V"){
                  echo "VOID";
              }elseif($_GET['status'] == "A"){
                  echo "AUTHORIZED";
              }
              ; ?></p>
              <p class="text-center">Other details: <?php echo $_GET['message']; ?></p>
                <center><div class="btn-group" style="margin-top:50px;">
                    <a href="https://cymonbaisa.000webhostapp.com/" class="btn btn-lg btn-warning" style="background: #4268b3;border:white">Back to Dashboard</a>
                </div></center>
            </div>
    	</div>
    </div>
    
  
</body>
</html>