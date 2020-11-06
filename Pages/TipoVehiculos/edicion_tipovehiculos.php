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
<title>Datos del Tipo de Vehiculo</title>
</head>
<body>
<?php 
  $tipovehiculo_z = "";
  $idtipovehiculo_z = 0;
  $accionok_z = "";
  if(isset($_POST['modo'])) {
    $accionok_z = $_POST['modo'] . "_ok";
  }
  if(isset($_POST['tipovehiculo'])) {
    $tipovehiculo_z = $_POST['tipovehiculo'];
  }
  if(isset($_POST['idtipovehiculo'])) {
    $idtipovehiculo_z = $_POST['idtipovehiculo'];
  }

?>
<div class="table-responsive">
<table class="table table-hover"  bordercolor = "#0000FF" border="8" cellpadding="1" cellspacing="1">
<tr>
<td  bgcolor= "#00FFFF" align="center">
  <?php 
  if( $accionok_z  == "eliminar_ok") { 
     $title_z = "Seguro de Eliminar este tipo de Vehiculo?";
   } else { 
    $title_z = "Teclee los datos del Tipo de Vehiculo"; 
   } 
   echo $title_z;
   ?>
  </td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form"  action="servicios_tipovehiculos.php" method="post" >
  <div class="form-group">
    <label for="tipovehiculo">Tipo de Vehiculo:</label>
    <input type="text" class="form-control" 
      id="tipovehiculo" name="tipovehiculo"  maxlength="50" 
      value = "<?php echo $tipovehiculo_z; ?>" >
  </div>  
   <input type ="hidden" name="idtipovehiculo" value="<?php echo $idtipovehiculo_z; ?>" >
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
