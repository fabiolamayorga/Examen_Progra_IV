<?php 
  $mensaje = "";
  $goles_local= "";
  $goles_visita= "";
  $fecha_partido= "";
  $hora_partido = "";
  $inhabilitar_llave = "N";
  require_once("conexion.php");
  include_once("Partidos.php");
  include_once("llenar_dropdown.php");
  if ((isset($_GET['jornada'],$_GET['equipo_visita'],$_GET['equipo_visita']))){
  		if($_GET['jornada']!="" || $_GET['equipo_visita']!="" || $_GET['equipo_local']!=""){
  			$jornada = $_GET['jornada'];
  			$equipo_visita = $_GET['equipo_visita'];
  			$equipo_local = $_GET['equipo_local'];
  			try{
  				$partidos = new Partidos;
  				$resultado_consulta = $partidos->buscar_registro($jornada,$equipo_local,$equipo_visita,$conexion);

  				$inhabilitar_llave = "S";
  			}catch(Exception $e){
				$mensaje = $e->GetMessage();

  			}
  		}
  }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="estilo.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Formulario Modificar</title>
<script>
function asignar_variable_escondida()
{
   document.getElementById('Code').value = document.getElementById('jornada').value;
   document.getElementById('Code2').value = document.getElementById('equipo_local').value;
   document.getElementById('Code3').value = document.getElementById('equipo_visita').value;

}
function llamar_pantalla(){
   asignar_variable_escondida();
   parent.location='formulario_modificar.php?jornada=' + document.getElementById('Code').value + "&equipo_local="+ document.getElementById('Code2').value+"&equipo_visita="+document.getElementById('Code3').value ;
} 
function limpiar_pantalla(){
   parent.location='formulario_modificar.php';
}
function inicializar(){
   var inhabilitar_llave = '<? echo $inhabilitar_llave;?>';
   if (inhabilitar_llave == 'S'){
      document.getElementById("jornada").disabled = true; 
      document.getElementById("equipo_local").disabled = true; 
      document.getElementById("equipo_visita").disabled = true; 
   }else{
      document.getElementById("jornada").disabled = false; 
      document.getElementById("equipo_local").disabled = false; 
      document.getElementById("equipo_visita").disabled = false; 
   }   
}
</script>
</head>
<body onload="inicializar();">
	<table align="center"><form action="" method="post" onkeypress="document.getElementById('Mensaje').innerHTML = ''">
	<tr>
		<td>
			<span class="">Jornada:</span>
		</td>
		<td>
			<span class=""><input type="text" name="jornada" id="jornada" value="<?php echo $jornada;?>"/></span>
		</td>
	</tr>
	<tr>
		<td>
			<span class="">Equipo Local:</span>
		</td>
		<td>
			<select name="equipo_local" id="equipo_local">
				<?php echo $partidos->datos;?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<span class="">Equipo Visita:</span>
		</td>
		<td>
			<select name="equipo_visita" id="equipo_visita">
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
			<span class=""><input type="text" name="goles_local" value="<?php echo $goles_local;?>"/></span>
		</td>
	</tr>
	<tr>
		<td>
			<span class="">Goles Visita:</span>
		</td>
		<td>
			<span class=""><input type="text" name="goles_visita" value="<?php echo $goles_visita;?>"/></span>
		</td>
	</tr>
	<tr>
		<td>
			<span class="">Fecha partido:</span>
		</td>
		<td>
			<span class=""><input type="date" name="fecha_partido" value="<?php echo $fecha_partido;?>"/></span>
		</td>
	</tr>	
	<tr>
		<td>
			<span class="">Hora partido:</span>
		</td>
		<td>
			<span class=""><input type="time" name="hora_partido" value="<?php echo $hora_partido;?>"/></span>
		</td>
	</tr>
	<tr>
	  <td colspan="2" align="center">&nbsp;&nbsp;
	    <input type="button" value="Buscar" name="Buscar" id="Buscar" onclick="llamar_pantalla();" />&nbsp;&nbsp;<input type="submit" value="Actualizar" name="Actualizar" id="Actualizar" onclick="asignar_variable_escondida();"/>&nbsp;&nbsp;<input type="button" value="Cancelar" name="Cancelar" id="Cancelar" onclick="limpiar_pantalla();" /> 
		<input type="hidden" name="Code" id="Code" />
		<input type="hidden" name="Code2" id="Code2" />
		<input type="hidden" name="Code3" id="Code3" />
	</tr>
	<tr>
	<td colspan="2" align="center"><span class="Mensaje" id="Mensaje"><?php echo $mensaje?></span></td>
	</tr></form>
	</table>
</body>
</html>
