<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- LIBRERIAS BOOTSTRAP-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="../../bootstrap/js/bootstrap.min.js"></script>
	<script src="../../js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="../../js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="../../js/jquery.jqGrid.min.js" type="text/javascript"></script>
</head>

<?php 
	//carga la plantilla con la header y el footer
    $archivo_z = "../Common/header.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/header.php";
	}
    require_once($archivo_z);	
	//carga la plantilla con la header y el footer
	require_once('servicios_tipopago.php');	
    $tipopagos_z = json_decode(busca_tipopagos());

 ?>
<h1>Tipos de Pago</h1>
<div class="container">
<form action="edicion_tipopago.php" method="post">
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
					<th>Descripcion</th>
					<th>Valor</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($tipopagos_z as $mitipopago_z) {
				   echo "<tr>";
				  echo "<td>" . $mitipopago_z->descripcion   . "</td>";
				  echo "<td>" . $mitipopago_z->valor   . "</td>";
				  $cadena_z = boton_modificar($mitipopago_z->idtipopago, 
				     $mitipopago_z->descripcion, $mitipopago_z->valor);
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

  function boton_modificar($idtipopago_z, $tipopago_z, $valor_z) {
	$cadena_z = "<form action=\"edicion_tipopago.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idtipopago\" value=\"". $idtipopago_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"tipopago\" value=\"". $tipopago_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"valor\" value=\"". $valor_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }

?>