<?php
//namespace App\Controllers;
use App\Models\Human;
class HumanController extends Human
{
	public function index()
	{
		echo 'HUMAN!';
	}

	public function store()
	{
		echo 'HUMAN SOTORE!!';
	}
}