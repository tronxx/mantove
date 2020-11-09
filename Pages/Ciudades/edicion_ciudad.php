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
<title>Datos de la Ciudad</title>
</head>
<body>
<?php 
  $ciudad_z = "";
  $idciudad_z = 0;
  require_once("../Common/componentes.php");

  $accionok_z = "";
  if(isset($_POST['modo'])) {
    $accionok_z = $_POST['modo'] . "_ok";
  }
  if(isset($_POST['ciudad'])) {
    $ciudad_z = $_POST['ciudad'];
  }
  if(isset($_POST['idciudad'])) {
    $idciudad_z = $_POST['idciudad'];
  }

?>
<div class="table-responsive">
<table class="table table-hover"  bordercolor = "#0000FF" border="8" cellpadding="1" cellspacing="1">
<tr>
<td  bgcolor= "#00FFFF" align="center">
  <?php 
  if( $accionok_z  == "eliminar_ok") { 
     $title_z = "Seguro de Eliminar esta Ciudad?";
   } else { 
    $title_z = "Teclee los datos de la Ciudad"; 
   } 
   echo $title_z;
   ?>
  </td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form"  action="servicios_ciudades.php" method="post" >
  <?php
    echo input_en_row("ciudad", "text", "Ciudad:", $ciudad_z, "50", ""); 
  ?>
  <input type ="hidden" name="idciudad" value="<?php echo $idciudad_z; ?>" >
  <br>
  <div class="modal-footer">
    <button type="submit" name="modo" value="<?php echo $accionok_z; ?>" class="btn btn-primary btn-lg">Aceptar</button>
    <button type="submit" name="cancelar" value="cancelar" class="btn btn-danger btn-lg">Cancelar</button>
  </div>
</form>
</td>
</tr>
</table>
</div>

</body>
</html>
