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
				    $this->routeList[$row['level']][$row['id']]['controller'] = $row['controller'];
				    $this->routeList[$row['level']][$row['id']]['view'] = $row['view'];
				    $this->routeList[$row['level']][$row['id']]['parent'] = $row['parent'];
				    $this->routeList[$row['level']][$row['id']]['route'] = $row['route'];
				    $this->routeList[$row['level']][$row['id']]['access'] = $row['access'];
				}
			}
			$mysqli->close(); 
		}




		public function selectController($routes)
		{
			$level = count($routes);
			$parent = 0;
			for ($i=1; $i < $level; $i++) { 
				$route = $routes[$i];					
	    		$inc = 0;
	    		foreach ($this->routeList[$i] as $routeID => $routeElem) {
		    		if($routeElem['route'] == $route && $routeElem['parent'] == $parent){
					   	if(@include 'app/controller/'.$routeElem['controller'].'.controller.php'){ 
					   		$parent = $routeID;
					   		$inc = 1;
					    	if($routeElem['view'] && ($level-$i) == 1){
					    		if(!@include 'app/view/'.$routeElem['controller'].'.view.php'){$inc = 0;}
						    	break;
						    }
					    }	
					    break;
		    		}
		    	}

				if(!$inc){
				   	include_once('app/controller/notfound.controller.php');
				   	include_once('app/view/notfound.view.php');
				   	break;
				}
			}	    

		}

		public function secondLevel($route)
		{
			# code...
		}
		    
	}