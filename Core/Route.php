<?php
namespace Core;

class Route
{
	public static function routeController($controller, $method, $request = null, $id = null)
	{
		try {
			return self::routeConstruction($controller, $method, $request, $id);
		} catch (Exception $e) {
			die('Excepción capturada: '.$e->getMessage()."\n");
		}
	}

	private static function routeConstruction($class,$method,$request = null, $id = null)
	{
		try {
			self::requestOfView($class);
			$instantiatedClass = new $class;
			call_user_func_array([$instantiatedClass,$method],[$request,$id]); 
		} catch (Exception $e) {
			die('Excepción capturada: '.$e->getMessage()."\n");
		}
	}

	private static function requestOfView($url)
	{
		return require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Controllers/' . $url . '.php');	
	}
}