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
$app->get('/humans', function () {
    Route::routeController('HumanController', 'index');
});
// POST ROUTES //
$app->post('/humans', function () use ($app) {
	authenticate();
    Route::routeController('HumanController', 'store', $app->request()->getBody());
});
// DELETE ROUTES //
$app->delete('/humans/:id', function ($id){
	authenticate();
	Route::routeController('HumanController', 'destory', $id);
});
// UPDATE ROUTES //

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
			Response::responseData(array('message' => 'Acceso denegado. Token invalido', 'status' => 401));
			$app->stop();
		}
	} else {
		Response::responseData(array('message' => 'Falta token de autorizacion', 'status' => 400));
		$app->stop();
	}	
}