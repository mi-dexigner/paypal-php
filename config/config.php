<?php
// Base URL Setting 
define("BASE_URL","http://localhost/paypal");


// Time Zone Setting
date_default_timezone_set("Asia/Karachi");

// display error for production
ini_set('display_errors', 'on');

error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

/**  Create a database Connection */

/** The name of the database for CMS */
define('DB_NAME', 'paypalPayment');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', '');
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

$database = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);

/**  database if connection occurred. */
if(mysqli_connect_errno()){
	die("Database connection failed: " .
	mysqli_connect_error(). 
	" (". mysqli_connect_errno(). ")"		
	);
	} 
	function confirm_query($result_set){
		if(!$result_set){
			die("Database query failed.");
		}
	}
?>