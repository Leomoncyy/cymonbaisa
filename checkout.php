<?php
define('MERCHANT_ID', 'TESTCAIMON');
define('MERCHANT_PASSWORD', 'ACQc4zyAdwQfYK9');
include 'config.php';
//db insertion

if(isset($_POST['submit'])){

	$txnid = $_POST['txnid'];
	$amount = $_POST['amnt']; 
	$ccy = $_POST['crncy']; 
	$description = $_POST['dscprtn']; 
	$email = $_POST['emailAdd']; 
	$procid = $_POST['procid']; 
	
	$sql = "INSERT INTO `tbl_transactions`(`txnid`, `refno`, `ccy`, `description`, `email`, `procid`, `amount`, `status`, `message`) 
	VALUES ('$txnid','','$ccy','$description','$email','$procid','$amount','','')";
	
	if ($conn->query($sql) === TRUE) {
		echo "";
	} else {
		echo "";
	}

	$conn->close();
	}



//redirection
$url = "https://test.dragonpay.ph/api/collect/v1/" .@$_POST['txnid']."/post";

$header = array(
   "Authorization: basic ".base64_encode(MERCHANT_ID.':'.MERCHANT_PASSWORD),
   "Content-Type: application/json"
);


$data_array = [
	'Amount' => @$amount, 
	'Currency' => @$ccy, 
	'Description' => @$description, 
	'Email' => @$email, 
	'ProcId' => @$procid,
];

$data = json_encode($data_array);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);

//header
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//for debug only!
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);

if ($e = curl_error($ch)) {
	
	echo $e;
	
} else {
	
	$decoded = json_decode($resp, true);

	$redir = @$decoded["Url"];
	header("Location: $redir");
}

curl_close($ch);
?>


<!DOCTYPE html>
<html>
<head>
  <style>
  $field-color:#f4f6f8;
$button-color:#5ab45a;
body, input,label {
  font-family:"Abel","Roboto","Avenir Next", "avenir-next", -apple-system, BlinkMacSystemFont, "Segoe UI", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif
}

body {
  background: #e9e9e7;
}

p, a, label{
  font-size: 14px;
  text-transform:capitalize;
  color:#6a6969;
}
.card-checkout {
  max-width: 500px;
  min-height: 600px;
  margin: 100px auto;
  background: #fff;
  box-shadow: 0 0 40px rgba(#000, 0.2);
  border-radius: 4px;
  overflow: hidden;
  
  
  > .heading {
    display: inline-block;
    background: #fff;
    padding: 24px 32px 0 48px;
    text-transform: capitalize;
    font-family: "Lato", sans-serif;
    letter-spacing: 0.08em;
  }
    > .heading > .icon {
    color:$button-color;
    font-size: 1.5em;
  }

   > .content {
    padding: 24px 32px 32px 40px;
  }
      
}
  .input-group {
  display: flex;
  -webkit-appearance: none;
  border-radius: 8px;
  border: 2px solid #ccd7e0;
  background: #fdfdfc;
  padding:0;
  font-weight: normal;
  color: #345;
  width:270px;
   
}

 .input-group > .form-control {
  width: 100%;
  padding: 12px;
}  

.form-control {
  -webkit-appearance: none;
  border-radius: 16px;
  border: none;
  background: #fdfdfc;
  padding: 8px ;
  font-weight: normal;
  color: #345;
 

}
    

 .button { 
  -webkit-appearance: none;
  margin-bottom: 0;
  text-align:center;
  font-weight: normal;
  text-align: center;
  background-image: none;
  border: 1px solid transparent;
  padding: 12px 12px;
  font-size: 14px;
  border-radius: 12px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  color: #fff;
  background: #4268b3;
  letter-spacing: 0.08em;

  &.-primary {
    
    padding:8px;
    background: $button-color;
  }
  
}
  label {width: 130px; float: left;font-family: "Lato", sans-serif; padding-top: 15px}
  input {width: 250px;}
  .form{
    width: 500px;
    height: 500px;
    border: 2px solid black;
    border-radius: 6px;
    margin: 0 auto;
  }
  .input{
      text-align:center;
      margin: 0 auto;
  }
  .back-btn{
      text-align:left;
      margin-left: -125px;
  }
  </style>
</head>
<body>
  <div class="card-checkout" style="text-align:center">
  
  <div class="heading">
    <a href="https://cymonbaisa.000webhostapp.com"><p class="back-btn">Back</p></a><h3>Checkout details</h3><br>
  </div>
  <form method="POST">
    <div class="content">
    <label>TXNID</label>
    <div class="input-group">
      <input type="number" name="txnid" class="form-control" value="<?php echo crc32(uniqid()) ?>"></input>
    </div><br>
    <label>Amount</label>
    <div class="input-group">
      <input class="form-control" name="amnt" type="number"></input>
    </div><br>
    <label>Currency</label>
    <div class="input-group">
      <input class="form-control" name="crncy" type="text"></input>
    </div><br>
    <label>Email Address</label>
    <div class="input-group">
      <input class="form-control" name="emailAdd" type="text"></input>
    </div><br>
    <label>ProcID</label>
    <div class="input-group">
      <input class="form-control" name="procid" type="text"></input>
    </div><br>
    <label>Description</label>
    <div class="input-group">
      <textarea class="form-control" name="dscprtn" type="textarea"></textarea>
    </div>
    <br/><br>
    <input style="cursor:pointer" class="button -primary" type="submit" name="submit" value="Proceed to payment"></input>
  </div>
  </form>
</div>
</body>
</html>

