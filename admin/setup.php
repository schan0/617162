<html><head><title>Setting up database</title></head><body>

<h3>Setting up...</h3>

<?php
	$dbhost  = 'localhost';    // server host name of the database
	$dbname  = 'WScoursework';       // database name
	$dbuser  = 'root';   // database username
	$dbpass  = '';   // database password 

mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

$result = mysql_query("CREATE TABLE IF NOT EXISTS Products(p_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								c_id INT(11) UNSIGNED NOT NULL,
								productName VARCHAR(255) NOT NULL,
								description TEXT NOT NULL,
								price VARCHAR(16),
								quantity INT(255),
								dateAdded date NOT NULL,
								UNIQUE KEY productName(productName),
								PRIMARY KEY (p_id))") or die(mysql_error());


$result = mysql_query("CREATE TABLE IF NOT EXISTS category(c_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
									name VARCHAR(255) NOT NULL,
									PRIMARY KEY(c_id),
									UNIQUE KEY name(name))") or die(mysql_error());
			
$result = mysql_query("CREATE TABLE IF NOT EXISTS customer(customer_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								fName VARCHAR(255) NOT NULL,
								lName VARCHAR(255) NOT NULL,
								homeAddress VARCHAR(255) NOT NULL,
								homeCity VARCHAR(255) NOT NULL,
								postCode VARCHAR(8) NOT NULL,
								contactNumber VARCHAR(255) NOT NULL,
								cardNumber VARCHAR(255) NOT NULL,
								dateAdded date NOT NULL,
								PRIMARY KEY(customer_id))") or die(mysql_error());

$result = mysql_query("CREATE TABLE IF NOT EXISTS customerOrder(o_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
								p_id INT(11) UNSIGNED NOT NULL,
								customer_id INT(11) UNSIGNED NOT NULL,
								quantity INT(255),
								totalPrice VARCHAR (16),
								dateAdded date NOT NULL,
								PRIMARY KEY(o_id))") or die(mysql_error());								
			

$result = mysql_query("ALTER TABLE products
			ADD FOREIGN KEY (c_id)
			REFERENCES category (c_id)") or die(mysql_error());
					
?>

<br />...done.
</body></html>