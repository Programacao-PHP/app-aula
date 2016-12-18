<?php
    include_once('config.inc.php');
	session_start(); 	// acede à sessão existente.

	if (!isset($_SESSION['user_id'])) {	// a sessão não existe

		header("Location: index.php");	// redireciona para o ficheiro inbdex.php
		exit();

	} else { // a sessão existe, logo vai ser eliminada.

		/*
		 * Não deve atribuir o valor NULL à $_SESSION.
		*/

		$_SESSION = array();	// limpa as variáveis de sessão

		session_destroy();		// destrói a  sessão

		setcookie('PHPSESSID', '', time() - 3600, '/', '', 0, 0);	// apaga o cookie
        
        header("Location: index.php");
	}

?>
