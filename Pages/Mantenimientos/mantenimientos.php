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
	require_once('servicios_mantenimientos.php');	
    $mantenimientos_z = json_decode(busca_mantenimientos());

 ?>
<h1>Lista de Servicios de Mantenimientos</h1>
<div class="container">
<form action="edicion_mantenimientos.php" method="post">
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
					<th>Periodico</th>
					<th>Km/Dias</th>
					<th>Periodicidad</th>
					<th>Perio.Nuevos</th>
					<th>Tolerancia</th>
					<th>Serv.Alternante</th>
					<th>Descripcion<br>Serv.Alternante</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($mantenimientos_z as $mimantenimiento_z) {
				  echo "<tr>";
				  echo "<td>" . $mimantenimiento_z->clave   . "</td>";
				  echo "<td>" . $mimantenimiento_z->descri . "</td>";
				  echo "<td>" . $mimantenimiento_z->descritipoveh . "</td>";
				  echo "<td>" . $mimantenimiento_z->perio . "</td>";
				  echo "<td>" . $mimantenimiento_z->kmofe . "</td>";
				  echo "<td>" . $mimantenimiento_z->xcada . "</td>";
				  echo "<td>" . $mimantenimiento_z->xcadanvo . "</td>";
				  echo "<td>" . $mimantenimiento_z->toler . "</td>";
				  echo "<td>" . $mimantenimiento_z->toggle . "</td>";
				  echo "<td>" . $mimantenimiento_z->servop . "</td>";
          
				  $cadena_z = boton_modificar($mimantenimiento_z->idservmanto, 
						 $mimantenimiento_z->clave, $mimantenimiento_z->descri, 
						 $mimantenimiento_z->idtipovehiculo, $mimantenimiento_z->perio,
						$mimantenimiento_z->kmofe, $mimantenimiento_z->xcada,
						$mimantenimiento_z->xcadanvo, $mimantenimiento_z->toler,
						$mimantenimiento_z->toggle, $mimantenimiento_z->servop
					);
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

	function boton_modificar($idmantenimiento_z, $clave_z, $descripcion_z, 
	  $idtipoveh_z, $perio_z, $kmofe_z, $xcada_z, $xcadanvo_z, $toler_z,
	  $toggle_z, $servop_z) 
   {
	$cadena_z = "<form action=\"edicion_mantenimientos.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idmantenimiento\" value=\"". $idmantenimiento_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"clave\" value=\"". $clave_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"descripcion\" value=\"". $descripcion_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idtipoveh\" value=\"". $idtipoveh_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"perio\" value=\"". $perio_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"kmofe\" value=\"". $kmofe_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"xcada\" value=\"". $xcada_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"xcadanvo\" value=\"". $xcadanvo_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"toler\" value=\"". $toler_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"toggle\" value=\"". $toggle_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"servop\" value=\"". $servop_z  . "\" >";

	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }
  
?>
