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
<body>
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
	//carga la plantilla con la header y el footer
    $archivo_z = "../Common/header.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/header.php";
	}
    require_once($archivo_z);	

	require_once('servicios_combustibles.php');	
    $combustibles_z = json_decode(busca_combustibles());

 ?>
<h1>Lista de Combustibles</h1>
<div class="container">
<form action="edicion_combustible.php" method="post">
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
					<th>Iva</th>
					<th>Precio<br>Litro</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($combustibles_z as $micombus_z) {
  		       	  $precioxlit_z = number_format( $micombus_z->precioxlit,   2 );   

				  echo "<tr>";
				  echo "<td>" . $micombus_z->descripcion   . "</td>";
				  echo "<td>" . $micombus_z->iva   . "</td>";
				  echo "<td>" . $precioxlit_z   . "</td>";
				  echo "<td>" . $micombus_z->fecha   . "</td>";
				  $cadena_z = boton_modificar($micombus_z->idcombustible, 
				     $micombus_z->descripcion, $micombus_z->iva, $micombus_z->precioxlit,
				     $micombus_z->fecha);
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

  function boton_modificar($idcombustible_z, $descri_z, $piva_z, $precioxlit_z, $fecha_z) {
	$cadena_z = "<form action=\"edicion_combustible.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idcombustible\" value=\"". $idcombustible_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"combustible\" value=\"". $descri_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"piva\" value=\"". $piva_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"precioxlit\" value=\"". $precioxlit_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecha\" value=\"". $fecha_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }

  
?>
</body>
