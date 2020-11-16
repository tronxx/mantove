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
	<script src="renpogas.js" type="text/javascript"></script>
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
    $archivo_z = "../Common/header.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/header.php";
	}
    require_once($archivo_z);  
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

<?php 
    $cadena_z = "";
    $cadena_z = '<form action=';
	if($statuspol_z == "A") {
    	$cadena_z = $cadena_z . '"edicion_renpogas.php"';
    } else {
    	$cadena_z = $cadena_z . '"impripol.php"';
    }
    $cadena_z = $cadena_z . ' method="post">';
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpoligas\" id=\"idpoligas\" value=\"". $idpoligas_z  . "\" >\n";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecha\" id=\"fecha\"  value=\"". $fecha_z  . "\" >\n";
	echo $cadena_z;
	$cadena_z = "";
	if($statuspol_z == "A") {
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\" name=\"Agregar\" value =\"Agregar_renpoligas\">Agregar Movimiento</button> ";
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\" name=\"Cerrar\" value =\"Cerrar_poligas\">Cerrar Poliza</button> ";
		$cadena_z = $cadena_z . '<span class="label label-default"> Para Imprimir la Póliza debe Cerrarla Primero </span>\n';
	 } else {
	 	$cadena_z = $cadena_z . "<input id=\"btn_imprimir\" type=\"submit\" class=\"btn btn-primary\" name=\"Imprimir\" value =\"Imprimir poliza\" target='blank'>";

	 }
	 $cadena_z = $cadena_z . "</form>\n";
	echo $cadena_z;

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
               $imptotal_z = 0;
               $rectotal_z = 0;
               $litrostotal_z = 0;
               $rendto_z = 0;
  		       foreach ($poligas_z as $mipoligas_z) {
				  $rendto_z = 0;
				  $litrostotal_z +=  $mipoligas_z->litros;
				  $imptotal_z += $mipoligas_z->total;
				  $rectotal_z +=  $mipoligas_z->recorr;

				  if($mipoligas_z->litros <> 0){
					$rendto_z = $mipoligas_z->recorr / $mipoligas_z->litros;
				  }
				  echo "<tr>";
				  echo "<td>" . $mipoligas_z->codvehi						. "</td>";
				  echo "<td>" . $mipoligas_z->descrivehi					. "</td>";
				  echo "<td>" . $mipoligas_z->cvechofer						. "</td>";
				  echo "<td>" . $mipoligas_z->zona							. "</td>";
				  echo "<td>" . $mipoligas_z->kmtant						. "</td>";
				  echo "<td>" . $mipoligas_z->kmtact						. "</td>";
				  echo "<td>" . $mipoligas_z->recorr						. "</td>";
				  echo "<td>" . number_format($mipoligas_z->litros, 2)		. "</td>";
				  echo "<td>" . sprintf("%1.2f", $mipoligas_z->rendto)		. "</td>";
				  echo "<td>" . number_format( $mipoligas_z->preciou, 2 )	. "</td>";
				  echo "<td>" . number_format( $mipoligas_z->total,   2 )	. "</td>";
				  echo "<td>" . $mipoligas_z->fecnot						. "</td>";
				  echo "<td>" . $mipoligas_z->descritipago					. "</td>";
				  $cadena_z = "";
				  if($statuspol_z == "A") {
				     $cadena_z = boton_modificar($mipoligas_z->idrenpogas, 
					   $mipoligas_z->codvehi);
				  }
				  echo "<td>" . $cadena_z 									. "</td>";
				  echo "</tr>";
				  echo "\n";
			   }
			   $rendto_z = 0;
			   if($litrostotal_z <> 0){
					$rendto_z = $rectotal_z / $litrostotal_z;
			   }
			   echo "<tr>";
			   echo "<td>" . " ". "</td>";
			   echo "<td>" . "Totales "	. "</td>";
			   echo "<td>" . " " . "</td>";
			   echo "<td>" . " " . "</td>";
			   echo "<td>" . " " . "</td>";
			   echo "<td>" . " " . "</td>";
			   echo "<td>" . $rectotal_z						. "</td>";
			   echo "<td>" . number_format($litrostotal_z, 2)		. "</td>";
			   echo "<td>" . sprintf("%1.2f", $rendto_z)		. "</td>";
			   echo "<td>" . " "	. "</td>";
			   echo "<td>" . number_format( $imptotal_z,   2 )	. "</td>";
			   echo "<td>" . " ". "</td>";
			   echo "<td>" . " ". "</td>";
			   echo "<td>" . " ". "</td>";
			   echo "</tr>";
			   echo "\n";
			?>
			</tbody>
		</table>
	</div>
</div>
<?php 

function boton_modificar($idrenpogas_z, $alm_z) {
	$cadena_z = "<form action=edicion_renpogas.php\" method=\"post\">";
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
