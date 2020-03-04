<?php
namespace Routes;
use Core\Route;
use Config\System;
use Core\Response;
$app = new \Slim\Slim();

// GET ROUTES //
$app->get('/', function (){
	echo 'INDEX';
});
$app->get('/human', function () {
    Route::routeController('HumanController', 'index');
});
// POST ROUTES //
$app->post('/human/store', function () {
	authenticate();
    Route::routeController('HumanController', 'store');
});

// START APP //
$app->run();



// VALIDATOR KEY //

function authenticate()
{
	$app = \Slim\Slim::getInstance();
	$headers = apache_request_headers();
	if (isset($headers['Authorization'])) {
		$token = $headers['Authorization'];
		if (!($token == System::getApyKey())) {
			Response::responseData('Acceso denegado. Token invalido', 401);
			$app->stop();
		}
	} else {
		Response::responseData('Falta token de autorizacion', 400);
		$app->stop();
	}	
}