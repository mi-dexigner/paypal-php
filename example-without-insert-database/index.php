<?php require_once 'paypalFunctions.php'; 
// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'name' => 'paypalPayment'
];
$db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paypal Integration Test</title>
</head>
<body>

<?php 
if(isset($_GET['action'])=='payment' && !empty($_GET['action'])=='payment' && $_GET['action'] == 'payment' && !empty($_GET['action'])){
	'payment';
	$enableSandbox = true;



// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'email' => 'developerfullstack8@gmail.com',
    'return_url' => 'http://localhost/paypal/example-2/?payment=successful',
    'cancel_url' => 'http://localhost/paypal/example-2/?payment=cancelled',
    'notify_url' => 'http://localhost/paypal/example-2/?action=payment'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
// Product being purchased.
$itemName = 'Test Item';
$itemAmount = 5.00;


// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {
	// Grab the post data so that we can set up the query string for PayPal.
	// Ideally we'd use a whitelist here to check nothing is being injected into
	// our post data.
	$data = [];
	foreach ($_POST as $key => $value) {
		$data[$key] = stripslashes($value);
	}
	// Set the PayPal account.
	$data['business'] = $paypalConfig['email'];
	// Set the PayPal return addresses.
	$data['return'] = stripslashes($paypalConfig['return_url']);
	$data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
	$data['notify_url'] = stripslashes($paypalConfig['notify_url']);
	// Set the details about the product being purchased, including the amount
	// and currency so that these aren't overridden by the form data.
	$data['item_name'] = $itemName;
	$data['amount'] = $itemAmount;
	$data['currency_code'] = 'USD';
	// Add any custom fields for the query string.
	//$data['custom'] = USERID;
	// Build the query string from the data.
	echo $queryString = http_build_query($data);
	// Redirect to paypal IPN
	header('location:' . $paypalUrl . '?' . $queryString);
	exit();
} else {
	// Handle the PayPal response.
	// Create a connection to the database.
	$db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);
	// Assign posted variables to local data array.
	$data = [
		'item_name' => $_POST['item_name'],
		'item_number' => $_POST['item_number'],
		'payment_status' => $_POST['payment_status'],
		'payment_amount' => $_POST['mc_gross'],
		'payment_currency' => $_POST['mc_currency'],
		'txn_id' => $_POST['txn_id'],
		'receiver_email' => $_POST['receiver_email'],
		'payer_email' => $_POST['payer_email'],
		'custom' => $_POST['custom'],
	];
	// We need to verify the transaction comes from PayPal and check we've not
	// already processed the transaction before adding the payment to our
	// database.
	if (verifyTransaction($_POST)) {
		$sql ="INSERT INTO `payments` ( `txnid`, `payment_amount`, `payment_status`, `itemid`) VALUES (".$data['txn_id'].",".$data['payment_amount'].",".$data['payment_status'].",".$data['item_number'].")";

/*if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}*/
	}
}
}else if(isset($_GET['payment']) == 'successful' && $_GET['payment'] == 'successful' && !empty($_GET['payment'])){
	
	$data = [
		'item_name' => 'video',
		'item_number' => '1111',
		'payment_status' => '1',
		'payment_amount' => '1',
		'payment_currency' => '2.9',
		'txn_id' => 3322323112,
		'receiver_email' => 'emasa@ss.com',
		'payer_email' => 'emasa@ss.com',
		//'custom' => $_POST['custom'],
	];
	
 //$sql = "INSERT INTO `payments` (txnid, payment_amount, payment_status, itemid)  VALUES ($data['txn_id'], $data['payment_amount'], $data['payment_status'],$data['item_number'])";

 /**/
echo' <h1>Successful Payment</h1>';
}else if(isset($_GET['payment']) == 'cancelled' && $_GET['payment'] == 'cancelled' && !empty($_GET['payment'])){

echo ' <h1>Payment Cancelled</h1>';
}else{

 ?>
    <form class="paypal" action="<?php echo $_SERVER['PHP_SELF'];?>?action=payment" method="post" id="paypal_form">
         <input type="hidden" name="cmd" value="_xclick" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="lc" value="UK" />
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
        <input type="hidden" name="first_name" value="Customer's First Name" />
        <input type="hidden" name="last_name" value="Customer's Last Name" />
        <input type="hidden" name="payer_email" value="customer@example.com" />
        <input type="hidden" name="payer_id" value="123" />
        <input type="hidden" name="item_number" value="123456" / >
        <input type="submit" name="submit" value="Submit Payment"/>
    </form>
<?php } ?>

<?php 



?>
</body>
</html>