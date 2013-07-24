<?php 
	// This file contains the connection details on how the Database is connected to and accessed. 
	require("constants.php");
	// 1. Create a Database connection
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	if(!$connection){
		die("Database connection failed:" . mysql_error());
		
		}
	// 2. Select a database to use
	$db_select = mysql_select_db(DB_NAME, $connection);
	if(!$db_select){
		die("Database selection failed:" . mysql_error());
		}
?>