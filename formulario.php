<table align="center">
<form action="form_u_categoria.php" method="POST" id="Formulario">
<tr>
<td><span class="Estilo1">Código:</span></td>
<td><span class="Estilo1"><input type="text" name="Codigo" id="Codigo" value=""/></span></td>
</tr>
<tr>
<td><span class="Estilo1">Nombre:</span></td>
<td><span class="Estilo1"><input type="text" name="Nombre" id="Nombre" value=""/></span></td>
</tr>
<tr>
<td><span class="Estilo1">Descripción:</span></td>
<td><textarea name="Descripcion" cols="21" rows="5" id="Descripcion"><?php echo $descripcion;?></textarea></td>
</tr>
<tr>
  <td colspan="2" align="center">&nbsp;&nbsp;
    <input type="button" value="Buscar" name="Buscar" id="Buscar" onclick="llamar_pantalla();" />&nbsp;&nbsp;<input type="submit" value="Actualizar" name="Actualizar" id="Actualizar" onclick="asignar_variable_escondida();"/>&nbsp;&nbsp;<input type="button" value="Cancelar" name="Cancelar" id="Cancelar" onclick="limpiar_pantalla();" /> 
	<input type="hidden" name="Code" id="Code" />
</tr>
<tr>
<td colspan="2" align="center"><span class="Mensaje" id="Mensaje"><?php echo $mensaje;?></span></td>
</tr></form>
</table>