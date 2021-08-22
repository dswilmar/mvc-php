<?php

/**
 * Classe principal da aplicação
 */
class App
{

	public function __construct()
	{
		$this->run();
	}

	public function run()
	{
		if (isset($_GET['url'])) {
			
			//quebrando a URL passada pela "/"
			$url = explode('/', $_GET['url']);

			//atribuindo a primeira posicao da URL como controller
			$controller = $url[0];
			array_shift($url);

			//verificando se possui mais alguma coisa na URL
			//caso sim, atribui ao metodo
			if (isset($url[0]) && !empty($url[0])) {
				$method = $url[0];
				array_shift($url);
			} else {
				$method = 'index';
			}

			//possui mais algum item na URL
			//caso sim, atribui aos parametros
			if (count($url) > 0) {
				$params = $url;
			}

		} else {
			$controller = 'home';
		}
	}
}