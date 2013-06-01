<?php include 'includes/connect.php';?>


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
<?php include 'includes/nav.php'; ?>
<?php
if(isset($_GET['p_id'])) { //views product details from category page
	$p_id = preg_replace('#[^0-9]#i','',$_GET['p_id']);
	$sql = "SELECT p_id, productName, description, price, quantity FROM products
		   WHERE p_id = $p_id";
	$res = mysql_query($sql) or die(mysql_error());
	
	while($row = mysql_fetch_assoc($res)) {
	
		$path = "../admin/ProductImages/";
		if ($imageResult = glob($path . $p_id . ".*" )) {
			$imageLocation = '<img src= '. $imageResult[0] .' width= "300" height= "300" >';
		}
		else {
				$imageLocation = '<p>No Image Display</p>';
		}		
		
		echo '<h2>' . $row['productName'] . '</h2>';
		echo $imageLocation; 
		echo '<p>Description:' . $row['description'] . '</p>';
		echo '<p>Price:' . $row['price'] . '</p>';
		echo '<p>Quantity:' . $row['quantity'] . '</p>';
		echo '<form id="form1" name="form1" method="post" action="cart.php">
		<input type="hidden" name="p_id" id="p_id" value=' . $row['p_id'] . ' />
		<input type="submit" name="button" id="button" value="Add Product to Cart"/>
		</form>';
	}
}
?>	
<?php include('includes/foot.php'); ?>
</div>

</body>
</html>