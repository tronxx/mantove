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
<title>Datos de la Poliza de Gasolina</title>
</head>
<body>
<?php 
  require_once("../Common/componentes.php");
  $almacen_z = "";
  $idalmacen_z = 0;
  $idpoligas_z = 0;
  $accionok_z = "";
  $fecha_z = date("Y") . "-". date("m") . "-" . date("d");
  if(isset($_POST['modo'])) {
    $accionok_z = $_POST['modo'] . "_ok";
  } 
  if(isset($_POST['idpoligas'])) {
    $idpoligas_z = $_POST['idpoligas'];
  } 
  if(isset($_POST['almacen'])) {
    $almacen_z = $_POST['almacen'];
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
     $title_z = "Seguro de Eliminar esta Poliza de Gasolina?";
   } else { 
    $title_z = "Teclee los datos de la Poliza de Gasolina"; 
   } 
   echo $title_z;
   ?>
  </td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form"  action="servicios_poligas.php" method="post" >
  <div class="form-group">
    <div class="container">
    <?php 
       echo caja_almacenes ($idalmacen_z);
       echo input_en_row("fecha", "date", "Fecha:", $fecha_z, "30", ""); 
    ?>
   <input type ="hidden" name="idpoligas" value="<?php echo $idpoligas_z; ?>" >
  </div>  
  </div>
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
