<?php
include 'cmsFunctions.php';
include 'navigation.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Allows products to be added to the database via a form</title>
</head>

<body>
    <form action="AddProduct.php" enctype="multipart/form-data" method="post" >
        <input type="hidden" name="add" value="true" />
      	<div>
            <label for="product name">Product name:</label>
            <input type="text" name="productName" id="productName" />
        </div>
		
		<?php 
		$sql="SELECT name, c_id FROM category";
		$result=mysql_query($sql);

		$options="";

		while ($row=mysql_fetch_array($result)) {
			$categoryName=$row["name"];
			$c_id=$row["c_id"];
			$options.="<OPTION VALUE=$c_id>$categoryName</option>";
		} 
		?>
		
		<div>
		<SELECT name="categoryId" id="categoryId">
		<?php echo $options ?>
		</SELECT>
		</div>
		
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="Description" rows="8" cols="40"></textarea>
        </div>
		
        <div>
            <label for="price">Price:</label>
            <input type="text" name="price" id="Price" size="8" />
        </div>		

        <div>
            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" id="Quantity" size="4" />
        </div>
		 
		 <div>
			Select Image: <input type='file' name='fileImage' size='10' />
         </div>
		
        <input type="submit" name="submit" value="Add Product" />
    </form>
	
<?php
if(isset($_POST['add'])){
	CheckProduct($_POST);
}	
?>

</body>
		
</html>