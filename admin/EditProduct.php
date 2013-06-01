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
<?php // allows product to be editted through a form
		$id = mysql_real_escape_string($_REQUEST['p_id']);
		$sql = "SELECT * FROM products WHERE p_id = '$id'";		
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
?>

     <form action="EditProduct.php" enctype="multipart/form-data" method="post" >
        
         <input type="hidden" name="update" value="true" />
         <input type="hidden" name="p_id" value="<?=$row['p_id']?>">
         <div>
             <label for="product name">Product name:</label>
             <input type="text" name="productName" id="productName" value="<?=$row['productName']?>" />
         </div>
		 
         <div>
             <label for="description">Description:</label>
             <textarea name="description" id="description" rows="8" cols="40"><?=$row['description']?></textarea>
         </div>
         <div>
             <label for="price">Price:</label>
             <input type="text" name="price" id="price" size="8" value="<?=$row['price']?>" />
         </div>         
         <div>
             <label for="quantity">Quantity:</label>
             <input type="text" name="quantity" id="quantity" size="4" value="<?=$row['quantity']?>" />
         </div> 
		 
		<?php
		$sql="SELECT name, c_id FROM category";
		$result=mysql_query($sql);

		$options="";

		while ($row=mysql_fetch_array($result)) {
			$categoryName=$row["name"];
			$c_id=$row["c_id"];
			$options.="<OPTION VALUE=$c_id>$categoryName</OPTION>";
		} 
		?>
		
		<div>
			<label for="category">Category:</label>
			<SELECT name="categoryId" id="categoryId" value="<?php echo $categoryName; ?>">
			<?php echo $options ?>
			</SELECT>
		</div>
		
		<div>
			Select Image: <input type='file' name='replaceImage' size='10' />
        </div>
		
             <input type="submit" name="submit" value="Update Product" />     
     </form>
	 
<?php	
	if(isset($_POST['p_id'])){
		UpdateProduct($_POST);	
	}
?>
</body>
		
</html>