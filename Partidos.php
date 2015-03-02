<?php
class Partidos{
public $jornada;
public $nombre_equipo;
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

			 return $resultado;
		   }
	   }catch(Exception $e){
	      throw new Exception($e->getMessage());
	   }

	}

	function verificar_rango_hora($hora_partido,$conexion){
		try{
			$h_p = strtotime($hora_partido);
			$rango_inicio = strtotime('09:00');
			$rango_final = strtotime('20:00');
			if($h_p>$rango_inicio && $h_p<$rango_final){
				return "S";
			}else{
			   	$this->mensaje = 'Verifique que la hora este dentro del rango de 9:00AM y 20:00';
				return "N";
			}

		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}
	}

	function verificar_hora($hora_partido, $conexion){
	}

	function verificar_partido($jornada, $codigo_equipo_visita, $codigo_equipo_local,$conexion){
		try{
			$resultado = mysql_query("SELECT * FROM Partidos WHERE Jornada=".$jornada." AND Codigo_equipo_local='$codigo_equipo_local' AND Codigo_equipo_visita= '$codigo_equipo_visita'",$conexion);
			if(!$resultado){
				throw new Exception(mysql_error()); 
			}else{
		    	if (mysql_num_rows($resultado) == 0){
			    	throw new Exception("El registro solicitado no existe");	
		    	}
		    	while($row = mysql_fetch_array($resultado)){
		    		if( $row['Goles_local']==0 && $row['Goles_visita']==0 ){
		    			return "N";
		    		}else{
		    			return "S";
		    		}

		    	}

		    	
			}

		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}
	}

	function llenar_select($conexion){
			try{
				$resultado = mysql_query("Select * from Equipos", $conexion);
				if(!$resultado){
					throw new Exception(mysql_error($resultado));
				}else{	

					while($row = mysql_fetch_array($resultado)){
						$this->datos.='<option value='.$row['Codigo_Equipo'].'>'.$row['Nombre'].'</option>';
					}	
			
					return $resultado;
				}
			}catch(Exception $e){
	      	throw new Exception($e->getMessage());
	   	}
	}

	function ver_informacion($codigo_equipo, $conexion){
		try {
			//$resultado = mysql_query("SELECT Equipos.Nombre, Equipos.Codigo_Equipo 
									  //FROM Equipos 
									  //JOIN Partidos 
									  //Where(
										//Equipos.Codigo_Equipo = '$codigo_equipo'
									  //)	
									  //", $conexion);
			$resultado = mysql_query("SELECT * FROM Equipos 
									  Where Codigo_Equipo='$codigo_equipo'", $conexion);

			$resultado2 = mysql_query("SELECT * FROM Partidos
									  Where (Codigo_equipo_local='$codigo_equipo') OR (Codigo_equipo_visita='$codigo_equipo')", $conexion);


			if(!$resultado){
				throw new Exception(mysql_error($resultado));
			}
			 while($row = mysql_fetch_array($resultado2))
			 {
			   //$this->jornada = $row['Jornada'];
			   //$this->nombre_equipo = $row['Nombre'];
	   		  /* $this->codigo_equipo_visita = $row['Codigo_Equipo'];
	  		   $this->codigo_equipo_local = $row['Codigo_Equipo'];
	  		   $this->goles_visita = $row['Goles_visita'];
	  		   $this->goles_local = $row['Goles_local'];
	  		   $this->fecha_partido = $row['Fecha_partido'];
	  		   $this->hora_partido = $row['Hora_partido'];*/
	  		   $this->codigo_equipo_visita=$row['Codigo_equipo_visita'];
	  		   $resultado3 = mysql_query("SELECT * FROM Equipos 
							Where Codigo_Equipo='$this->codigo_equipo_visita'", $conexion);
	  		   echo $resultado3;
	  		   echo $row['Goles_local'];

			   $this->mensaje = 'El registro se recuperó correctamente';
			 } 
			
		} catch (Exception $e) {
			
		}
	}
}

?>