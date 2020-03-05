<?php
use App\Models\Human;
class HumanController extends Human
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
}