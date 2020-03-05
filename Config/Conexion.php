<?php
namespace Config;
use Config\DataBase\Env;
use Config\System;
abstract class Conexion
{
    private $mysql   = 'mysql:host=';

    private $database = 'dbname=';
    
    protected $cone;
    
    protected $consul;
    
    public function __construct()
	{
		try {
			$this->connectDataBase();
		} catch (Exception $e) {
			die("Excepcion Capturada: " . $e->getMessage() . "\n");
		}
		
    }
    
    public function connectDataBase()
	{
		try {
			$this->cone = new \PDO($this->mysql . System::getDATABASE()['database']['SERVER'] .';'. $this->database . System::getDATABASE()['database']['DB'],System::getDATABASE()['database']['USER'],System::getDATABASE()['database']['PASS']);
		} catch (Exception $e) {	
			die("Excepcion Capturada: " . $e->getMessage() . "\n");
		}
	}

	abstract protected function consultQuery($query);
}

