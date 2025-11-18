<?php

if(!function_exists('validar_sesion')){
	function validar_sesion() {
	 	$ss=session();
		if ($ss->get('logueado')==false) {
			$link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$ss=session();
			$ss->urlRedirect=$link;
			//$escaped_link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
			header("Location: ".base_url("/usuario/login"));
			exit();
		}
	}
}
