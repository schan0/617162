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

<?php include('includes/nav.php'); ?>

<?php
$query="SELECT * FROM products WHERE c_id=". $_GET['c_id'];
$result=mysql_query($query);

$num=mysql_numrows($result);
?>

<div id="productDisplay">
<table border="1" cellspacing="2" cellpadding="2">
	<tr align="center">
		<td>Product ID</td>
		<td>Product Name</td>
		<td>Description</td>
		<td>Price</td>
		<td>Quantity</td>
	</tr>

<?php //uses a while loop to display products of a category from an SQL statement.
$i=0;
while ($i < $num) {

$id=mysql_result($result,$i,"p_id");
$productName=mysql_result($result,$i,"productName");
$description=mysql_result($result,$i,"description");
$price=mysql_result($result,$i,"price");
$quantity=mysql_result($result,$i,"quantity");

echo "<tr align='center'>\r\n";
echo "	<td>$id</td>\r\n";
echo "	<td><a href='/617162/public/product.php?p_id=$id'>$productName</a></td>\r\n";
echo "	<td>$description</td>\r\n";
echo "	<td>$price</td>\r\n";
echo "	<td>$quantity</td>\r\n";
echo "</tr>\r\n";

$i++;
}

?>
</table>
</div>

<?php include('includes/foot.php'); ?>
</div>
</body>

</html>
