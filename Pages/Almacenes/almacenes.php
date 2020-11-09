<html>
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
	<script src="../../js/jquery-1.7.2.min.js" type="text/javascript"></script>
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
    $archivo_z = "../Common/busca_datos.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/busca_datos.php";
	}
    require_once($archivo_z);	
    $archivo_z = "../Common/header.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/header.php";
	}
    require_once($archivo_z);	
    //checa_sesion();
    $archivo_z = "servicios_almacenes.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "servicios_almacenes.php";
	}
    require_once($archivo_z);	
    $almacenes_z = json_decode(busca_almacenes());

 ?>
<h1>Lista de Almacenes</h1>
<div class="container">
<form action="edicion_almacen.php" method="post">
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
					<th>Nombre</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($almacenes_z as $mialmacen_z) {
				   echo "<tr>";
				  echo "<td>" . $mialmacen_z->clave   . "</td>";
				  echo "<td>" . $mialmacen_z->nombre . "</td>";
				  $cadena_z = boton_modificar($mialmacen_z->idalmacen, 
				     $mialmacen_z->clave, $mialmacen_z->nombre);
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

  function boton_eliminar($idalmacen_z, $clave_z, $nombre_z) {
	$cadena_z = "<form action=\"edicion_almacen.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idalmacen\" value=\"". $idalmacen_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"clave\" value=\"". $clave_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"nombre\" value=\"". $nombre_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }

  function boton_modificar($idalmacen_z, $clave_z, $nombre_z) {
	$cadena_z = "<form action=\"edicion_almacen.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idalmacen\" value=\"". $idalmacen_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"clave\" value=\"". $clave_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"nombre\" value=\"". $nombre_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  data-toggle=\"modal\" name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  data-toggle=\"modal\" name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }
  
?>
</body>
</html>
