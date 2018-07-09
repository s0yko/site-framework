<?php 

	include_once('app/construct.php');	
	$semantic = new semanticURL();	
	$routing = new routing();


    if(!isset($semantic->load_pages[1]) || $semantic->load_pages[1] == '') {header("Location: /main"); exit;}		
	$routing->selectController($semantic->load_pages);

?>