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

</head>
<body>
<?php 
  $zona_z = "";
  $idzona_z = 0;
  $numero_z = 0;
  $accionok_z = "";
  require_once("../Common/componentes.php");

  if(isset($_POST['modo'])) {
    $accionok_z = $_POST['modo'] . "_ok";
  }
  if(isset($_POST['zona'])) {
    $zona_z = $_POST['zona'];
  }
  if(isset($_POST['numero'])) {
    $numero_z = $_POST['numero'];
  }
  if(isset($_POST['idzona'])) {
    $idzona_z = $_POST['idzona'];
  }

  if( $accionok_z  == "eliminar_ok") { 
    $title_z = "Seguro de Eliminar esta Zona?";
  } else { 
   $title_z = "Teclee los datos de la Zona"; 
  } 
?>

<div class="container">
  <h2><?php echo $title_z; ?></h2>
  <div class="panel panel-default">
    <div class="panel-heading">Teclee los datos de la Zona</div>
    <div class="panel-body">
<form class="form-inline" role="form"  action="servicios_zonas.php" method="post" >
  <?php
    echo input_en_row("numero", "number", "Numero:", $numero_z, "3", ""); 
    echo input_en_row("zona", "text", "Zona:", $zona_z, "50", ""); 
  ?>
  <input type ="hidden" name="idzona" value="<?php echo $idzona_z; ?>" >
  </div>
  <div class="modal-footer">
    <button type="submit" name="modo" value="<?php echo $accionok_z; ?>" class="btn btn-primary btn-lg">Aceptar</button>
    <button type="submit" name="cancelar" class="btn btn-danger" value="cancelar" class="btn btn-primary btn-lg">Cancelar</button>
	</div>
</form>
</div>
</body>
</html>
