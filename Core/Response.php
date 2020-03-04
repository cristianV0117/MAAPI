<?php
namespace Core;

class Response
{
    public static function responseData($message, $statusCode)
    {
        try {
            $app = \Slim\Slim::getInstance();
            $response = array();
            $response["error"] = true;
            $response["message"] = $message;
            self::echoResponse($statusCode, $response);
        } catch (Exception $e) {
            die('Excepción capturada: '.$e->getMessage()."\n");
        }
    }

    public static function echoResponse($statusCode, $response)
    {
        try {
            $app = \Slim\Slim::getInstance();
            $app->status($statusCode);
            $app->contentType('application/json');
            echo json_encode($response);
        } catch (Exception $e) {
            die('Excepción capturada: '.$e->getMessage()."\n");
        }
    }
}