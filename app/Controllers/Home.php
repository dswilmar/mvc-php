<?php

class Home extends Controller
{
	public function index()
	{
		$userModel = $this->loadModel('User_model');
		$users = $userModel->getUsers();
		print_r($users);				
	}
}