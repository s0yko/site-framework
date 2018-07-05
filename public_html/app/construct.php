<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);	
	
	spl_autoload_register(function ($name) {
   	 include('classes/'.$name .'.class.php');  	  
	});

	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}



?>