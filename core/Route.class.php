<?php

class Route {

	private $path;
	private $callable;
	private $matches = [];
	private $params = [];

	public function __construct($path, $callable) {
		$this->path = trim($path, '/');
		$this->callable = $callable;
	}

	//Verification de la route
	public function match($url) {
		$url = trim($url, '/');
		//remplace la première expression regulière par la deuxième si elle existe
		$path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);

		$regex = "#^".$path."$#i";

		if (!preg_match($regex, $url, $matches)) {
			return false;
		}

		//enlève le premier élément du tableau
		array_shift($matches);
		$this->matches = $matches;
		return true;
	}

	//retourne l'expression regulière defini dans la route
	private function paramMatch($match) {
		if ( isset($this->params[ $match[1] ]) ) {
			return '('.$this->params[$match[1]].')';
		}

		return '([^/]+)';
	}

	/*
	Permet d'enchainer les fonctions
	*/
	public function with($param, $regex) {
		$this->params[$param] = str_replace('(', '(?:', $regex);
		return $this;
	}

	//Appel le controller, la method et envoie les paramètres.
	public function call() {
		$pathParam = explode('@', $this->callable);

		$controller = $pathParam[0].'Controller';

		if (!class_exists($controller)) {
			throw new Exception("Error Processing Request", 1);
		}

		$obj = new $controller();
		
		if ( !in_array($pathParam[1], get_class_methods($obj))) {
			throw new Exception("Error Processing Request", 1);
		}

		return call_user_func_array([$obj, $pathParam[1]], $this->matches);
	}

	public function getUrl($params) {
		$path = $this->path;

		foreach($params as $k => $v) {
			$path = str_replace(":$k", $v, $path);
		}

		return $path;
	}

}
