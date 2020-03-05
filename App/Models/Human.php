<?php
namespace App\Models;

use Core\PrepareQuery as Query;

class Human
{

	private $human = array();

	private $data = array();

	protected $type;

	protected $age;
	
	public function __set($name, $value)
	{
        $this->data[$name] = $value;
	}
	
	public function __get($name)
	{
        return $this->data[$name];
	}
	
	public function allHuman()
	{
		echo 'humans';
	}

	public function saveHuman()
	{
		print_r($this->type);
		echo "\n";
		print_r($this->age);
	}
}