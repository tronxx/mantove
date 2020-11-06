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
	<script src="choferes.js" type="text/javascript"></script>
</head>
<body>

<?php 
	//carga la plantilla con la header y el footer
    $archivo_z = "../Common/header.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/header.php";
	}
    require_once($archivo_z);	
    $archivo_z = "../Common/busca_datos.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/busca_datos.php";
	}
    require_once($archivo_z);	
    checa_sesion();
	require_once('servicios_choferes.php');	
    $choferes_z = json_decode(busca_choferes());

 ?>
<h1>Lista de Choferes</h1>
<div class="container">
<form action="edicion_chofer.php" method="post">
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
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Direccion</th>
					<th>telefono</th>
					<th>Ciudad</th>
					<th>Situacion</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($choferes_z as $michofer_z) {
				   echo "<tr>";
				  echo "<td>" . $michofer_z->codigo   . "</td>";
				  echo "<td>" . $michofer_z->nombres . "</td>";
				  echo "<td>" . $michofer_z->apellidos . "</td>";
				  echo "<td>" . $michofer_z->direccion . "</td>";
				  echo "<td>" . $michofer_z->telefono . "</td>";
				  echo "<td>" . $michofer_z->ciudad . "</td>";
				  if ( $michofer_z->idEstatus == 1) {
					  $miestado_z = "ACTIVO";
				  } else {
					$miestado_z = "BAJA";
				  }
				  echo "<td>" . $miestado_z . "</td>";
				  $cadena_z = boton_modificar($michofer_z->idchofer, 
						 $michofer_z->codigo, $michofer_z->nombres, $michofer_z->apellidos, $michofer_z->direccion,
						$michofer_z->telefono, $michofer_z->idciudad, $michofer_z->idEstatus);
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

	function boton_modificar($idchofer_z, $codigo_z, $nombre_z, $apellidos_z, 
	  $direc_z, $telefono_z, $idciudad_z, $idstatus_z) {
	$cadena_z = "<form action=\"edicion_chofer.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idchofer\" value=\"". $idchofer_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"codigo\" value=\"". $codigo_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"nombre\" value=\"". $nombre_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"apellido\" value=\"". $apellidos_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"direc\" value=\"". $direc_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"telefono\" value=\"". $telefono_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idciudad\" value=\"". $idciudad_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"status\" value=\"". $idstatus_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }
  
?>