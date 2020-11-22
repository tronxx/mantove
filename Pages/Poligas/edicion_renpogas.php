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
  function busca_kmtant() {
    var vehiculos = document.getElementById("idvehiculo");
    var fecnota_z = document.getElementById("fecnota");
    var kmtact_z = document.getElementById("kmtact");
    var kmtant_z = document.getElementById("kmtant");
    var options=document.getElementsByTagName("option");
    var data = {};
    data['idvehiculo'] = vehiculos.value;
    data['fechanota'] = fecnota_z.value;
    kmtant_z.value = 0;
    var url = "http://localhost/mantove/Pages/Common/busca_datos.php";
    url += "?idvehiculo="+vehiculos.value;
    url += "&fechanota="+fecnota_z.value;
    url += "&modo=BUSCA_ULTIMO_KMT";
    $.getJSON(url, function (data) {
      $.each(data, function (key, entry) {
        kmtant_z.value = entry.KMTACT;
        //kmtant_z.value = 200;
        kmtact_z.value = entry.KMTACT;
      })
    });
    kmtact_z.value = parseInt(kmtant_z.value);
    actualiza_recorre();
    actualiza_litros();
  }

  function actualiza_recorre() {
    var kmtact_z = document.getElementById("kmtact");
    var kmtant_z = document.getElementById("kmtant");
    var recorre_z = document.getElementById("recorr");
    var rec_z = 0;
    rec_z = kmtact_z.value - kmtant_z.value;
    recorre_z.value = rec_z;
  }

  function busca_preciolitro() {
    var tipocombus = document.getElementById("tipocombustible");
    var fecnota_z = document.getElementById("fecnota");
    var preciocom_z = document.getElementById("prelit");
    var options=document.getElementsByTagName("option");
    var data = {};
    data['idcombustible'] = tipocombus.value;
    data['fechanota'] = fecnota_z.value;
    preciocom_z.value = tipocombus.value;
    var url = "../Common/busca_datos.php";
    url += "?idcombustible="+tipocombus.value;
    url += "&fechanota="+fecnota_z.value;
    url += "&modo=BUSCA_PRECIO_GAS";
    $.getJSON(url, function (data) {
      $.each(data, function (key, entry) {
        preciocom_z.value = entry.precio;
      })
    });

  }

  function actualiza_litros() {
    var importe_z = document.getElementById("importe");
    var preciocom_z = document.getElementById("prelit");
    var litros_z = document.getElementById("litros");
    var rendto_z = document.getElementById("rendto");
    var recorre_z = document.getElementById("recorr");
    var nulit_z = 0;
    var rend_z = 0;
    nulit_z = Math.round(importe_z.value / preciocom_z.value * 100 ) / 100 ;
    litros_z.value = nulit_z;
    rend_z = Math.round(recorre_z.value / nulit_z * 100) / 100;
    rendto_z.value = rend_z;
  }

  function inicializa() {
    busca_kmtant();
    actualiza_recorre();
    busca_preciolitro();
    actualiza_litros();
  }

  window.onload = inicializa;

}
//-->
</script>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Datos de la Poliza de Gasolina</title>
</head>
<body>
<?php 
  require_once("../Common/componentes.php");
  require_once('../../php/ejecuta_query.php');
  $idpoligas_z = 0;
  $accionok_z = "";
  $fechanota_z = date("Y") . "-". date("m") . "-" . date("d");
  $idcombustible_z = 0;
  $idvehiculo_z = 1;
  $idtipopago_z = 1;
  $preciolitro_z = 1;

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
    $fechanota_z = $_POST['fecha'];
  }
  if(isset($_POST['Cerrar'])) {
    $accionok_z = $_POST['Cerrar'] . "_ok";
  } 
?>
<div class="table-responsive">
<table class="table table-hover"  bordercolor = "#0000FF" border="8" cellpadding="1" cellspacing="1">
<tr>
<td  bgcolor= "#00FFFF" align="center">
  <?php 
  if( $accionok_z  == "eliminar_ok") { 
     $title_z = "Seguro de Eliminar este Renglon de  Poliza de Gasolina?";
   } elseif ($accionok_z  == "Cerrar_poligas_ok") {
      $title_z = "Seguro de Cerrar esta Poliza de Gasolina?";
   } else { 
    $title_z = "Teclee los datos del Renglon de Poliza de Gasolina"; 
   } 
   echo $title_z;
   ?>
  </td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form"  action="servicios_renpogas.php" method="post" >
  <div class="form-group">
    <div class="container">
    <?php 
      if ( $accionok_z == "Cerrar_poligas_ok" ) {

      } else {
        echo input_en_row("fecnota", "date", "Fecha Nota:", $fechanota_z, "30", ""); 
        echo caja_tipospago ($idtipopago_z);
        $funcion_z = " onChange=\"busca_kmtant()\" ";
        echo caja_vehiculos ($idvehiculo_z, $funcion_z);
        $kmtant_z = 0;
        $kmtact_z = $kmtant_z;
        $idtipocombustible_z = 1;
        $prelit_z = 18;
        $importe_z = 18;
        $idzona_z = 1;
        $idchofer_z = 1;
        $litros_z = 1;
        $funcion_z = " onChange=\"busca_preciolitro()\" ";
        echo caja_tipocombustibles ($idtipocombustible_z, $funcion_z);
        echo input_en_row("prelit", "number", "Precio x Litro:", $preciolitro_z, "4", " readonly "); 
        echo input_en_row("kmtant", "number", "Kilometraje Anterior:", $kmtant_z, "4"," readonly ");
        echo input_en_row("kmtact", "number", "Kilometraje Actual:", $kmtact_z, "4", " onchange=\"actualiza_recorre()\" ");
        echo input_en_row("recorr", "number", "Recorrido:", $kmtant_z, "4", " readonly "); 
        $ff_z = 'min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency"  onchange="actualiza_litros()" ';

        echo input_en_row("importe", "number", "Importe:", $importe_z, "12", $ff_z); 
        echo input_en_row("litros", "number", "Litros:", $litros_z, "12", " readonly "); 
        echo input_en_row("rendto", "number", "Rendimiento:", "0", "12", " readonly "); 
        echo caja_zonas ($idzona_z); 
        echo caja_choferes ($idchofer_z); 
      }
      $cadena_z = "<input type =\"hidden\" name=\"idpoligas\" value=\"". $idpoligas_z  . "\" >";
      echo $cadena_z;

    ?>
  </div>
  <div class="form-group">
    <div class="col-md-12 text-center">
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

