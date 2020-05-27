<?php
namespace App\Models;
use Core\Query;

abstract class Human
{
	private $DB;

	private $data = array();

	protected $id;

	protected $name;

	protected $type;

	protected $age;

	public function __construct()
	{
		$this->DB = new Query;
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
		return $this->DB->table('humans')->join([
			["animals", "animals.human_id", "=", "humans.id"],
			["insects", "insects.human_id", "=", "humans.id"]
		])->select('animals.nombre, insects.nombre as nombre_insects ')->get();
	}

	protected function saveHuman()
	{
		return $this->DB->table('humans')->insert([
			'nombre'=> $this->name,
			'tipo'  => $this->type,
			'edad'  => $this->age
		])->save();
	}

	protected function editHuman()
	{
		return $this->DB->table('humans')->where('id', '=' , $this->id)->update([
			'nombre'=> $this->name,
			'tipo'  => $this->type,
			'edad'  => $this->age
		])->save();
	}
	
	protected function deleteHuman()
	{
		return $this->DB->table('humans')->where('id', '=', $this->id)->delete()->save();
	}
}