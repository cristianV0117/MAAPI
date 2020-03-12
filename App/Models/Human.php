<?php
namespace App\Models;
use Core\Query;

abstract class Human extends Query
{
	private $DB;

	private $data = array();

	protected $type;

	protected $age;

	public function __construct()
	{
		$this->DB = new Query();
	}
	
	public function __set($name, $value)
	{
        $this->data[$name] = $value;
	}
	
	public function __get($name)
	{
        return $this->data[$name];
	}
	
	protected function allHuman()
	{
		$this->DB->table('humans')->select('*')->get();
	} 

	protected function saveHuman()
	{
		$this->DB->table('humans')->insert([
				'tipo'  => $this->type,
				'edad'  => $this->age
			]
		)->save();
	}
}