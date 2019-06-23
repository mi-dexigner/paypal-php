<?php 
require 'vendor/autoload.php';
$paypal = new \PayPal\Rest\ApiContext(
new \PayPal\Auth\OAuthTokenCredential(
	'Ad-NvjNqcAGTXkzOx-sc9uLC3fasJmEX1iRo9U9vB7yTXsl25-9JFMuqTEqwtCAGmMfVYPy4yfkL4PSg',// cliend id
	'EO-FV90WH2XkunYtCq71NgoNvhFyQ20OXoaQPRj0xjUwHlj7vEceY9mlV45kl2QHENPR4uKnqWzddnGN' // secret key
)
);
/*

'AU6ZFqZdOZJuGGhb2tW9dyHdpOQTYIJbZDUfBjR7ojqXsK4TIKIutlTC0zzVEM-dKDsMGxhmEsNkwUkU',// cliend id
	'EBQBzfytkT9FPzQOpzKut9cIdKTbrh9R1rKw4YTSl4HiN7lke8PuKMRwCOpFVQCx_x1CXg7obOv7YK4-' // secret key

*/

 ?>