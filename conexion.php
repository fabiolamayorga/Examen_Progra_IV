<?php

	$servidor = "localhost";
	$usuario = "root";
	$clave = "";
	$basedatos = "Campeonato";
	$conexion = mysql_connect($servidor, $usuario,$clave);
	if (!$conexion)
	{
		die('No se pudo conectar');
	}
	mysql_select_db($basedatos);
?>

