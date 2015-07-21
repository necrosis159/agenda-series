<?php
class Routing{

	private static $routes = [];
	private static $namedRoutes = [];

	//Regroupement des routes dans les methodes GET et POST dans la fonction add
	public static function get($path, $callable) {
		return self::add('GET', $path, $callable);
	}

	public static function post($path, $callable) {
		return self::add('POST', $path, $callable);
	}

	//on enregistre la routes et le noms de la routes dans leur tableau correspondant
	private static function add($method, $path, $callable) {
		$route = new Route($path, $callable);
		self::$routes[$method][] = $route;

		$name = str_replace('@', '.', strtolower($callable));
		self::$namedRoutes[$name] = $route;

		return $route;
	}

	//Si l'url existe on appelle call() sinon exception
	public static function parse($url) {
		$method = $_SERVER['REQUEST_METHOD'];
		// die(var_dump($method));

		if ( !isset(self::$routes[$method]) ) {
			throw new Exception('No routes with this request method');
		}

		foreach (self::$routes[$method] as $route) {

			if ($route->match($url)) {
				return $route->call();
			}
		}
//		throw new Exception('No routes found');
	}

	/*	Générateur d'url
	Exemple (sans paramètre): Routing::url('user.index'); => /user
	Exemple (avec paramètre): Routing::url('user.show', ['id' => 1, 'name' => 'dupont']); => /user/1-dupont
	*/
	public static function url($name, $params = []) {
		if (!isset(self::$namedRoutes[$name])) {
			throw new RouterException('No route matches this name');
		}

		return '/'.self::$namedRoutes[$name]->getUrl($params);
	}

}
