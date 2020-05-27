<?php

use App\Models\Human;

use App\Interfaces\HumanRequestInterface;

use Core\Response;

class HumanController extends Human implements HumanRequestInterface
{
	use Core\Ext;
	use Core\Validations;
	
	public function index()
	{
		return Response::responseData(self::statusCode($this->allHuman(), 200));
	}

	public function store($request)
	{
		$post = $this->humanReuqestValidation(self::JSONdecode($request));
		$this->type = $post['tipo'];
		$this->age  = $post['edad'];
		return Response::responseData(self::statusCode($this->saveHuman(), 201));
	}

	public function update($request, $id)
	{
		$post = self::JSONdecode($request);
		$this->id 	= $id;
		$this->type = $post['tipo'];
		$this->age  = $post['edad'];
		return Response::responseData(self::statusCode($this->editHuman(), 200));
	}

	public function destory($request)
	{
		$this->id = $request;
		return Response::responseData(self::statusCode($this->deleteHuman(), 200));
	}

	public function humanReuqestValidation($request)
	{
		if (self::ifThereIsData($request, array('tipo' => null, 'edad' => null)) == 1) {
			return $request;
		} else {
			$this->noDataInRequestValidation();
		}
	}

	public function noDataInRequestValidation()
	{
		return Response::responseData(self::statusCode(array('error' => true, 'message' => 'Faltan datos'), 401));
	}

}