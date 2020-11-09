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
	require_once('servicios_vehiculos.php');	
    $vehiculos_z = json_decode(busca_vehiculos());

 ?>
<h1>Lista de Vehiculos</h1>
<div class="container">
<form action="edicion_vehiculos.php" method="post">
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
	  $cadena_z = "<form action=\"edicion_vehiculos.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idvehiculo\" value=\"". $idvehiculo_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"codigo\" value=\"". $codigo_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }
  
?>
