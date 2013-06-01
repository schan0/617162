<?php
include 'cmsFunctions.php';
include 'navigation.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>
</head>

<body>
	

</body>
<?php // displays all the product sales along with total sales within a time period
$sql = "SELECT customerOrder.dateAdded, customerOrder.o_id, customer.fName, customer.lName, customer.homeAddress, customer.homeCity, 
		customer.postCode, customer.contactNumber, customer.cardNumber, products.productName, customerOrder.quantity, customerOrder.totalPrice
		FROM customerOrder, customer, products WHERE customer.customer_id = customerOrder.customer_id AND customerOrder.p_id = products.p_id";
		
$sql1 = "SELECT YEAR(dateAdded) as SalesYear, MONTH(dateAdded) as SalesMonth, SUM(totalPrice) AS TotalSales FROM customerOrder
			GROUP BY YEAR(dateAdded), MONTH(dateAdded) ORDER BY YEAR(dateAdded), MONTH(dateAdded)";
		
$res = mysql_query($sql) or die(mysql_error());
$res1 = mysql_query($sql1) or die(mysql_error());
		
if(mysql_num_rows($res) !=0):
	while($row = mysql_fetch_assoc($res)) {
		echo '<p>Purchase Date:' . $row['dateAdded'] . '</p>';
		echo '<p>Order ID:'. $row['o_id'] . '</p>';
		echo '<p>First Name:'. $row['fName'] . '</p>';
		echo '<p>Last Name:'. $row['lName'] . '</p>';
		echo '<p>Home Address:'. $row['homeAddress'] . '</p>';
		echo '<p>City/Town:'. $row['homeCity'] . '</p>';
		echo '<p>Postcode:'. $row['postCode'] . '</p>';
		echo '<p>Contact Number:'. $row['contactNumber'] . '</p>';
		echo '<p>Card Number:'. $row['cardNumber'] . '</p>';
		echo '<p>Product Name:'. $row['productName'] . '</p>';
		echo '<p>Quantity:'. $row['quantity'] . '</p>';
		echo '<p>Total Price:'. $row['totalPrice'] . '</p>';
	}
endif;

if(mysql_num_rows($res1) !=0):
	while($row = mysql_fetch_assoc($res1)) {
		echo '<p>Sales Year:'. $row['SalesYear'] . '</p>';
		echo '<p>Sales Month:' . $row['SalesMonth'] . '</p>';
		echo '<p>Sales Total:' . $row['TotalSales'] . '</p>';
	}
endif;		
?>	
</html>