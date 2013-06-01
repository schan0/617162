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
<?php //provides link for all products to be editted or removed from the database

if (isset($_GET['remove']))
{
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM products WHERE p_id='$remove'");
}

$result = queryMysql("SELECT * FROM products");
$num    = mysql_num_rows($result);

echo "<h3>All products</h3><ul>";

while($row = mysql_fetch_assoc($result)) {
	echo "ID: ".$row['p_id'].", Product Name:".$row['productName'].
		 ", Price:".$row['price']." Quantity:".$row['quantity'].
		 " [<a href='EditProduct.php?p_id=".$row['p_id'] . "'>edit</a>]" . 
		 " [<a href='ManageProduct.php?remove=".$row['p_id'] . "'>remove</a>]"."<br/>" ;	 
}
	
?>
</body>
</html>