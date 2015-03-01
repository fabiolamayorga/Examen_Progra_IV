<?php 
$mensaje = "";  
  require_once("conexion.php");
  include_once("Partidos.php");
  include_once("llenar_dropdown.php");
  if ((isset($_POST['jornada'],$_POST['equipo_local'],$_POST['equipo_visita'], $_POST['goles_local'], $_POST['goles_visita'],$_POST['fecha_partido'], $_POST['hora_partido'])))
  {
	  if ((trim($_POST['jornada']) == "") || (trim($_POST['equipo_visita']) == "") || (trim($_POST['equipo_local']) == "")|| (trim($_POST['goles_local']) == "")|| (trim($_POST['goles_visita']) == "")|| (trim($_POST['fecha_partido']) == "")|| (trim($_POST['hora_partido']) == ""))
	  {
		 $mensaje = "El código, el nombre y la descripción no pueden ir en blanco";
	  }
	  else
	  {
		  try{
			  $partidos = new Partidos;
			  $jornada = $_POST['jornada'];
			  $equipo_local = $_POST['equipo_local'];
			  $equipo_visita = $_POST['equipo_visita'];
			  $goles_local= $_POST['goles_local'];
			  $goles_visita= $_POST['goles_visita'];
			  $fecha_partido= $_POST['fecha_partido'];
			  $hora_partido = $_POST['hora_partido'];

			  //$resultado_verificar_rows = $partidos->verificar_fechas($fecha_partido,$conexion);

			  $partidos->verificar_fechas($fecha_partido, $conexion);
			  $partidos->verificar_rango_hora($hora_partido,$conexion);
			  $resultado_insertar = $partidos->insertar($jornada,$equipo_local,$equipo_visita,$goles_local,$goles_visita,$fecha_partido,$hora_partido,$conexion);
			  $mensaje = $partidos->mensaje;			  	
		  }catch (Exception $e){
			$mensaje = $e->GetMessage();
		  }
      }
	}



	/* //LLENAR LOS EQUIPOS DINAMICAMENTE
		$partidos = new Partidos;
		$resultado_llenar = $partidos->llenar_select($conexion);
		echo $resultado_llenar;
	*/ 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link href="estilo.css" rel="stylesheet" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Insertar Partidos</title>
</head>
<body>
	<table align="center"><form action="formulario_insertar.php" method="post" onkeypress="document.getElementById('Mensaje').innerHTML = ''">
	<tr>
		<td>
			<span class="">Jornada:</span>
		</td>
		<td>
			<span class=""><input type="text" name="jornada" required/></span>
		</td>
	</tr>
	<tr>
		<td>
			<span class="">Equipo Local:</span>
		</td>
		<td>
			<select name="equipo_local" id="">
				<?php
					echo $partidos->datos;
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<span class="">Equipo Visita:</span>
		</td>
		<td>
			<select name="equipo_visita" id="">
				<?php
					echo $partidos->datos;
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<span class="">Goles local:</span>
		</td>
		<td>
			<span class=""><input type="text" name="goles_local" /></span>
		</td>
	</tr>
	<tr>
		<td>
			<span class="">Goles Visita:</span>
		</td>
		<td>
			<span class=""><input type="text" name="goles_visita" /></span>
		</td>
	</tr>
	<tr>
		<td>
			<span class="">Fecha partido:</span>
		</td>
		<td>
			<span class=""><input type="date" name="fecha_partido"/></span>
		</td>
	</tr>	
	<tr>
		<td>
			<span class="">Hora partido:</span>
		</td>
		<td>
			<span class=""><input type="time" name="hora_partido"/></span>
		</td>
	</tr>
	<tr>
	<td colspan="2" align="center"><input type="submit" value="Enviar" width="100" height="100" />
	</tr>
	<tr>
	<td colspan="2" align="center"><span class="Mensaje" id="Mensaje"><?php echo $mensaje?></span></td>
	</tr></form>
	</table>
</body>
</html>