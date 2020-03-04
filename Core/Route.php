<?php
namespace Core;
use Core\Env;

class Route implements Env
{
	public static function routeController($controller, $method)
	{
		try {
			return self::routeConstruction($controller, $method, null);
		} catch (Exception $e) {
			die('Excepción capturada: '.$e->getMessage()."\n");
		}
	}

	private static function routeConstruction($class,$method,$get)
	{
		try {
			self::requestOfView($class);
			$instantiatedClass = new $class;
			call_user_func_array([$instantiatedClass,$method],[$get]); 
		} catch (Exception $e) {
			die('Excepción capturada: '.$e->getMessage()."\n");
		}
	}

	private static function requestOfView($url)
	{
		return require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Controllers/' . $url . '.php');	
	}
}