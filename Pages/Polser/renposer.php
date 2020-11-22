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

    $archivo_z = "servicios_polser.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Polser/servicios_polser.php";
				
	}
	require_once($archivo_z);	
    $archivo_z = "servicios_renposer.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Polser/servicios_renposer.php";
				
	}
	require_once($archivo_z);	
    $archivo_z = "../Common/busca_datos.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/common/busca_datos.php";
	}
	require_once($archivo_z);	
	//carga la plantilla con la header y el footer
	$polser_z = "";
	$idpolser_z = -1;
	$piva_z = 16;
	$statuspol_z  = "A";
	$fecha_z;
	$alm_z;
	$minumcia_z;
	$nomcia_z;
	$dircia_z;
	$alm_z = "";
	$minumcia_z = 1;
	$nomcia_z = "MI CIA";
	$dircia_z = "DIRECCION CIA";
	$fecha_z = date("Y") . "/". date("m") . "/" . date("d");
	if(isset($_SESSION["nomcia"])) {  $nomcia_z = $_SESSION["nomcia"]; }
	if(isset($_SESSION["dircia"])) {  $nomcia_z = $_SESSION["dircia"]; }
	if(isset($_POST['idpolser'])) {
        $idpolser_z = $_POST['idpolser'];
	}
	if($idpolser_z == -1) {
		alertas_renposer("Póliza Inválida", $idpolser_z);
	}

	$polser_z = json_decode(busca_renposer($idpolser_z));
	$mipoli_z =  json_decode(busca_mi_poliza($idpolser_z));
	foreach ($mipoli_z as $mipolser_z) {
		$fecha_z = $mipolser_z->fecha;
		$alm_z = $mipolser_z->nombre;
		$statuspol_z  = $mipolser_z->status;
	}
 ?>
<h1> Poliza de Servicios </h1>

<div class="table-responsive">
<table class="table table-hover" border = "1">
<tr>
<th>
<?php echo "Almacen:" . $alm_z . " Fecha:" . $fecha_z ; ?>
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
    	$cadena_z = $cadena_z . '"edicion_renposer.php"';
    } else {
    	$cadena_z = $cadena_z . '"impripolser.php" target="blank" ';
    }
    $cadena_z = $cadena_z . ' method="post">';
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpolser\" id=\"idpolser\" value=\"". $idpolser_z  . "\" >\n";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecha\" id=\"fecha\"  value=\"". $fecha_z  . "\" >\n";
	echo $cadena_z;
	$cadena_z = "";
	if($statuspol_z == "A") {
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\" name=\"modo\" value =\"Agregar_renposer\">Agregar Movimiento</button> ";
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\" name=\"modo\" value =\"Cerrar_polser\">Cerrar Póliza</button> ";
		$cadena_z = $cadena_z . '<input type="button" class="btn btn-primary" value = "Para Imprimir la Póliza debe Cerrarla Primero">';
	 } else {
	 	$cadena_z = $cadena_z . "<button id=\"btn_imprimir\" type=\"submit\" class=\"btn btn-primary\" name=\"Imprimir\" value =\"Imprimir poliza\"> <span class=\"glyphicon glyphicon-print\" aria-hidden=\"true\"></span> Imprimir Póliza</button>";

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
					<th>Servicio</th>
					<th>Kilometraje</th>
					<th>Taller</th>
					<th>$ Total</th>
					<th>Observaciones</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($polser_z as $mipolser_z) {
  		       	$idrenposer_z = $mipolser_z->idrenposer;
				  echo "<tr>";
				  echo "<td>" . $mipolser_z->codvehi       . "</td>";
				  echo "<td>" . $mipolser_z->descrivehi    . "</td>";
				  echo "<td>" . $mipolser_z->cvechofer     . "</td>";
				  $cadena_z = $mipolser_z->descriserv;
				  if ($mipolser_z->tienealternante == "S") {
					  if($mipolser_z->edotoggle == "S") {
						$cadena_z .= " CON ";
					  } else {
						$cadena_z .= " SIN ";					  
					  }
					$cadena_z .= " " . $mipolser_z->servalternante;

				  }
				  echo "<td>" . $cadena_z    . "</td>";
				  echo "<td>" . $mipolser_z->kilom         . "</td>";
				  echo "<td>" . $mipolser_z->codigotaller . " " . $mipolser_z->nombretaller  . "</td>";
				  echo "<td>" . number_format( $mipolser_z->costo,   2 ) . "</td>";
				  echo "<td>" . $mipolser_z->observs . "</td>";
				  if($statuspol_z == "A") {
				     $cadena_z = boton_modificar($mipolser_z->idrenposer, $idpolser_z,
					   $mipolser_z->codvehi);
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

function boton_modificar($idrenposer_z, $idpolser_z, $codvehi_z) {
	$cadena_z = "<form action=\"edicion_renposer.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idrenposer\" value=\"". $idrenposer_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpolser\" value=\"". $idpolser_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"vehiculo\" value=\"". $codvehi_z  . "\" >";
	//$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . '<button type="submit" class="btn btn-danger"
	id="btn_eliminar" value="eliminar_renglon" data-target="#forma_eliminar" name="modo"> Eliminar</button>';
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }


?>

<!-- Modal -->
<div class="modal fade" id="forma_eliminar"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="servicios_reposer.php" method="post">

  <?php 	
    //$idrenposer_z = -1;
  	$cadena_z = "<input type =\"hidden\" name=\"idrenposer\" value=\"". $idrenposer_z  . "\" >"; 
  	echo $cadena_z;
  ?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Seguro de Eliminar este Movimiento?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   	  			<label>Eliminar Movimiento</label>
      </div>
      <div class="modal-footer">
        <button type="submit" name="modo" value="<?php echo "eliminar_renglon_ok"; ?>"
        	class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</form>
</div>

</body>
</html>
