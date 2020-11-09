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
    $archivo_z = "../Common/header.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/header.php";
	}
    require_once($archivo_z);	
    //checa_sesion();
    $archivo_z = "serviciosa_zonas.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "servicios_zonas.php";
	}
    require_once($archivo_z);	
    $zonas_z = json_decode(busca_zonas());

 ?>
<h1>Lista de Zonas</h1>
<div class="container">
<form action="edicion_zona.php" method="post">
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
					<th>Numero</th>
					<th>Nombre</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($zonas_z as $mizona_z) {
				   echo "<tr>";
				  echo "<td>" . $mizona_z->numero   . "</td>";
				  echo "<td>" . $mizona_z->zona . "</td>";
				  $cadena_z = boton_modificar($mizona_z->idzona, 
				     $mizona_z->numero, $mizona_z->zona);
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


  function boton_modificar($idzona_z, $numero_z, $zona_z) {
	$cadena_z = "<form action=\"edicion_zona.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idzona\" value=\"". $idzona_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"numero\" value=\"". $numero_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"zona\" value=\"". $zona_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  data-toggle=\"modal\" name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  data-toggle=\"modal\" name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }
  
?>
</body>
</html>
