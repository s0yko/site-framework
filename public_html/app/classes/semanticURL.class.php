<?php
	

	class semanticURL
		{
			
			public $cleanURL = ''; 
			public $load_pages = '';

		    public function __construct()
		    {
		    	$this->URL = $_SERVER['REQUEST_URI'];
		    	$temp_url = explode("?", $this->URL);
		    	$url = $temp_url[0];
		    	if(($url[strlen($url)-1]) == '/')
			        {
			          $url = substr($url, 0, strlen($url)-1);
			        }
		    	global $load_pages;
		    	$this->cleanURL = $url;
		    	$this->load_pages = explode("/", $url);

		    }


		}
?>