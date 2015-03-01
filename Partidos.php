<?php
class Partidos{
public $jornada;
public $codigo_equipo_local;
public $codigo_equipo_visita;
public $goles_local;
public $goles_visita;
public $fecha_partido;
public $hora_partido;
public $datos;

	function insertar($jornada,$codigo_equipo_local,$codigo_equipo_visita,$goles_local,$goles_visita,$fecha_partido,$hora_partido,$conexion)
	{
	  $mensaje = "";
	  try{
	    $resultado = mysql_query("insert into Partidos (Jornada, Codigo_equipo_local, Codigo_equipo_visita, Goles_local, Goles_visita, Fecha_partido, Hora_partido, Usuario_creacion, Fecha_creacion) values (".$jornada.",'$codigo_equipo_local','$codigo_equipo_visita','".$goles_local."','".$goles_visita."','".$fecha_partido."','$hora_partido','system',NOW())",$conexion);
		if (!$resultado)
		{
		  throw new Exception(mysql_error()); 
		}else{
		  $this->mensaje = "El registro se creó correctamente";
		}
		return $resultado;
	  }catch(Exception $e){
	     throw new Exception($e->getMessage());	 
	  }
	}


	function actualizar($jornada,$codigo_equipo_local,$codigo_equipo_visita,$goles_local,$goles_visita,$fecha_partido,$hora_partido,$conexion){
	  try{
	    $resultado =mysql_query("update Partidos set
								 Goles_local = '$goles_local',
								 Goles_visita = '$goles_visita',
								 Fecha_partido = '$fecha_partido',
								 Hora_partido = '$hora_partido'
								 where 	Jornada = ".$jornada." AND
								 Codigo_equipo_local = '$codigo_equipo_local' AND
								 Codigo_equipo_visita = '$codigo_equipo_visita'", $conexion);			
		if (!$resultado)
		{
		 throw new Exception(mysql_error()); 
		}
		$this->mensaje = 'El registro se actualizó correctamente';
		return $resultado;
	  }catch(Exception $e){
	     throw new Exception($e->getMessage());
		 
	  }
	}
	function eliminar($jornada,$codigo_equipo_local,$codigo_equipo_visita,$conexion)
	{
	  try{
	    $resultado = mysql_query("delete from Partidos where 	
	    						 Jornada = ".$jornada." AND
								 Codigo_equipo_local = '$codigo_equipo_local' AND
								 Codigo_equipo_visita = '$codigo_equipo_visita'",$conexion);
		if (!$resultado)
		{
		  throw new Exception('Error al eliminar el registro:' || mysql_error()); 
		}
		$this->mensaje = "El registro se eliminó correctamente";
		return $resultado;
	  }catch(Exception $e){
	     throw new Exception($e->getMessage());
	  }
	}

	function buscar_registro ($jornada,$codigo_equipo_local,$codigo_equipo_visita, $conexion){
	   try{
	       $valor = 
		   $resultado = mysql_query("SELECT * FROM Partidos WHERE Jornada=".$jornada." AND Codigo_equipo_local='$codigo_equipo_local' AND Codigo_equipo_visita= '$codigo_equipo_visita'",$conexion);

		   if (!$resultado)
	 	   {
	         throw new Exception(mysql_error($resultado));	
		   }else
		   {
		     if (mysql_num_rows($resultado) == 0)
			 {
			   throw new Exception("El registro solicitado no existe");	
			 } 
			 while($row = mysql_fetch_array($resultado))
			 {
			   $this->jornada = $row['Jornada'];
	   		   $this->codigo_equipo_visita = $row['Codigo_equipo_visita'];
	  		   $this->codigo_equipo_local = $row['Codigo_equipo_local'];
	  		   $this->goles_visita = $row['Goles_visita'];
	  		   $this->goles_local = $row['Goles_local'];
	  		   $this->fecha_partido = $row['Fecha_partido'];
	  		   $this->hora_partido = $row['Hora_partido'];

			   $this->mensaje = 'El registro se recuperó correctamente';
			 } 
			 return $resultado;
		   }
	   }catch(Exception $e){
	      throw new Exception($e->getMessage());
	   }
	}

	function verificar_fechas($fecha_partido,$conexion){
		try{
		   $resultado = mysql_query("Select * from Partidos where Fecha_partido='$fecha_partido'");	
		   if (!$resultado){
	         throw new Exception(mysql_error($resultado));	
		   }else{
		     if (mysql_num_rows($resultado) == 5)
			 {
			   throw new Exception("No se pueden ingresar mas partidos en esta '$fecha_partido' fecha");	
			 } 

			 while($row = mysql_fetch_array($resultado)){

			 }

			 return $resultado;
		   }
	   }catch(Exception $e){
	      throw new Exception($e->getMessage());
	   }

	}

	function verificar_rango_hora($hora_partido,$conexion){
		try{
			$resultado = mysql_query("SELECT * FROM Partidos WHERE Fecha_partido='$hora_partido'",$conexion);
			if (!$resultado){
				throw new Exception(mysql_error($resultado));
			}else{
				if(mysql_num_rows($resultado)==0){
					throw new Exception("Error Processing Request");
				}
				echo strtotime($hora_partido);
				echo strtotime('9 am');
				if (strtotime($hora_partido) > strtotime('9 am')){
					echo "test";
				}
			}

		}catch(Exception $e){

		}

	}

	function llenar_select($conexion){
			try{
				$resultado = mysql_query("Select * from Equipos", $conexion);
				if(!$resultado){
					throw new Exception(mysql_error($resultado));
				}else{	
					//$row = mysql_fetch_array($resultado);

					while($row = mysql_fetch_array($resultado)){
						$this->datos.='<option value='.$row['Codigo_Equipo'].'>'.$row['Nombre'].'</option>';
					}	
					//echo $datos;
			
					return $resultado;
				}
			}catch(Exception $e){
	      	throw new Exception($e->getMessage());
	   	}
	}
}

?>