<?php	//connects the page to the database
	$dbhost  = 'localhost';    // server host name of the database
	$dbname  = 'WSCoursework';       // database name
	$dbuser  = 'root';   // database username
	$dbpass  = '';   // database password 

	mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());
?>