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
	//carga la plantilla con la header y el footer
	require_once('servicios_talleres.php');	
    $talleres_z = json_decode(busca_talleres());

 ?>

<h1>Lista de talleres</h1>
<div class="container">
<form action="edicion_taller.php" method="post">
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
					<th>Representante</th>
					<th>Direccion</th>
					<th>telefono</th>
					<th>Giro</th>
					<th>Situacion</th>
					<th>Baja</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($talleres_z as $mitaller_z) {
				   echo "<tr>";
				  echo "<td>" . $mitaller_z->clave   . "</td>";
				  echo "<td>" . $mitaller_z->nombre . "</td>";
				  echo "<td>" . $mitaller_z->representante . "</td>";
				  echo "<td>" . $mitaller_z->direccion . "</td>";
				  echo "<td>" . $mitaller_z->telefonos . "</td>";
				  echo "<td>" . $mitaller_z->giro . "</td>";
				  if($mitaller_z->idEstatus == 1) {
					  $fecbaj_z = "";
					  $mistat_z = "ACTIVO";
				  } else {
					$fecbaj_z = $mitaller_z->fecbaj;
					$mistat_z = "BAJA";

				  }
				  echo "<td>" . $mistat_z . "</td>";
				  echo "<td>" . $fecbaj_z . "</td>";
				  $cadena_z = boton_modificar($mitaller_z->idtaller, 
						 $mitaller_z->clave, $mitaller_z->nombre, $mitaller_z->representante, 
						 $mitaller_z->direccion,
						$mitaller_z->telefonos, $mitaller_z->giro, 
						$mitaller_z->idEstatus, $mitaller_z->fecbaj);
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

	function boton_modificar($idtaller_z, $clave_z, $nombre_z, $representante_z, 
	  $direc_z, $telefono_z, $giro_z, $status_z, $fecbaj_z ) {
	$cadena_z = "<form action=\"edicion_taller.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idtaller\" value=\"". $idtaller_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"clave\" value=\"". $clave_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"nombre\" value=\"". $nombre_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"representante\" value=\"". $representante_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"direc\" value=\"". $direc_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"telefono\" value=\"". $telefono_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"giro\" value=\"". $giro_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"status\" value=\"". $status_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecbaj\" value=\"". $fecbaj_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }
  
?>