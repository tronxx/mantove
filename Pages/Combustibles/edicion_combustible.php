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
<title>Datos del Combustible</title>
</head>
<body>
<?php 
  require_once("../Common/componentes.php");
  $combustible_z = "";
  $idcombustible_z = 0;
  $piva_z = 0;
  $precioxlit_z = 0;
  $accionok_z = "";
  $fecha_z = date("Y") . "-". date("m") . "-" . date("d");

  if(isset($_POST['modo'])) {
    $accionok_z = $_POST['modo'] . "_ok";
  }
	if(isset($_POST['idcombustible'])) {
    $idcombustible_z = $_POST['idcombustible'];
  }
  if(isset($_POST['combustible'])) {
    $combustible_z = $_POST['combustible'];
  }
  if(isset($_POST['piva'])) {
    $piva_z = $_POST['piva'];
  }
  if(isset($_POST['precioxlit'])) {
    $precioxlit_z = $_POST['precioxlit'];
  }
  if(isset($_POST['fecha'])) {
    $fecha_z = $_POST['fecha'];
  }

?>

<div class="table-responsive">
<table class="table table-hover"  bordercolor = "#0000FF" border="8" cellpadding="1" cellspacing="1">
<tr>
<td  bgcolor= "#00FFFF" align="center">
  <?php 
  if( $accionok_z  == "eliminar_ok") { 
     $title_z = "Seguro de Eliminar este Combustible?";
   } else { 
    $title_z = "Teclee los datos del Combustible"; 
   } 
   echo $title_z;
   ?>
  </td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form"  action="../Combustibles/servicios_combustibles.php" method="post" >
  <?php
      $ff_z = 'min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency"';
      echo input_en_row("combustible", "text", "Combustible:", $combustible_z, "10", ""); 
      echo input_en_row("piva", "number", "Tasa de Iva:", $piva_z, "10", $ff_z);
      echo input_en_row("precioxlit", "number", "Precio x Litro:", $precioxlit_z, "10", $ff_z); 
      echo input_en_row("fecha", "date", "Fecha:", $fecha_z, "30", ""); 

  ?>
  <input type ="hidden" name="idcombustible" value="<?php echo $idcombustible_z; ?>" >
  <br>
  <div class="form-group">
    <div class="col-md-12 text-center">
    <button type="submit" name="modo" value="<?php echo $accionok_z; ?>" class="btn btn-primary btn-lg">Aceptar</button>
    <button type="submit" name="cancelar" value="cancelar" class="btn btn-danger btn-lg">Cancelar</button>
  </div>
  </div>
</form>
</td>
</tr>
</table>
</div>

</body>
</html>
