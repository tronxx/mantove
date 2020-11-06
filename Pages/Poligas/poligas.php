<h1>Polizas de Gasolina</h1>
<?php 
	//carga la plantilla con la header y el footer
	require_once('servicios_poligas.php');	
    $poligas_z = json_decode(busca_poligas());

 ?>
<div class="container">
<form action="Pages/Poligas/edicion_poligas.php" method="post">
<div class="table-responsive">
<table class="table table-hover">
<tr>
<td>
<input type="hidden" name="modo" value="agregar">
<button type="submit" class="btn btn-primary" name="Agregar" value ="Agregar_poligas">Agregar</button></td>
</tr>
</table>
</div>
</form>
<br>

	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Almacen</th>
					<th>Fecha</th>
					<th>Recorrido</th>
					<th>Litros</th>
					<th>Rendimiento</th>
					<th>$ Total</th>
					<th>Estatus</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($poligas_z as $mipoligas_z) {
				  $rendto_z = 0;
				  $total_z =  $mipoligas_z->total;
				  if($mipoligas_z->litros <> 0){
					$rendto_z = $mipoligas_z->kmts / $mipoligas_z->litros;
				  }
				  echo "<tr>";
				  echo "<td>" . $mipoligas_z->nombre   . "</td>";
				  echo "<td>" . $mipoligas_z->fecha   . "</td>";
				  echo "<td>" . $mipoligas_z->kmts   . "</td>";
				  echo "<td>" . $mipoligas_z->litros   . "</td>";
				  echo "<td>" . sprintf("%01.2f", $rendto_z)   . "</td>";
				  echo "<td>" . number_format( $mipoligas_z->total,   2 ) . "</td>";
				  echo "<td>" . $mipoligas_z->status   . "</td>";
				  $cadena_z = boton_modificar($mipoligas_z->idpoligas, 
				     	$mipoligas_z->fecha);
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

  function boton_modificar($idpoligas_z, $fecha_z) {
	$cadena_z = "<form action=\"Pages/poligas/renpogas.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpoligas\" value=\"". $idpoligas_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecha\" value=\"". $fecha_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Visualizar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }

?>