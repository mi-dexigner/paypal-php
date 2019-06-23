<?php 

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
require 'start.php';
require 'config/config.php';
if (!isset($_POST['product'], $_POST['price'])) {
	die();
}

$product = $_POST['product'];
$price = $_POST['price'];
$shipping = 2.00;
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];

//$total = $price + $shipping;
$total = $price;

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$payerInfo = new \PayPal\Api\PayerInfo();
$payerInfo->setFirstName($first_name)
		  ->setLastName($last_name)
 		  ->setEmail($email);

var_dump($payerInfo);
$item = new Item();
$item->setName($product)
	->setCurrency('USD')
	->setQuantity(1)
	->setPrice($price);

$itemList = new ItemList();
$itemList->setItems([$item]);
var_dump($payer);
$details = new Details();
$details->setSubtotal($price);
/*$details->setShipping($shipping)
		->setSubtotal($price);*/

$amount = new Amount();
$amount->setCurrency('USD')
		->setTotal($total)
		->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
		->setItemList($itemList)
		->setDescription("pay for something payment")
		->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls;
$redirectUrls->setReturnUrl(BASE_URL.'/pay.php?payment=success')
		->setCancelUrl(BASE_URL.'/pay.php?payment=failed');

$payment = new Payment();
$payment->setIntent('sale')
		->setPayer($payer)
		->setRedirectUrls($redirectUrls)
		->setTransactions([$transaction]);

try{
$payment->create($paypal);
}catch(Exception $e){
die($e);
}

$approvalUrl = $payment->getApprovalLink();

header("Location: {$approvalUrl}");
 ?>