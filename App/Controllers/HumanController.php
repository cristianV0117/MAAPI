<?php

use App\Models\Human;

use App\Interfaces\HumanRequestInterface;

use Core\Response;

class HumanController extends Human implements HumanRequestInterface
{
	use Core\Ext;
	
	public function index()
	{
		Response::responseData($this->allHuman());
	}

	public function store($request)
	{
		$post = self::JSONdecode($request);
		$this->type = $post['tipo'];
		$this->age  = $post['edad'];
		Response::responseData($this->saveHuman());
	}

	public function destory($request)
	{
		$this->id = $request;
		Response::responseData($this->deleteHuman());
	}

	public function humanReuqestValidation()
	{
		
	}
}