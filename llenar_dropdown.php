<?php
	$partidos = new Partidos;
	try{
		$partidos = new Partidos;
		$resultado_llenar = $partidos->llenar_select($conexion);
	}catch (Exception $e){
		$mensaje = $e->GetMessage();
	}
?>