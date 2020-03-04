<?php
namespace App\Models;
class Human
{

	private $data = array();

	protected $type;

	protected $age;
	
	public function __set($name, $value){
        $this->data[$name] = $value;
	}
	
	public function __get($name){
        return $this->data[$name];
    }

	public function saveHuman()
	{
		print_r($this->type);
		print_r($this->age);
	}
}