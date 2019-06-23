<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pay for something</title>
	<link rel="stylesheet" href="css/app.css">
</head>
<body>
	<!-- 
	 -->
	<div class="payment-container">
		<h2 class="header">Pay for something</h2>
		<form action="checkout.php" method="post" autocomplete="off">
			<label for="item"><input type="hidden" name="product" value="Video Contest 1"></label>
			<label for="price"><input type="hidden" name="price" value="7.0"></label>
			<label for="first_name">First Name<input type="text" name="first_name" value=""></label>
			<label for="last_name">Last Name<input type="text" name="last_name" value=""></label>
			<label for="email">Email<input type="text" name="email" value=""></label>
			<input type="submit" value="Pay">
		</form>
		<p>You'll be taken to complete your payment.</p>
	</div>
</body>
</html>