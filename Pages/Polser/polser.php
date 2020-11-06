<head>

	<title> Mantenimieno Vehicular</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- LIBRERIAS BOOTSTRAP-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="../../bootstrap/js/bootstrap.min.js"></script>
</head>
<h1>Polizas de Servicios</h1>
<?php 
	//carga la plantilla con la header y el footer
	$fecini_z = "";
	$fecfin_z =  date('Y-m-j');
	$fecini_z =  strtotime ( '-1 month' , strtotime ( $fecfin_z ) ) ;
	$fecini_z =   date('Y-m-j', $fecini_z);
	if(isset($_POST['fecini'])) {
		$fecini_z = $_POST['fecini'];
	} 
	if(isset($_POST['fecfin'])) {
		$fecfin_z = $_POST['fecfin'];
	} 
	$encontrado_z = false;
	$archivo_z = "../../Common/crear_componentes.php";
	$encontrado_z = file_exists($archivo_z);
	if(!$encontrado_z) {
		$archivo_z = "./Pages/Common/crear_componentes.php";
		$encontrado_z = file_exists($archivo_z);
	} 
	if(!$encontrado_z) {
		$archivo_z = "../../Pages/Common/crear_componentes.php";
	} 
	require_once($archivo_z);
	echo "<div class=\"container\">
	  <form action=\"".  $_SERVER['PHP_SELF'] . "\" method=\"post\">";
	echo input_en_row("fecini", "date", "Fecha Inicial:", $fecini_z, "30", ""); 
	echo input_en_row("fecfin", "date", "Fecha Final:", $fecfin_z, "30", ""); 
	echo input_en_row("mipagina", "text", "Estoy En:", $_SERVER['PHP_SELF'], "30", ""); 
	echo "</div>"; 
	echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"buscapol\" value =\"Buscar Polizas\">Buscar Polizas</button>";
	echo "</form>";

	require_once('servicios_polser.php');	
    $polser_z = json_decode(busca_polser($fecini_z, $fecfin_z));

?>

<div class="container">
<form action="Pages/Polser/edicion_polser.php" method="post">
<div class="table-responsive">
<table class="table table-hover">
<tr>
<td>
<input type="hidden" name="modo" value="agregar">
<button type="submit" class="btn btn-primary" name="Agregar" value ="Agregar_polser">Agregar</button></td>
</tr>
</table>
</div>
</form>
<br>

	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Almacen</th>
					<th>Fecha</th>
					<th>$ Total</th>
					<th>Estatus</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($polser_z as $mipolser_z) {
				  $total_z =  $mipolser_z->total;
				  echo "<tr>";
				  echo "<td>" . $mipolser_z->nombre   . "</td>";
				  echo "<td>" . $mipolser_z->fecha   . "</td>";
				  echo "<td>" . number_format( $mipolser_z->total,   2 ) . "</td>";
				  echo "<td>" . $mipolser_z->status   . "</td>";
				  $cadena_z = boton_modificar($mipolser_z->idpolser, 
				     	$mipolser_z->fecha);
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

  function boton_modificar($idpolser_z, $fecha_z) {
	$cadena_z = "<form action=\"Pages/polser/renposer.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpolser\" value=\"". $idpolser_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecha\" value=\"". $fecha_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Visualizar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"imprimir\" >Imprimir</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }

?>
