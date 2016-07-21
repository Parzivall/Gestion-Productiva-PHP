<?php

	require_once 'Models/UsuarioModel.php';
	$session = new Usuario();

	
	// Si la sesion de usuario no esta activa(not loggedin) esta pagina ayudara a  'vistas*.php' a redirigir a la pagina de login
	// Poner este archivod entro de paginas seguras que usuarios (Usuarios no puedan acceder sin login)

	if(!$session->isLoggedIn())
	{
		//printf("Sesion no establecida");
		//printf("Sesion:".$_SESSION['UserSession']);
		// sesion no establecida, redirigir a la pagina de login
		header('Location:'.BASE_URL.'Usuarios');
		//$session->redirect('Usuario/');
	}
	/*else
	{
		header('Location:'.BASE_URL.'Alumno');
	}*/
?>