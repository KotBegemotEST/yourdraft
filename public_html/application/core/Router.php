<?php 
namespace public_html\application\core;// для автозагрузки классов
class Router
{
	protected $routes = [];
	protected $params = [];

	public function __construct(){
		$arr = require 'public_html/application/config/routes.php';
		foreach ($arr as $key => $value) {
			$this->add($key, $value);
		}
		
	}
	public function add($route, $params){
		$route = "#^".$route."$#";
		$this->routes[$route] = $params;
	}

	public function match(){
		$url = trim($_SERVER['REQUEST_URI'],"/");
		foreach ($this->routes as $route => $params) {
			if (preg_match($route, $url, $matches)) {
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	public function run(){
		if ($this->match()) {
			$controller ='public_html\application\controllers\\'.ucfirst($this->params["controller"])."Controller.php";//ucfirst - первый символ строки с бьольшой буквы
			if (class_exists($controller)) {
				echo "OK";
			}else{
				echo "не найден: ".$controller;
			}
			//echo "<p> controller: <b>" .$this->params['controller']." </b> </p>";
			//echo "<p> action: <b>" .$this->params['action']." </b> </p>";
		}else{
			echo"Нет маршрута";
		}
	}



}