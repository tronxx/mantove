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
<script src="vehiculos.js" type="text/javascript"></script>


<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Datos del Vehiculo</title>
</head>
<body>
<?php 
  require_once("../Common/componentes.php");
	$idvehiculo_z = 0;
	$codigo_z = 0;
	$descripcion_z = "";
	$idtipoveh_z = 0;
	$idmarca_z = 0;
  $modelo_z = "";
  $fecing_z = date("Y") . "-". date("m") . "-" . date("d");
  $baja_z = date("Y") . "-". date("m") . "-" . date("d");
  $status_z = "A";
  $placas_z = "";
  $chasis_z = "";
  $sermot_z = "";
  $maxtac_z = 0;
  $kilom_z = 0;
  $tacacu_z = 0;
  $nvohasta_z = 0;
  $nvousa_z = 0;
  $idcombustible_z = 0;
  $caractm_z = "";
  $tipllanta_z = "";
  $bateria_z = "";
  $polseg_z = "";
  $venpol_z = date("Y") . "-". date("m") . "-" . date("d");
  $idchofer_z = 0;
  $camtac_z = "";
  $kmtcamtac_z = 0;
  $fecamtac_z = date("Y") . "-". date("m") . "-" . date("d");
  $idzona_z = 0;
  $cia_z = 0;
  $accionok_z = "";
  $modo_z = "";

  if(isset($_POST['modo'])) {
    $modo_z = $_POST['modo'];
    $accionok_z = $modo_z  . "_ok";
  }
  if(isset($_POST['codigo'])) {
    $codigo_z = $_POST['codigo'];
  }
  if(isset($_POST['idvehiculo'])) {
    $idvehiculo_z = $_POST['idvehiculo'];
  }
?>
<div class="table-responsive">
<table class="table table-hover"  bordercolor = "#0000FF" border="8" cellpadding="1" cellspacing="1">
<tr>
<td  bgcolor= "#00FFFF" align="center">
<?php 
  require_once("../Common/componentes.php");
  if( $accionok_z  == "eliminar_ok") { 
     $title_z = "Seguro de Eliminar este Vehiculo ?";
   } else { 
    $title_z = "Teclee los datos del Vehiculo"; 
   } 
   echo $title_z;
?>
  </td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form" name="edvehiculos" action="servicios_vehiculos.php" method="post" >
  <div class="form-group">
  <?php 
    carga_datos_vehiculo($idvehiculo_z);
    echo input_en_row("codigo", "text", "Codigo:", $codigo_z, "4", ""); 
    echo input_en_row("descripcion", "text", "Descripcion:", $descripcion_z, "50", ""); 
    echo caja_marcas ($idmarca_z);
    echo caja_zonas ($idzona_z);
    echo input_en_row("fecing", "date", "Fecha Ingreso:", $fecing_z, "30", ""); 
    echo input_en_row("modelo", "text", "A&ntilde;o Modelo:", $modelo_z, "4", ""); 
    echo input_en_row("placas", "text", "Placas:", $placas_z, "10", ""); 
    echo input_en_row("chasis", "text", "Chasis:", $chasis_z, "20", ""); 
    echo input_en_row("sermot", "text", "Serie del Motor:", $sermot_z, "30", ""); 
    echo input_en_row("caractm", "text", "Caracteristicas del Motor:", $caractm_z, "20", ""); 
    echo input_en_row("tipllanta", "text", "Tipo de Llantas:", $tipllanta_z, "20", ""); 
    echo input_en_row("bateria", "text", "Tipo de Bateria:", $bateria_z, "20", ""); 
    echo input_en_row("polseg", "text", "Poliza de Seguro:", $polseg_z, "20", ""); 
    echo input_en_row("venpol", "date", "Fecha Vencimiento:", $venpol_z, "30", ""); 
    echo caja_choferes ($idchofer_z);
    echo input_en_row("maxtac", "number", "Kms Maximo del Tacometro:", $maxtac_z, "10", ""); 
    echo input_en_row("kilom", "number", "Kilometraje Actual:", $kilom_z, "10", ""); 
    echo input_en_row("tacacu", "number", "Kilometraje Acumulado:", $tacacu_z, "10", ""); 
    echo input_en_row("nvohasta", "number", "Se considera Nuevo hasta el Kilometraje:", $nvohasta_z, "10", ""); 
    echo caja_tipovehiculos ($idtipoveh_z);
    echo caja_tipocombustibles ($idcombustible_z, "");
    $funcion_z = "onchange=\"getComboStatus(this)\"";
    echo opciones_en_list("status", array("ACTIVO", "BAJA"), "Status:", $status_z, $funcion_z); 
    echo input_en_row("fecbaj", "date", "Fecha Baja:", $baja_z, "30", ""); 
  ?>
  </div>
  <div class="modal-footer">

    <input type ="hidden" name="idvehiculo" value="<?php echo $idvehiculo_z; ?>" >
    <button type="submit" name="modo" value="<?php echo $accionok_z; ?>" class="btn btn-primary btn-lg">Aceptar</button>
    <button type="submit" name="cancelar" value="cancelar" class="btn btn-danger btn-lg">Cancelar</button>
   </div>
</div>
</form>
</td>
</tr>
</table>
</div>
<?php 

function carga_datos_vehiculo($idvehiculo_z) {
	global $idvehiculo_z,
	$codigo_z,
	$descripcion_z,
	$idtipoveh_z,
	$idmarca_z,
  $modelo_z,
  $fecing_z,
  $baja_z,
  $status_z,
  $placas_z,
  $chasis_z,
  $sermot_z,
  $maxtac_z,
  $kilom_z,
  $tacacu_z,
  $nvohasta_z,
  $nvousa_z,
  $idcombustible_z,
  $caractm_z,
  $tipllanta_z,
  $bateria_z,
  $polseg_z,
  $venpol_z,
  $idchofer_z,
  $camtac_z,
  $kmtcamtac_z,
  $fecamtac_z,
  $idzona_z;

  $vehiculos_z = json_decode(busca_mi_vehiculo($idvehiculo_z));
  foreach ($vehiculos_z as $mivehiculo_z) {
    $codigo_z = $mivehiculo_z->codigo;
    $descripcion_z = $mivehiculo_z->descri;
    $idtipoveh_z = $mivehiculo_z->idtipovehiculo;
    $idmarca_z = $mivehiculo_z->idmarcaveh;
    $modelo_z = $mivehiculo_z->modelo;
    $fecing_z = $mivehiculo_z->fecing;
    $baja_z = $mivehiculo_z->fecbaj;
    $status_z = $mivehiculo_z->status;
    $placas_z = $mivehiculo_z->placas;
    $chasis_z = $mivehiculo_z->chasis;
    $sermot_z = $mivehiculo_z->sermot;
    $maxtac_z = $mivehiculo_z->maxtac;
    $kilom_z = $mivehiculo_z->kilom;
    $tacacu_z = $mivehiculo_z->tacacu;
    $nvohasta_z = $mivehiculo_z->nvohasta;
    $nvousa_z = $mivehiculo_z->nvousa;
    $idcombustible_z = $mivehiculo_z->tipogas;
    $caractm_z = $mivehiculo_z->caractm;
    $tipllanta_z = $mivehiculo_z->tipllanta;
    $bateria_z = $mivehiculo_z->bateria;
    $polseg_z = $mivehiculo_z->polseg;
    $venpol_z = $mivehiculo_z->venpol;
    $idchofer_z = $mivehiculo_z->idchofer;
    $camtac_z = $mivehiculo_z->camtac;
    $kmtcamtac_z = $mivehiculo_z->kmtcamtac;
    $fecamtac_z = $mivehiculo_z->fecamtac;
    $idzona_z = $mivehiculo_z->zona;
    $cia_z = $mivehiculo_z->cia;
  }
  

}

?>
</body>
</html>
