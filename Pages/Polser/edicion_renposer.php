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
    var fecnota_z = document.getElementById("fecha");
    var kmtact_z = document.getElementById("kmtact");
    var servicios_z = document.getElementById("idservmanto");
    var data = {};
    data['idvehiculo'] = vehiculos.value;
//    data['fechanota'] = fecnota_z.value;
    var url = "../Common/busca_datos.php";
    url += "?idvehiculo="+vehiculos.value;
    url += "&fechanota="+fecnota_z.value;
    url += "&modo=BUSCA_ULTIMO_KMT";
    $.getJSON(url, function (data) {
      $.each(data, function (key, entry) {
        kmtact_z.value = entry.KMTACT;
      })
    });
  }

  function busca_servop() {
    var servicios_z = document.getElementById("idservmanto");
    var lblserv_z = document.getElementById("lbl_edotoggle");
    var listoggle_z = document.getElementById("edotoggle");
//    data['fechanota'] = fecnota_z.value;
    var url = "../Common/busca_datos.php";
    url += "?idservmanto="+servicios_z.value;
    url += "&modo=BUSCA_SERVOP";
    $.getJSON(url, function (data) {
      $.each(data, function (key, entry) {
        if (entry.toggle == "N") {
          lblserv_z.style = "display:none";
          listoggle_z.style = "display:none";
        } else {
          lblserv_z.innerHTML = entry.servop;
          lblserv_z.style = "display:block";
          listoggle_z.style = "display:block";
        }
      })
    });
  
  }

  function busca_alertas() {
    var vehiculos_z = document.getElementById("idvehiculo");
    var fecnota_z = document.getElementById("fecha");
    var mitabla_z = document.getElementById("tablaproxser");
    var url = "../Common/busca_datos.php";
    url += "?idvehiculo="+vehiculos_z.value;
    url += "&fecha="+fecnota_z.value;
    url += "&modo=BUSCA_SIGSERV";
    var row;
    var cell;
    var renglones_z;
    var cuantos_z;
    var header_z;
    var textoCelda_z;
    var tbody_z;
    $.getJSON(url, function (data) {
      renglones_z=mitabla_z.rows.length;
      for(ii_z = renglones_z; ii_z > 1; ii_z--) {
            mitabla_z.deleteRow(1);
      }
      ii_z = 0;
      cuantos_z = Object.keys(data).length;
      tbody_z= mitabla_z.body;
      $.each(data, function (key, entry) {
           row = document.createElement("tr");
           cell = document.createElement("td");
           textoCelda_z = document.createTextNode(entry.clave);
           cell.appendChild(textoCelda_z);
           row.appendChild(cell);
           cell = document.createElement("td");
           textoCelda_z = document.createTextNode(entry.descri);
           cell.appendChild(textoCelda_z);
           row.appendChild(cell);
           cell = document.createElement("td");
           textoCelda_z = document.createTextNode(entry.ultimo);
           cell.appendChild(textoCelda_z);
           row.appendChild(cell);
           cell = document.createElement("td");
           textoCelda_z = document.createTextNode(entry.proximo);
           cell.appendChild(textoCelda_z);
           row.appendChild(cell);
           cell = document.createElement("td");
           textoCelda_z = document.createTextNode(entry.urgente);
           cell.appendChild(textoCelda_z);
           row.appendChild(cell);
           mitabla_z.appendChild(row);
      })

      if (cuantos_z > 0) {
        $('#myModal').modal('show');
      }
    });

  }

  function inicializa() {
    busca_kmtant();
    busca_servop();
  }

  window.onload = inicializa;

}
//-->
</script>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Datos del Movimiento de Servicio</title>
</head>
<body>
<?php 
  require_once("../Common/componentes.php");
  require_once('../../php/ejecuta_query.php');
  $idpoligas_z = 0;
  $idrenposer_z = -1;
  $idpolser_z = -1;
  $accionok_z = "";
  $fechanota_z = date("Y") . "-". date("m") . "-" . date("d");
  $idvehiculo_z = 1;
  $kmtact_z = 1;
  $idservmanto_z = 1;
  $idtaller_z = 1;

  if(isset($_POST['modo'])) {
    $accionok_z = $_POST['modo'] . "_ok";
  } 
  if(isset($_POST['idrenposer'])) {
    $idrenposer_z = $_POST['idrenposer'];
  } 
  if(isset($_POST['idpolser'])) {
    $idpolser_z = $_POST['idpolser'];
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
  if( $accionok_z  == "eliminar_renglon_ok") { 
     $title_z = "Seguro de Eliminar este Movimiento de  Poliza de Servicio?";
   } elseif ($accionok_z  == "Cerrar_polser_ok") {
      $title_z = "Seguro de Cerrar esta Poliza de Servicio?";
   } else { 
     $title_z = "Teclee los datos del movimiento de Poliza de Servicio"; 
   } 
   echo $title_z;
   ?>
  </td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form"  action="servicios_renposer.php" method="post" >
  <div class="form-group">
    <div class="container">
    <?php 
      if ( $accionok_z == "Cerrar_polser_ok" ) {

      } else {
        $cadena_z = "<input type =\"hidden\" id=\"fecha\"  name=\"fecha\" value=\"". $fechanota_z  . "\" >";
        echo $cadena_z;
        $funcion_z = " onChange=\"busca_kmtant()\" onblur=\"busca_alertas()\" ";
        echo caja_vehiculos ($idvehiculo_z, $funcion_z);
        echo caja_choferes ($idchofer_z); 
        $importe_z = 18;
        $idchofer_z = 1;
        $idtaller_z = 1;
        $funcion_z = " onChange=\"busca_servop()\" ";
        echo caja_servicios ($idservmanto_z, $funcion_z);
        $funcion_z = "";
        $opciones_z = array("SI", "NO");
        echo opciones_en_list("edotoggle", $opciones_z, "Estado", "SI", "");
        $funcion_z = "";
        echo caja_talleres ($idtaller_z, $funcion_z); 
        echo input_en_row("kmtact", "number", "Kilometraje:", $kmtact_z, "4", "");
         $ff_z = 'min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency"';
        echo input_en_row("importe", "number", "Importe:", $importe_z, "12", $ff_z); 
        echo caja_zonas ($idzona_z); 
        echo input_en_text("observs", "", "Observaciones:", "observaciones", " rows=\"10\" cols=\"40\" ", ""); 
      }
      $cadena_z = "<input type =\"hidden\" name=\"idpolser\" value=\"". $idpolser_z  . "\" >";
      $cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idrenposer\" value=\"". $idrenposer_z  . "\" >";
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

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Proximos Servicios</h4>
        </div>
        <div class="modal-body">
         <img    style="width:150px" src="../../imagenes/servicio_carro.png" />
         <table border="1" id="tablaproxser">
         <thead>
         <tr>
         <th>Clave</th>
         <th>Descripcion</th>
         <th>Ultimo</th>
         <th>Proximo</th>
         <th>Urgente</th>
         </tr>
         </thead>
         <tbody>
         </tbody>
         </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

        </div>
      </div>
      
    </div>
  </div>

</body>
</html>

