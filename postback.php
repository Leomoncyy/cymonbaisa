<?php
file_put_contents('data.log',json_encode($_POST));
define('MERCHANT_ID', 'TESTCAIMON');
define('MERCHANT_PASSWORD', 'ACQc4zyAdwQfYK9');
include 'config.php';

$digest = $_POST['digest'] ?? '';
$txnid = $_POST['txnid'] ?? '';
$status = $_POST['status'] ?? '';
$refno = $_POST['refno'] ?? '';
$message = $_POST['message'] ?? '';

$result = 'unknown';
$is_okay = false;

// transaction status
$statusList = [
	'S' => 'Success',
	'F' => 'Failure',
	'P' => 'Pending',
	'U' => 'Unknown',
	'R' => 'Refund',
	'K' => 'Chargeback',
	'V' => 'Void',
	'A' => 'Authorized'
];

if (empty($digest) || empty($txnid) || empty($status) || empty($refno) || empty($message)) {
	$result = 'invalid_parameters_received';
}
else if (!in_array($status, array_keys($status_list))) {
	$result = 'invalid_status_'.$status;
}
else {
	$parameters = [
		'txnid' => $txnid,
		'refno' => $refno,
		'status' => $status,
		'message' => $message,
		'key' => MERCHANT_PASSWORD
	];

	$conncatenatedString = implode(':', $parameters);
	$digest2 = sha1($conncatenatedString);

	if($digest2 != $digest)
	{
		$result = 'digest_error';
	}
	else
	{
		$sql = "SELECT * FROM `tbl_transactions` WHERE `txnid` = $txnid";
		
		$result = $conn->query($sql);
		
	
		if ($result->num_rows > 0)
		{
		
			$merchant_status = $statusList[$status];
			$sql = "UPDATE `tbl_transactions` SET `status` = '$merchant_status', `refno` = '$refno', `message` = '$message' WHERE `txnid` = '$txnid'";
			
			if ($conn->query($sql)===TRUE)
			{
				$result = 'ok';
				$is_okay = true;
			}
			else{
				
				$result = 'db_error';
			}
		}
		else {
			$result = 'txn_not_found';
		}
	}
	
}

if (!$is_okay) {

	http_response_code(500);

}

echo "result=".$result;

?>