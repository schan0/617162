<?php 
include('includes/connect.php'); 
session_start(); 
?>

<?php //adding a product into cart from product page
if(isset($_POST['p_id'])) {
	$p_id = $_POST['p_id'];
	$productExist = false;
	$i = 0;
	if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) <1){ //if the cart doesn't exist or nothings inside the cart
		$_SESSION["cart_array"] = array(0 => array("item_id" => $p_id, "quantity" => 1)); //then add the product id and set quantity as one
	} else { //if the cart already has this product then do this
		foreach($_SESSION["cart_array"] as $each_product){ //set each individual sub-array within the main array as a variable
			$i++;
			while(list($key, $value) = each($each_product)) { //making the two variables in a list to equal the two variables in the each array 
				if($key == "item_id" && $value == $p_id) { // execute if the item_id equals item_id and quantity equals item_id
					array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $p_id, "quantity" => $each_product['quantity'] +1))); 
					$productExist = true;
				}	
			}
		}
		if ($productExist == false) {
			array_push($_SESSION["cart_array"], array("item_id" => $p_id, "quantity" => 1));
		}	
	}
	header("location: cart.php");
}
?>

<?php //empty cart
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
	unset($_SESSION["cart_array"]);
}	
?>

<?php //modify product quantity
if (isset($_POST['adjustProductId']) && $_POST['adjustProductId'] !== "") {
	$adjustProductId = $_POST['adjustProductId'];
	$quantity = $_POST['quantity'];
	$quantity = preg_replace('#[^0-9]#i','',$quantity);
	if ($quantity >= 100) {$quantity = 99;}
	if ($quantity < 1) {$quantity = 1;}
	$i = 0;
	foreach($_SESSION["cart_array"] as $each_product){ //set each individual sub-array within the main array as a variable
			$i++;
			while(list($key, $value) = each($each_product)) { //making the two variables in a list to equal the two variables in the each array 
				if($key == "item_id" && $value == $adjustProductId) { // execute if the item_id equals item_id and quantity equals item_id
					array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $adjustProductId, "quantity" => $quantity))); 
				}	
			}
	}
}	
?>

<?php //remove single product
if(isset($_POST['removedId']) && $_POST['removedId'] != "") {
	$removedId = $_POST['removedId'];
	if (count($_SESSION["cart_array"]) <=1){
		unset($_SESSION["cart_array"]);
	}else {
		unset($_SESSION["cart_array"]["$removedId"]);
		sort($_SESSION["cart_array"]);

	}
}	
?>

<?php //display cart contents to change product details
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
			$path = "../admin/ProductImages/";
			$imagePath = glob($path . $product_id . ".*" );
		}
		$totalPrice = $price * $each_product['quantity'];
		$cartTotal = $totalPrice + $cartTotal;
		
		$totalPrice = number_format($totalPrice, 2);
		$price = number_format($price, 2);
		
		$cartOutput.= '<tr>';
		$cartOutput .= '<td><a href="product.php?p_id=' . $product_id . '">' . $product_name . '</a><br/>
		<img src=' . $imagePath[0] . ' alt="' . $product_name. '" width ="240" height="240" border="1" /></td>';
		$cartOutput .= '<td>' . $description . '</td>';
		$cartOutput .= '<td>£' . $price . '</td>';
		$cartOutput .= '<td><form action = "cart.php" method = "post">
		<input name = "quantity" type = "text" value = "' . $each_product['quantity'] . '" size= "1" maxlength="100" />
		<input name="quantityButton' . $product_id. '" type="submit" value="change" />
		<input name="adjustProductId" type="hidden" value="' . $product_id . '" />
		</form></td>';
		$cartOutput .= '<td>£' . $totalPrice . '</td>';
		$cartOutput.= '<td><form action = "cart.php" method = "post">
		<input name = "removeId' . $product_id . '" type = "submit" value = "X" />
		<input name="removedId" type="hidden" value="' . $i . '" />
		</form></td>';
		$cartOutput.= '</tr>';
		$i++;
	}
	$cartTotal = number_format($cartTotal, 2);
	$cartTotal = "Cart Total : £$cartTotal";
}
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

<div id="orderCart">
<table id="cart" width = "80%" border = "2" cellspacing = "1" cellpadding = "6">
	<tr>
		<td>Product</td>
		<td>Description</td>
		<td>Unit Price</td>
		<td>Quantity</td>
		<td>Total Price</td>
		<td>Remove</td>
	</tr>
	<?php echo $cartOutput; ?>	
</table>

<div id="empty">
 <form action = "cart.php?cmd=emptycart" method = "post" >
	<input name = "button" type = "submit" value = "Empty Cart" />
</form>
</div>

<div id="checkOut">
<form action = "checkOut.php" method = "post" >
	<input name = "checkout" type = "submit" value = "Proceed to Checkout" />
	<input name="totalPrice" type="hidden" value= "<?php echo $cartTotal ?>" />
</form>
</div>
</div>

<?php echo "<div align=' .right . '>$cartTotal</div>" ?>
<?php include('includes/foot.php'); ?>

</div>

</body>
</html>

