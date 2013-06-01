<?php 
include('includes/connect.php');
session_start();  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>All purpose E-Commerce website</title>
<link rel="stylesheet" type="text/css" href="myStyle.css">
</head>

<body>
<div id="content">
<div id="heading">
	<h2>Sam's Music Store</h2>
</div>

<?php include('includes/nav.php'); ?>

<div id="checkOutForm" >
    <form action="checkOut.php" method="post" >
        <input type="hidden" name="checkOut" value="true" />
		
            <label for="first name">First Name:</label>
            <input type="text" name="fName" id="fName" />
		
            <label for="last name">Last Name:</label>
            <input type="text" name="lName" id="lName" />
		
            <label for="delivery address">Delivery Address:</label>
            <textarea name="deliveryAddress" id="deliveryAddress" rows="5" cols="40"></textarea>
		
            <label for="cityTown">City/Town:</label>
            <input type="text" name="cityTown" id="cityTown" />
		
            <label for="postcode">Post Code:</label>
            <input type="text" name="postCode" id="postCode" size="8" />

            <label for="contactNumber">Contact Number:</label>
            <input type="text" name="contactNumber" id="contactNumber" size="8" />

            <label for="cardNumber">Credit Card Number:</label>
            <input type="text" name="cardNumber" id="cardNumber" />
		 
        <input type="submit" name="submit" value="Submit Order" />
    </form>
</div>	

<?php include('includes/foot.php'); ?>

<?php	// checks to see if the carts total price was posted to echo total price.
if(isset($_POST['totalPrice'])){
	$cartTotal = $_POST['totalPrice'];
	echo $cartTotal;
}	

if(isset($_POST['checkOut'])){ //makes sure all details are filled in so they can be put into the database
	$fName = mysql_real_escape_string($_POST['fName']);
	$lName = mysql_real_escape_string($_POST['lName']);
	$deliveryAddress = mysql_real_escape_string($_POST['deliveryAddress']);
	$cityTown = mysql_real_escape_string($_POST['cityTown']);
	$postCode = mysql_real_escape_string($_POST['postCode']);
	$contactNumber = mysql_real_escape_string($_POST['contactNumber']);
	$cardNumber = mysql_real_escape_string($_POST['cardNumber']);
	
	
	if(!$fName || !$lName || !$deliveryAddress || !$cityTown || !$postCode || !$contactNumber || !$cardNumber):
		if(!$fName):
			echo "<p>A first name is required</p>";
		endif;
		if(!$lName):
			echo "<p>A Last name is required</p>";
		endif;	
	
		if(!$deliveryAddress):
			echo "<p>An Address is required</p>";
		endif;	
	
		if(!$cityTown):
			echo "<p>A city or town is required</p>";
		endif;
		
		if(!$postCode):
			echo "<p>A postcode is required</p>";
		endif;
		
		if(!$contactNumber):
			echo "<p>A contact number is required</p>";
		endif;
		
		if(!$cardNumber):
			echo "<p>A card number is required</p>";
		endif;
		
		echo '<p><a href="checkOut.php">Try Again!</a></p>';
		
	else:
		$sql = "INSERT INTO customer VALUES (null, '$fName', '$lName', '$deliveryAddress', '$cityTown', '$postCode', 
		'$contactNumber', '$cardNumber', now())";
		$res	= mysql_query($sql) or die(mysql_error());
	endif;	
}

if(isset($_POST['checkOut'])){ //database is updated when button is clicked
	$cartOutput = "";
	$cartTotal = "";
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
		$cartOutput = "<h2 align = 'center'>Your shopping cart is empty</h>";
	} else {
		$i = 0;
		foreach ($_SESSION["cart_array"] as $each_product) {
			$product_id = $each_product['item_id'];
			$sql = mysql_query("SELECT * FROM products WHERE p_id = '$product_id' LIMIT 1");
			while ($row = mysql_fetch_array($sql)) {
				$product_name = $row["productName"];
				$description = $row["description"];
				$price = $row["price"];
			}
			$totalPrice = $price * $each_product['quantity'];
			$cartTotal = $totalPrice + $cartTotal;
			$productQuantity = $each_product['quantity'];
			$totalProductPrice = $totalPrice;
			$p_id = $each_product['item_id'];
			$cardNumber = $_POST['cardNumber'];
			$sql1 = "SELECT customer_id FROM customer WHERE cardNumber = '$cardNumber'";
			$res1	= mysql_query($sql1) or die(mysql_error());
			while($row = mysql_fetch_array($res1)) {
				$customer_id = $row['customer_id'];
			}
			$sql2 = "INSERT INTO customerOrder VALUES (null, '$p_id', '$customer_id', '$productQuantity', '$totalProductPrice', now())";
			$res	= mysql_query($sql2) or die(mysql_error());
			$sql3 = "UPDATE products SET quantity = (quantity - '$productQuantity') WHERE p_id = '$p_id' ";
			$res2	= mysql_query($sql3) or die(mysql_error());
			$i++;
		}
	echo "Your order has been submitted!";
	
	}
}
?>	
</div>

</body>
</html>
	

	
