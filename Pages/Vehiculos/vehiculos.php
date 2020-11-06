<h1>Lista de Vehiculos</h1>
<?php 
	//carga la plantilla con la header y el footer
	require_once('servicios_vehiculos.php');	
    $vehiculos_z = json_decode(busca_vehiculos());

 ?>
<div class="container">
<form action="Pages/Vehiculos/edicion_vehiculos.php" method="post">
<div class="table-responsive">
<table class="table table-hover">
<tr>
<td>
<input type="hidden" name="modo" value="agregar">
<button type="submit" class="btn btn-primary" name="Agregar" value ="Agregar">Agregar</button></td>
</tr>
</table>
</div>
</form>
<br>

	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Clave</th>
					<th>Descripcion</th>
					<th>Tipo Vehiculo</th>
					<th>Placas</th>
					<th>Kilometraje</th>
					<th>Zona</th>
					<th>Chofer</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($vehiculos_z as $mivehiculo_z) {
				  echo "<tr>";
				  echo "<td>" . $mivehiculo_z->codigo   . "</td>";
				  echo "<td>" . $mivehiculo_z->descri . "</td>";
				  echo "<td>" . $mivehiculo_z->descritipoveh . "</td>";
				  echo "<td>" . $mivehiculo_z->placas . "</td>";
				  echo "<td>" . $mivehiculo_z->kilom . "</td>";
				  echo "<td>" . $mivehiculo_z->zona . "</td>";
				  echo "<td>" . $mivehiculo_z->cvechofer . "</td>";
				  $cadena_z = boton_modificar($mivehiculo_z->idvehiculo, 
						 $mivehiculo_z->codigo);
				  echo "<td>" . $cadena_z . "</td>";
				  echo "</tr>";
				  echo "\n";
			   }
			?>
			</tbody>
		</table>
	</div>
</div>

<?php 

	function boton_modificar($idvehiculo_z, $codigo_z) 
    {
	  $cadena_z = "<form action=\"Pages/Vehiculos/edicion_vehiculos.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idvehiculo\" value=\"". $idvehiculo_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"codigo\" value=\"". $codigo_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }
  
?>