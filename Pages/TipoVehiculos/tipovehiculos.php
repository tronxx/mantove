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
    // Verifico que haya iniciado sesion el usuario
	session_start();
    $archivo_z = "../Common/checa_sesion.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/checa_sesion.php";
	}
    require_once($archivo_z);	
	checa_sesion();
	//carga la plantilla con la header y el footer
    $archivo_z = "../Common/header.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/header.php";
	}
    require_once($archivo_z);	
	//carga la plantilla con la header y el footer
	require_once('servicios_tipovehiculos.php');	
    $tipovehiculos_z = json_decode(busca_tipovehiculos());

 ?>
<h1>Lista de Tipos de Vehiculos</h1>
<div class="container">
<form action="edicion_tipovehiculos.php" method="post">
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
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($tipovehiculos_z as $mitipovehiculo_z) {
				   echo "<tr>";
				  echo "<td>" . $mitipovehiculo_z->descripcion   . "</td>";
				  $cadena_z = boton_modificar($mitipovehiculo_z->idtipovehiculo, 
				     $mitipovehiculo_z->descripcion);
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

  function boton_modificar($idtipovehiculo_z, $tipovehiculo_z) {
	$cadena_z = "<form action=\"edicion_tipovehiculos.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idtipovehiculo\" value=\"". $idtipovehiculo_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"tipovehiculo\" value=\"". $tipovehiculo_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }

?>