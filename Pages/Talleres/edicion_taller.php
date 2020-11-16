<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="es">
<!--<![endif]-->
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
  <script src="talleres.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Datos del Taller</title>
</head>
<body>
<?php 
  require_once("../Common/componentes.php");
  $nombre_z = "";
  $representante_z = "";
  $clave_z = "";
  $direc_z = "";
  $telefono_z = "";
  $giro_z = "";
  $status_z = "";
  $fecbaj_z = "";
  $idtaller_z  = 0;
  $accionok_z = "";
  if(isset($_POST['modo'])) {
    $accionok_z = $_POST['modo'] . "_ok";
  }

  
  if(isset($_POST['nombre'])) {
      $nombre_z = $_POST['nombre'];
  }
  if(isset($_POST['representante'])) {
      $representante_z = $_POST['representante'];
  }
  if(isset($_POST['clave'])) {
      $clave_z = $_POST['clave'];
  }
  if(isset($_POST['idtaller'])) {
      $idtaller_z = $_POST['idtaller'];
  }
  if(isset($_POST['direc'])) {
      $direc_z = $_POST['direc'];
  }
  if(isset($_POST['giro'])) {
      $giro_z = $_POST['giro'];
  }
  if(isset($_POST['telefono'])) {
      $telefono_z = $_POST['telefono'];
  }
if(isset($_POST['status'])) {
      $status_z = $_POST['status'];
  }
  if(isset($_POST['fecbaj'])) {
      $fecbaj_z = $_POST['fecbaj'];
  }
?>
<div class="table-responsive">
<table class="table table-hover"  bordercolor = "#0000FF" border="8" cellpadding="1" cellspacing="1">
<tr>
<td  bgcolor= "#00FFFF" align="center">
  <?php 
  if( $accionok_z  == "eliminar_ok") { 
     $title_z = "Seguro de Eliminar este Taller?";
   } else { 
    $title_z = "Teclee los datos del Taller"; 
   } 
   echo $title_z;
   ?>
  </td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form"  action="servicios_talleres.php" method="post" >
  <?php
    echo input_en_row("clave", "text", "Clave:", $clave_z, "5", ""); 
    echo input_en_row("nombre", "text", "Nombre:", $nombre_z, "50", ""); 
    echo input_en_row("representante", "text", "Representante:", $representante_z, "50", ""); 
    echo input_en_row("direc", "text", "Direccion:", $direc_z, "50", ""); 
    echo input_en_row("telefono", "text", "Telefono:", $telefono_z, "50", ""); 
    echo input_en_row("giro", "text", "Giro:", $giro_z, "50", "");
    $funcion_z = "onchange=\"getComboStatus(this)\"";
    if($status_z == 1) {
      $miestat_z = "ACTIVO";
    } else {
      $miestat_z = "BAJA";
      
    }
    echo opciones_en_list("status", array("ACTIVO", "BAJA"), "Status:", $miestat_z, $funcion_z);
    echo input_en_row("fecbaj", "date", "Fecha Baja:", $fecbaj_z, "30", ""); 
  ?>
   <input type ="hidden" name="idtaller" value="<?php echo $idtaller_z; ?>" >
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
