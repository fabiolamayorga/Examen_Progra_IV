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
public $tabla;

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
			$consulta = "SELECT 
						Equipos.Nombre as Nombre_equipo_local, 
						Equipos.Codigo_Equipo,
						Partidos.Jornada, 
						Partidos.Goles_local, 
						Partidos.Goles_visita, 
						Partidos.Fecha_partido, 
						Partidos.Hora_partido,
						Partidos.Codigo_equipo_visita,
						Partidos.Codigo_equipo_local
						 FROM Equipos , Partidos
						 where Partidos.Codigo_equipo_local = '$codigo_equipo' AND Equipos.Codigo_Equipo = Partidos.Codigo_equipo_local
						 UNION
						 SELECT
						 Equipos.Nombre as 'Nombre_equipo_visita', 
						 Equipos.Codigo_Equipo,
						 Partidos.Jornada, 
						 Partidos.Goles_local, 
						 Partidos.Goles_visita, 
						 Partidos.Fecha_partido, 
						 Partidos.Hora_partido,
						 Partidos.Codigo_equipo_visita,
						 Partidos.Codigo_equipo_local
						 FROM Equipos,Partidos
						 where Equipos.Codigo_Equipo = Partidos.Codigo_equipo_visita and Partidos.Codigo_equipo_visita='$codigo_equipo'";

			$resultado = mysql_query($consulta,$conexion) or die(mysql_error());
			
			if(!$resultado){
				throw new Exception(mysql_error($resultado));

			}
			 while($row = mysql_fetch_array($resultado))
			 {
	  		   $this->tabla .='
				<table align="center" style="text-align:center" border="1" colspan="0">
					<tr>
						<th>Codigo Equipo</th>
						<th>Nombre Equipo Local</th>
						<th>Numero de Jornada</th>
						<th>Fecha del partido</th>
						<th>Marcador </th>
					</tr>
					<tr>
						<td>'.$row['Codigo_Equipo'].'</td>
						<td>'.$row['Nombre_equipo_local'].'</td>
						<td>'.$row['Jornada'].'</td>
						<td>'.$row['Fecha_partido'].'</td>
						<td>'.$row['Goles_visita'].'-'.$row['Goles_local'].'</td>						
					</tr>
				</table>';

			   $this->mensaje = 'El registro se recuperó correctamente';
			 } 
			 return $this->tabla;

			
		} catch (Exception $e) {
			
		}
	}
}

?>