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
<?php // displays all products and their details including date when added
$sql = "SELECT products.p_id, products.productName, products.description, products.price, products.quantity,
		products.dateAdded, category.name FROM products, category WHERE products.c_id = category.c_id";
$res = mysql_query($sql) or die(mysql_error());
		
if(mysql_num_rows($res) !=0):
	while($row = mysql_fetch_assoc($res)) {
		echo '<h2>' . $row['productName'] . '</h2>';
		echo '<p>Category:'. $row['name'] . '</p>';
		echo '<p>Description:' . $row['description'] . '</p>';
		echo '<p>Price:' . $row['price'] . '</p>';
		echo '<p>Quantity:' . $row['quantity'] . '</p>';
		echo '<p>Date Added:' . strftime("%b %d, %Y",strtotime($row['dateAdded'])) . '</p>';
	}
else:
	echo '<p>No Products exist in the database!</p>';
endif;		
?>	
</html>