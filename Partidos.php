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


/*function actualizar($codigo,$nombre,$descripcion,$conexion)
{
  try{
    $resultado = mysql_query("update categorias set 
	                          nombre = '" .$nombre."',
							  descripcion = '" .$descripcion."'
							  where codigo_categoria = '" .$codigo."'",$conexion);
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
function eliminar($codigo,$conexion)
{
  try{
    $resultado = mysql_query("delete from categorias where 
	                          codigo_categoria = ".$codigo,$conexion);
	if (!$resultado)
	{
	  throw new Exception('Error al eliminar el registro:' || mysql_error()); 
	}
	if (mysql_num_rows() == 0){
	  throw new Exception('El registro que se intentó eliminar no existe.');  
	}
	$this->mensaje = "El registro se eliminó correctamente";
	return $resultado;
  }catch(Exception $e){
     throw new Exception($e->getMessage());
  }
}*/
	function buscar_registro ($jornada,$codigo_equipo_local,$codigo_equipo_visita, $conexion){
	   try{
	       $valor = 
		   $resultado = mysql_query("select * from categorias where Codigo_equipo_local=".'$codigo_equipo_local'."and Codigo_equipo_visita=".'$codigo_equipo_visita'."and Jornada=".$jornada,$conexion);
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
	  		   $this->goles_visita = $row['Goles_local'];
	  		   $this->goles_local = $row['Goles_visita'];
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
		   $resultado = mysql_query("Select * from Partidos where Fecha_partido=".'$fecha_partido');	
		   if (!$resultado)
	 	   {
	         throw new Exception(mysql_error($resultado));	
		   }else
		   {
		     if (mysql_num_rows($resultado) == 4)
			 {
			   throw new Exception("El registro solicitado no existe");	
			 } 

			 while($row = mysql_fetch_array($resultado)){


			 }

			 return $resultado;
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