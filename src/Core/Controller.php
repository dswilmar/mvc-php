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

	public function loadTemplate($template, $data = array())
	{
		$this->data = $data;
		require './app/Views/template.php';
	}

	public function loadView($view, $data = array())
	{
		extract($data);
		require './app/Views/' . $view . '.php';
	}
}