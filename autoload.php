<?php

spl_autoload_register(function($filename) {
	if (file_exists('./app/Controllers/' . $filename . '.php')) {
		require './app/Controllers/' . $filename . '.php';
	} elseif (file_exists('./src/Models/' . $filename . '.php')) {
		require './app/Models/' . $filename . '.php';
	} elseif (file_exists('./src/Core/' . $filename . '.php')) {
		require './src/Core/' . $filename . '.php';
	}
});