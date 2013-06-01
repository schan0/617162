<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

	$dbhost  = 'localhost';    
	$dbname  = 'WSCoursework';       
	$dbuser  = 'root';   
	$dbpass  = '';    

	mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());
	
	
	function queryMysql($query) {
    	$result = mysql_query($query) or die(mysql_error());
	 		return $result;
	}
	
	function CheckProduct() {
	
	$productName = mysql_real_escape_string($_POST['productName']);
	$description = mysql_real_escape_string($_POST['description']);
	$price = mysql_real_escape_string($_POST['price']);
	$quantity = mysql_real_escape_string($_POST['quantity']);
			
	if(!$productName || !$description || !$price || !$quantity):
		if(!$productName):
			echo "<p>A Product Name is Required</p>";
		endif;
		if(!$description):
			echo "<p>A Product Description is Required</p>";
		endif;	
	
		if(!$price):
			echo "<p>A Product Price is Required</p>";
		endif;	
	
		if(!$quantity):
			echo "<p>A Product Quantity is Required</p>";
		endif;
		
		echo '<p><a href="AddProduct.php">Try Again!</a></p>';
		
	else:
		$categoryName = ($_POST['categoryId']);
		$sql = "INSERT INTO products VALUES (null, $categoryName, '$productName', '$description', '$price', '$quantity', now())";
		$res	= mysql_query($sql) or die(mysql_error());
		$p_id = mysql_insert_id();
		echo "Product name, description, price and quantity was added was successfully!";
		
		$name = $_FILES['fileImage']['name'];
		
			switch($_FILES['fileImage']['type']) {
		
				case 'image/jpeg' : $type = 'jpg'; break;
				case 'image/gif' : $type = 'gif'; break;
				case 'image/png' : $type = 'png'; break;
				case 'image/tiff' : $type = 'tiff'; break;
				default: $type = ''; break;
			}
			if ($type) {
				$fileLocation	= "../admin/ProductImages/$p_id.$type";
				move_uploaded_file($_FILES['fileImage']['tmp_name'], $fileLocation);
				echo "Uploaded image '$name' as '$fileLocation' :<br/>";
				echo "<img src='$fileLocation' />";
			}
			else echo " <p>No image has been uploaded because '$name' is not a valid image file type or no image was selected.</p>";
	endif;
	
	}
	
	function UpdateProduct() {
	$p_id = mysql_real_escape_string($_POST['p_id']);	
	$productName = mysql_real_escape_string($_POST['productName']);
	$description = mysql_real_escape_string($_POST['description']);
	$price = mysql_real_escape_string($_POST['price']);
	$quantity = mysql_real_escape_string($_POST['quantity']);
	
		
	if(!$productName || !$description || !$price || !$quantity):
		if(!$productName):
			echo "<p>A Product Name is Required</p>";
		endif;
		if(!$description):
			echo "<p>A Product Description is Required</p>";
		endif;
		if(!$price):
			echo "<p>A Price is Required</p>";
		endif;			
		if(!$quantity):
			echo "<p>A Quantity is Required</p>";
		endif;
					
		echo '<p><a href="EditProduct.php?id=' . $p_id . '">Try Again!</a></p>';
	else:
		$sql = "UPDATE products SET productName = '$productName', description = '$description', price = '$price', quantity = '$quantity' WHERE p_id = '$p_id'";
		$res = mysql_query($sql) or die(mysql_error());
		echo "Product name, description, price and quantity has been updated was successfully";
		
		$name = $_FILES['replaceImage']['name'];
		
			switch($_FILES['replaceImage']['type']) {
		
				case 'image/jpeg' : $type = 'jpg'; break;
				case 'image/gif' : $type = 'gif'; break;
				case 'image/png' : $type = 'png'; break;
				case 'image/tiff' : $type = 'tiff'; break;
				default: $type = ''; break;
			}
			if ($type) {
				$fileLocation	= "../admin/ProductImages/$p_id.$type";
				$path = "../admin/ProductImages/";
				$imageResult = glob($path . $p_id . ".*" );
				unlink($imageResult[0]); 
				move_uploaded_file($_FILES['replaceImage']['tmp_name'], $fileLocation);
				echo "Uploaded image '$name' as '$fileLocation' :<br/>";
				echo "<img src='$fileLocation' />";
			}
			else echo " <p>No image has been uploaded because '$name' is not a valid image file type or no image was selected.</p>";		
	endif;
	}
	
	function AddCategory() {
	$name = mysql_real_escape_string($_POST['categoryName']);
			
	if(!$name):
		if(!$name):
			echo "<p>A Category Name is Required</p>";
		endif;	
							
		echo '<p><a href="AddCategory.php">Try Again!</a></p>';
	else:
		$sql = "INSERT INTO category VALUES (null, '$name')";
		$res = mysql_query($sql) or die(mysql_error());
		echo "Category was successfully added";
	endif;
	}
	
	function sanitizeString($var) {
    	$var = strip_tags($var);
    	$var = htmlentities($var);
   	 	$var = stripslashes($var);
    	return mysql_real_escape_string($var);
	}

?>
</body>
</html>