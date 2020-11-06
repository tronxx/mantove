<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="es">
<!--<![endif]-->
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- LIBRERIAS BOOTSTRAP-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="../../bootstrap/js/bootstrap.min.js"></script>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>
<?php 
    $archivo_z = "servicios_poligas.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Poligas/servicios_poligas.php";
				
	}
	require_once($archivo_z);	
    $archivo_z = "servicios_renpogas.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Poligas/servicios_renpogas.php";
				
	}
	require_once($archivo_z);	
	//carga la plantilla con la header y el footer
	$poligas_z = "";
	$idpoligas_z = 0;
	$piva_z = 16;
	$statuspol_z  = "A";
	$fecha_z = date("Y") . "/". date("m") . "/" . date("d");
	$alm_z = "";
	if(isset($_POST['idpoligas'])) {
        $idpoligas_z = $_POST['idpoligas'];
    }
	$poligas_z = json_decode(busca_renpogas($idpoligas_z));
	$mipoli_z =  json_decode(busca_mi_poliza($idpoligas_z));
	foreach ($mipoli_z as $mipoligas_z) {
		$fecha_z = $mipoligas_z->fecha;
		$alm_z = $mipoligas_z->nombre;
		$statuspol_z  = $mipoligas_z->status;
	}
 ?>
<h1> Poliza de Gasolina </h1>

<form action="edicion_renpogas.php" method="post">
<div class="table-responsive">
<table class="table table-hover" border = "1">
<tr>
<th>
<?php echo "Almacen:" . $alm_z . " Fecha:" . $fecha_z; ?>
</th>
</tr>
</table>
<table>
<tr>
<td>
<input type="hidden" name="modo" value="Agregar_renpogas">
<?php 
    $cadena_z = "";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpoligas\" value=\"". $idpoligas_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecha\" value=\"". $fecha_z  . "\" >";
	echo $cadena_z;
	$cadena_z = "";
	if($statuspol_z == "A") {
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\" name=\"Agregar\" value =\"Agregar_renpoligas\">Agregar Movimiento</button>";
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\" name=\"Cerrar\" value =\"Cerrar_poligas\">Cerrar Poliza</button>";
		echo $cadena_z;
	 }

?>
</td>
</tr>
</table>
</div>
</form>

<br>

	<div class="table-responsive">
		<table class="table table-hover" border="1">
			<thead>
				<tr>
					<th>Vehiculo</th>
					<th>Descripcion Vehiculo</th>
					<th>Chofer</th>
					<th>Zona</th>
					<th>Kilometraje<br>Anterior</th>
					<th>Kilometraje<br>Actual</th>
					<th>Recorrido</th>
					<th>Litros</th>
					<th>Rendimiento</th>
					<th>Precio<br>Litro</th>
					<th>$ Total</th>
					<th>Fecha<br>Nota</th>
					<th>Forma<br>Pago</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($poligas_z as $mipoligas_z) {
				  $rendto_z = 0;
				  if($mipoligas_z->litros <> 0){
					$rendto_z = $mipoligas_z->recorr / $mipoligas_z->litros;
				  }
				  echo "<tr>";
				  echo "<td>" . $mipoligas_z->codvehi      . "</td>";
				  echo "<td>" . $mipoligas_z->descrivehi   . "</td>";
				  echo "<td>" . $mipoligas_z->cvechofer    . "</td>";
				  echo "<td>" . $mipoligas_z->zona         . "</td>";
				  echo "<td>" . $mipoligas_z->kmtant       . "</td>";
				  echo "<td>" . $mipoligas_z->kmtact       . "</td>";
				  echo "<td>" . $mipoligas_z->recorr       . "</td>";
				  echo "<td>" . $mipoligas_z->litros       . "</td>";
				  echo "<td>" . sprintf("%1.2f", $mipoligas_z->rendto)  . "</td>";
				  echo "<td>" . number_format( $mipoligas_z->preciou, 2 ) . "</td>";
				  echo "<td>" . number_format( $mipoligas_z->total,   2 ) . "</td>";
				  echo "<td>" . $mipoligas_z->fecnot       . "</td>";
				  echo "<td>" . $mipoligas_z->descritipago . "</td>";
				  if($statuspol_z == "A") {
				     $cadena_z = boton_modificar($mipoligas_z->idrenpogas, 
					   $mipoligas_z->codvehi);
				  }
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

function boton_modificar($idrenpogas_z, $alm_z) {
	$cadena_z = "<form action=\"Pages/Poligas/edicion_renpogas.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpoligas\" value=\"". $idrenpogas_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"almacen\" value=\"". $alm_z  . "\" >";
	//$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar_renglon\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }

?>
</body>
</html>
