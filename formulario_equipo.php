<?php
	$mensaje = "";
	$partidos = "";
	$resultado = "";
	require_once("Conexion.php");
	include_once("Partidos.php");
	if ((isset($_POST['codigo_equipo']))){
		if ((trim($_POST['codigo_equipo']) == "")){
			$mensaje = "El c&oacute;digo no puede ir en blanco";
		}else{
			$codigo_equipo = $_POST['codigo_equipo'];
			try{
				$partidos = new Partidos;

				$resultado = $partidos->ver_informacion($codigo_equipo,$conexion);
				//echo $partidos->$nombre_equipo;
			}catch(Exception $e){
				$mensaje = $e->GetMessage();

  			}
		}
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Formulario Modificar</title>
</head>

<body>
	<form action="" method="POST">
		<table align="center">
			<tr>
				<td>Ingresar Codigo Equipo</td>
				<td><input type="text" name="codigo_equipo"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Ver Equipo" width="100" height="100" />
			</tr>
			<td colspan="2" align="center"><span class="Mensaje" id="Mensaje"><?php echo $mensaje?></span></td>

		</table>




	</form>
	<?php
		echo $resultado;
	?>
</body>