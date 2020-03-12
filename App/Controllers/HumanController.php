<?php

use App\Models\Human;

use App\Interfaces\HumanRequestInterface;

class HumanController extends Human implements HumanRequestInterface
{
	use Core\Ext;
	
	public function index()
	{
		$this->allHuman();
	}

	public function store($request)
	{
		$post = self::JSONdecode($request);
		$this->type = $post['tipo'];
		$this->age  = $post['edad'];
		$this->saveHuman();
	}

	public function humanReuqestValidation()
	{
		
	}
}