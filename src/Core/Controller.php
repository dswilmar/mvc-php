<?php

/**
 * Classe Controller
 */
class Controller
{
	public $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function loadView($view, $data = array())
	{
		extract($data);
		require './app/Views/' . $view . '.php';
	}

	public function loadModel($model)
	{
		if (file_exists('./app/Models/' . $model . '.php')) {			
			require_once('./app/Models/' . $model . '.php');
			$m = new $model();
			return $m;		
		}
	}
}