<?php
namespace Core;
use Core\Env;

class Route implements Env
{
	public static function routeController($controller, $method, $request = null)
	{
		try {
			return self::routeConstruction($controller, $method, $request);
		} catch (Exception $e) {
			die('Excepción capturada: '.$e->getMessage()."\n");
		}
	}

	private static function routeConstruction($class,$method,$request = null)
	{
		try {
			self::requestOfView($class);
			$instantiatedClass = new $class;
			call_user_func_array([$instantiatedClass,$method],[$request]); 
		} catch (Exception $e) {
			die('Excepción capturada: '.$e->getMessage()."\n");
		}
	}

	private static function requestOfView($url)
	{
		return require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Controllers/' . $url . '.php');	
	}
}