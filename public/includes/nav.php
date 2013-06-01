<?php

$sql="SELECT * FROM category";
$result=mysql_query($sql);

$options="";

while ($row=mysql_fetch_array($result)) { //loops through the categories table to display as the navigation
	$categoryName=$row["name"];
	$options.="<li><a href='/617162/public/categoryPage.php?c_id=".$row['c_id'] ."'>$categoryName</a></li>\r\n		";
} 
?>

<nav id="leftnav">
	<ul>
		<li><a href="/617162/public/index.php">Home</a></li>
		<?php echo $options ?>
		<li><a href="/617162/public/cart.php">My Shopping Cart</a></li>
	</ul>
</nav>
