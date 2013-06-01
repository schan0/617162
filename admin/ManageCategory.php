<?php
include 'cmsFunctions.php';
include 'navigation.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<body>
    <form action="ManageCategory.php" method="post">
        <input type="hidden" name="add" value="true" />   	
            <label for="category name">Category name:</label>
            <input type="text" name="categoryName" id="categoryName" />
        <input type="submit" name="submit" value="Add Category" />
    </form>        
</body>

<?php // allows categories to be added and removed
	if(isset($_POST['add'])){
		AddCategory($_POST);	
	}


if (isset($_GET['remove']))
{
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM category WHERE c_id='$remove'");
}

$result = queryMysql("SELECT * FROM category");
$num    = mysql_num_rows($result);

echo "<h3>All Categories</h3><ul>";

while($row = mysql_fetch_assoc($result)) {
	echo "Category Name:".$row['name']. 
		 " [<a href='ManageCategory.php?remove=".$row['c_id'] . "'>remove</a>]"."<br/>" ;	 
}
	
?>