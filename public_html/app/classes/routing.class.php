<?php
	
	class routing
	{
		public $routeList;

		function __construct()
		{
			$config = new configData();
			$mysqli = new mysqli($config->mServer, $config->mUser, $config->mPassword, $config->mBase);
			$sql = "SELECT * FROM `routes` WHERE `access` > 0";
			if ($result = $mysqli->query($sql)) {
			    while ($row = $result->fetch_assoc()) {
				    $this->routeList[$row['route']]['controller'] = $row['controller'];
				    $this->routeList[$row['route']]['view'] = $row['view'];
				}
			}
			$mysqli->close(); 
		}




		public function selectController($route)
		{
		    $inc = 0;
		    if(isset($this->routeList[$route])){
		    	if(include 'app/controller/'.$this->routeList[$route]['controller'].'.controller.php'){ 
		    		$inc = 1;
			    	if($this->routeList[$route]['view']){
			    		if(!include 'app/view/'.$this->routeList[$route]['controller'].'.view.php'){$inc = 0;}
			    	}
		    	}
		    }

		    if(!$inc){
		    	include_once('app/controller/notfound.controller.php');
		    	include_once('app/view/notfound.view.php');
		    }

		}
		    
	}