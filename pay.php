<?php 
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
require 'config/config.php';

require 'start.php';

if (!isset($_GET['payment'], $_GET['paymentId'], $_GET['PayerID'])) {
	die();
}

if ($_GET['payment'] === 'failed') {
"<h2>Payment </h2>";
	//die();
}

$paymentId =$_GET['paymentId'];
$payerId = $_GET['PayerID'];

$payment =  Payment::get($paymentId,$paypal);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);
try{
$result = $payment->execute($execute, $paypal);
}catch(Exception $e){
$data = json_decode($e->getData());
//var_dump($data);
}
//print_r(json_decode($result->toJSON(),true));
$data = json_decode($result->toJSON(),true);
$payId = $data["id"];
$state =  $data["state"];
$status= $data['payer']["status"];
$email= $data['payer']['payer_info']["email"];
$first_name= $data['payer']['payer_info']["first_name"];
$last_name= $data['payer']['payer_info']["last_name"];
$payerId= $data['payer']['payer_info']["payer_id"];
$total= $data['transactions'][0]['amount']["total"];
$totalCurrency= $data['transactions'][0]['amount']["currency"];
$subtotal= $data['transactions'][0]['amount']["details"]['subtotal'];
$invoiceNumber= $data['transactions'][0]['invoice_number'];
$saleId= $data['transactions'][0]['related_resources'][0]['sale']['id'];
$stateComplete= $data['transactions'][0]['related_resources'][0]['sale']['state'];
$transactionFee= $data['transactions'][0]['related_resources'][0]['sale']['transaction_fee']['value'];
$transactionFeeCurrency= $data['transactions'][0]['related_resources'][0]['sale']['transaction_fee']['currency'];
$createTime=$data["create_time"];


$addTransciation = "INSERT INTO `transciation` (payId,state,status,email,first_name,last_name,payerId,total,totalCurrency,subtotal,invoiceNumber,saleId,stateComplete,transactionFee,transactionFeeCurrency,createTime) ";
$addTransciation .= "VALUES ('$payId','$state','$status','$email','$first_name','$last_name','$payerId','$total','$totalCurrency','$subtotal','$invoiceNumber','$saleId','$stateComplete','$transactionFee','$transactionFeeCurrency','$createTime')";
                    $addTransciationResult = $database->query($addTransciation);
								
					// If there was a query error
if($addTransciationResult){
	// Success
	echo   "<p>Paypment has been successfull charged</p>";
}else{
	// Error
	echo   "<p>Paypment has not been successfull charged. Please contact to support</p>";
}
