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
  <script src="choferes.js" type="text/javascript"></script>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php 
  require_once("../Common/componentes.php");
  $nombre_z = "";
  $apellido_z = "";
  $codigo_z = "";
  $direc_z = "";
  $telefono_z = "";
  $idciudad_z = 0;
  $status_z = "";
  $fecbaj_z = "";
  $idchofer_z  = 0;
  $accionok_z = "";
  if(isset($_POST['modo'])) {
    $accionok_z = $_POST['modo'] . "_ok";
    if( $accionok_z  == "eliminar_ok") { 
        $title_z = "Seguro de Eliminar este Chofer ?";
      } else { 
       $title_z = "Teclee los datos del Chofer"; 
      } 
    
  }
  
  $status_z = 1;

  
  if(isset($_POST['nombre'])) {
      $nombre_z = $_POST['nombre'];
  }
  if(isset($_POST['apellido'])) {
      $apellido_z = $_POST['apellido'];
  }
  if(isset($_POST['codigo'])) {
      $codigo_z = $_POST['codigo'];
  }
  if(isset($_POST['idchofer'])) {
      $idchofer_z = $_POST['idchofer'];
  }
  if(isset($_POST['direc'])) {
      $direc_z = $_POST['direc'];
  }
  if(isset($_POST['idciudad'])) {
      $idciudad_z = $_POST['idciudad'];
  }
  if(isset($_POST['telefono'])) {
      $telefono_z = $_POST['telefono'];
  }
  if(isset($_POST['status'])) {
      $status_z = $_POST['status'];
  }
  if(isset($_POST['fecbaj'])) {
      $idfecbaj_z = $_POST['fecbaj'];
  }
?>
<div class="container">
  <h2><?php echo $title_z; ?></h2>
  <div class="panel panel-default">
    <div class="panel-heading">Datos del Chofer</div>
    <div class="panel-body">

<form class="form-inline" role="form"  action="servicios_choferes.php" method="post" >
  <?php
    echo input_en_row("clave", "text", "Clave:", $codigo_z, "3", ""); 
    echo input_en_row("nombre", "text", "Nombre:", $nombre_z, "50", ""); 
    echo input_en_row("apellido", "text", "Apellido:", $apellido_z, "50", ""); 
    echo input_en_row("direc", "text", "Direccion:", $direc_z, "50", ""); 
    echo caja_ciudades($idciudad_z);
    echo input_en_row("telefono", "text", "Telefono:", $telefono_z, "50", ""); 
    $funcion_z = "onchange=\"getComboStatus(this)\"";
    if($status_z == 1) {
      $miestat_z = "ACTIVO";
    } else {
      $miestat_z = "BAJA";
      
    }
    echo opciones_en_list("status", array("ACTIVO", "BAJA"), "Status:", $miestat_z, $funcion_z);
    echo input_en_row("fecbaj", "text", "Fecha Baja:", $fecbaj_z, "30", ""); 
  ?>
  <input type ="hidden" name="idchofer" value="<?php echo $idchofer_z; ?>" >
  </div>
  <div class="modal-footer">
    <button type="submit" name="modo" value="<?php echo $accionok_z; ?>" class="btn btn-primary btn-lg">Aceptar</button>
    <button type="submit" name="cancelar" value="cancelar" class="btn btn-danger btn-lg">Cancelar</button>
	</div>
</form>
</div>

</body>
</html>
