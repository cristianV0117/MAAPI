<?php

use App\Models\Human;

use App\Interfaces\HumanRequestInterface;

use Core\Response;

class HumanController extends Human implements HumanRequestInterface
{
	use Core\Ext;
	
	public function index()
	{
		Response::responseData(self::statusCode($this->allHuman(), 200));
	}

	public function store($request)
	{
		$post = self::JSONdecode($request);
		$this->type = $post['tipo'];
		$this->age  = $post['edad'];
		Response::responseData(self::statusCode($this->saveHuman(), 201));
	}

	public function update($request, $id)
	{
		$post = self::JSONdecode($request);
		$this->id 	= $id;
		$this->type = $post['tipo'];
		$this->age  = $post['edad'];
		Response::responseData(self::statusCode($this->editHuman(), 200));
	}

	public function destory($request)
	{
		$this->id = $request;
		Response::responseData(self::statusCode($this->deleteHuman(), 200));
	}

	public function humanReuqestValidation()
	{
		
	}
}