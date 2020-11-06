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
  $nombre_z = "";
  $clave_z = "";
  $direc_z = "";
  $idalmacen_z = 0;
  $accionok_z = "";
  require_once("../Common/componentes.php");

  if(isset($_POST['modo'])) {
    $accionok_z = $_POST['modo'] . "_ok";
  }
  if(isset($_POST['nombre'])) {
    $nombre_z = $_POST['nombre'];
  }
  if(isset($_POST['clave'])) {
    $clave_z = $_POST['clave'];
  }
  if(isset($_POST['idalmacen'])) {
    $idalmacen_z = $_POST['idalmacen'];
  }

  if( $accionok_z  == "eliminar_ok") { 
    $title_z = "Seguro de Eliminar este Almacen?";
  } else { 
   $title_z = "Teclee los datos del Almacen"; 
  } 
?>

<div class="container">
  <h2><?php echo $title_z; ?></h2>
  <div class="panel panel-default">
    <div class="panel-heading">Teclee los datos del Almacen</div>
    <div class="panel-body">
<form class="form-inline" role="form"  action="../Almacenes/servicios_almacenes.php" method="post" >
  <?php
    echo input_en_row("clave", "text", "Clave:", $clave_z, "3", ""); 
    echo input_en_row("nombre", "text", "Nombre:", $nombre_z, "50", ""); 
    echo input_en_row("direccion", "text", "Direccion:", $direc_z, "50", ""); 
  ?>
  <input type ="hidden" name="idalmacen" value="<?php echo $idalmacen_z; ?>" >
  </div>
  <div class="modal-footer">
    <button type="submit" name="modo" value="<?php echo $accionok_z; ?>" class="btn btn-primary btn-lg">Aceptar</button>
    <button type="submit" name="cancelar" class="btn btn-danger" value="cancelar" class="btn btn-primary btn-lg">Cancelar</button>
	</div>
</form>
</div>
</body>
</html>
