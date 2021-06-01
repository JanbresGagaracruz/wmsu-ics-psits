<?php

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// Database settings. Change these for your database configuration.
$dbConfig = [
	'host' => 'localhost',
	'username' => 'u179407683_collection',
	'password' => 'Katalepsy123',
	'name' => 'u179407683_psits'
];

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
	'email' => 'janbres666@gmail.com',
	'return_url' => 'https://wmsu-psits-collection.online/view/user_payment.php',
	/* 'cancel_url' => 'http://example.com/payment-cancelled.html', */
	'notify_url' => 'https://wmsu-psits-collection.online/view/user_payment.php'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.
$itemName = 'Test Item';
$itemAmount = 5.00;

// Include Functions
require 'functions.php';

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
	/* $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']); */
	$data['notify_url'] = stripslashes($paypalConfig['notify_url']); 

	// Set the details about the product being purchased, including the amount
	// and currency so that these aren't overridden by the form data.
	$data['item_name'] = $_POST['item_name'];
	$data['amount'] = $_POST['amount'];
	$data['currency_code'] = 'PHP';


	$queryString = http_build_query($data);

	header('location:' . $paypalUrl . '?' . $queryString);
	exit();

} else {

	$db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);

	$data = [
		'item_name' => $_POST['item_name'],
		'item_number' => $_POST['item_number'],
		'payment_status' => $_POST['payment_status'],
		'payment_amount' => $_POST['amount'],
		'payment_currency' => $_POST['mc_currency'],
		'txn_id' => $_POST['txn_id'],
		'receiver_email' => $_POST['receiver_email'],
		'payer_email' => $_POST['payer_email'],
		'custom' => $_POST['custom'],
	];

	if (verifyTransaction($_POST) && checkTxnid($data['txn_id'])) {
		if (addPayment($data) !== false) {
		}
	}
}