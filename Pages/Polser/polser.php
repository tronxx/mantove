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
    require_once("../Common/componentes.php");

    $fechini_z = date("Y-m-01");
    $fechfin_z = date('Y-m-t');

    if(isset($_POST['FechaInicial'])) {
       $fechini_z = $_POST['FechaInicial'];     
   	}
    if(isset($_POST['FechaFinal'])) {
       $fechfin_z = $_POST['FechaFinal'];     
   	}

	require_once('servicios_polser.php');	
    $polser_z = json_decode(busca_polser($fechini_z, $fechfin_z));

?>
<h1>Pólizas de Servicio </h1>
Fecha Inicial: <span class="label label-default"> <?php echo  $fechini_z; ?></span>
Fecha Inicial: <span class="label label-default"> <?php echo  $fechfin_z; ?></span>
	<button type="button" class="btn btn-primary" data-toggle="modal" 
	id="btn_fechas" data-target="#forma_fechas" name="btn_fechas"> Seleccionar Rango Fechas</button>
<br>

<div class="container">
<form action="edicion_polser.php" method="post">
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
	$cadena_z = "<form action=\"renposer.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpolser\" value=\"". $idpolser_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecha\" value=\"". $fecha_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Visualizar</button> ";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button> ";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }

?>

<!-- Modal -->
<div class="modal fade" id="forma_fechas"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="polser.php" method="post">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Seleccione el Rango de Fechas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   	  			<label>Fecha Inicial:</label>
   	  			<input type="date" name="FechaInicial" id="FechaInicial" 
   	  			value = "<?php echo $fechini_z;   ?>"
   	  			>
   	  			<label>Fecha Final:</label>
   	  			<input type="date" name="FechaFinal" id="FechaFinal" 
   	  			value = "<?php echo $fechfin_z;   ?>"
   	  			>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</form>
</div>
