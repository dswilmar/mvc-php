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
}