<?php 
	session_start();
	// connect to database
	$conn = mysqli_connect("localhost", "lina", "linaRebeca1", "onlinerentalsdb");
// checking if the database is connected or not
	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
    // define global constants
	// enable access to your machine directory operating system
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	// access to your project url name
	define('BASE_URL', 'http://localhost/onlinerentals/');
	
?>