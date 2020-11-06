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
<script language="JavaScript" type="text/javascript">
{
  function getComboA(selectObject) {
    var selector_z = document.getElementById("perio");
    var selector =  selector_z.value; 
    switch(selector){
      case "SI":
        $("#kmofe").prop('disabled', false);
        $("#xcada").prop('disabled', false);
        $("#xcadanvo").prop('disabled', false);
        $("#toler").prop('disabled', false);
        $("#toggle").prop('disabled', false);
        $("#servop").prop('disabled', false);
        break;
      case "NO":
        $("#kmofe").prop('disabled', true);
        $("#xcada").prop('disabled', true);
        $("#xcadanvo").prop('disabled', true);
        $("#toler").prop('disabled', true);
        $("#toggle").prop('disabled', true);
        $("#servop").prop('disabled', true);
        break;
    }
  }

  function getComboToggle(selectObject) {
    var selector_z = document.getElementById("toggle");
    var selector =  selector_z.value; 
    switch(selector){
      case "SI":
        $("#servop").prop('disabled', false);
        break;
      case "NO":
        $("#servop").prop('disabled', true);
        break;
    }
  }

  function inicializa() {
    getComboA();
    getComboToggle();
  }

  window.onload = inicializa;

}
//-->
</script>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Datos de Servicio de Mantenimiento</title>
</head>
<body>
<?php 
	$clave_z = "";
	$descripcion_z = "";
	$idtipoveh_z = 0;
    $idmantenimiento_z = 0;
    $perio_z = "";
    $kmofe_z = "";
    $xcada_z = 0;
    $xcadanvo_z = 0;
    $toler_z = 0;
  	$toggle_z = "";
  	$servop_z = "";
    $accionok_z = "";
  if(isset($_POST['modo'])) {
    $accionok_z = $_POST['modo'] . "_ok";
  }

if(isset($_POST['descripcion'])) {
    $descripcion_z = $_POST['descripcion'];
}
if(isset($_POST['idtipoveh'])) {
    $idtipoveh_z = $_POST['idtipoveh'];
}
if(isset($_POST['clave'])) {
    $clave_z = $_POST['clave'];
}
if(isset($_POST['idmantenimiento'])) {
    $idmantenimiento_z = $_POST['idmantenimiento'];
}
if(isset($_POST['kmofe'])) {
    $kmofe_z = $_POST['kmofe'];
}
if(isset($_POST['perio'])) {
    $perio_z = $_POST['perio'];
}
if(isset($_POST['xcada'])) {
    $xcada_z = $_POST['xcada'];
}
if(isset($_POST['xcadanvo'])) {
    $xcadanvo_z = $_POST['xcadanvo'];
}
if(isset($_POST['toler'])) {
    $toler_z = $_POST['toler'];
}
if(isset($_POST['toggle'])) {
    $toggle_z = $_POST['toggle'];
}
if(isset($_POST['servop'])) {
    $servop_z = $_POST['servop'];
}
?>
<div class="table-responsive">
<table class="table table-hover"  bordercolor = "#0000FF" border="8" cellpadding="1" cellspacing="1">
<tr>
<td  bgcolor= "#00FFFF" align="center">
  <?php 
    require_once("../Common/componentes.php");
  if( $accionok_z  == "eliminar_ok") { 
     $title_z = "Seguro de Eliminar este mantenimiento?";
   } else { 
    $title_z = "Teclee los datos del mantenimiento"; 
   } 
   echo $title_z;
   ?>
  </td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form" name="edmantos" action="../Mantenimientos/servicios_mantenimientos.php" method="post" >
  <div class="form-group">
  <?php 
    if($perio_z == "S") {
      $perio_z = "SI";
    } else {
      $perio_z = "NO";
    }

    echo input_en_row("clave", "text", "Clave:", $clave_z, "3", ""); 
    echo input_en_row("descripcion", "text", "Descripcion:", $descripcion_z, "50", ""); 
    echo caja_tipovehiculos ($idtipoveh_z);
    $funcion_z = "onchange=\"getComboA(this)\" ";
    echo opciones_en_list("perio", array("SI", "NO"), "Es Periodico ?:", $perio_z, $funcion_z); 
    $funcion_z = "";
    echo opciones_en_list("kmofe", array("KILOMETROS", "DIAS"), "Es x Kilometros / Dias:", $kmofe_z, $funcion_z); 
    echo input_en_row("xcada", "number", "Cada Cuantos Kms/Dias:", $xcada_z, "4", ""); 
    echo input_en_row("xcadanvo", "number", "En Vehiculos nuevos Cada Cuantos Kms/Dias:", $xcadanvo_z, "4", ""); 
    echo input_en_row("toler", "number", "Tolerancia en Kms/Dias:", $toler_z, "4", ""); 
    $funcion_z = "onchange=\"getComboToggle(this)\" ";
    echo opciones_en_list("toggle", array("SI", "NO"), "Tiene Servicio Alternante ?:", $toggle_z, $funcion_z); 
    echo input_en_row("servop", "text", "Servicio Alternante:", $servop_z, "50", ""); 
  ?>
    <div class="row">
    <input type ="hidden" name="idmantenimiento" value="<?php echo $idmantenimiento_z; ?>" >
    <div class="col-md-12 text-center">
    <button type="submit" name="modo" value="<?php echo $accionok_z; ?>" class="btn btn-primary btn-lg">Aceptar</button>
    <button type="submit" name="cancelar" value="cancelar" class="btn btn-danger btn-lg">Cancelar</button>
   </div>
   </div>
</div>
</form>
</td>
</tr>
</table>
</div>

</body>
</html>
