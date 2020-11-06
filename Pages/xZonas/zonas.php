<html>
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
	<script src="../../js/jquery-1.7.2.min.js" type="text/javascript"></script>
	<script src="../../js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="../../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	<script type="text/javascript">
jQuery(document).ready(function(){ 
  jQuery("#grid").jqGrid({
      url:'../Common/busca_datos.php?modo=BUSCA_ZONAS',
      datatype: "json",
      mtype: 'GET',
      colNames:['Numero', 'Zona'],
      colModel:[
                {name:'idzona',index:'id', width:55, sortable:false, editable:false, editoptions:{readonly:true,size:10}},
                {name:'zona',index:'zona', width:200,editable:true},
           ],
      jsonReader : {
          repeatitems:false
      },
      rowNum:10,
      rowList:[10,20,30],
      pager: jQuery('#gridpager'),
      sortname: 'name',
      viewrecords: true,
      sortorder: "asc",
      caption:"Zonas",
      editurl:"servicios_zonas.php"
 }).navGrid('#gridpager');
});
</script>

</head>
<h1>Zonas</h1>
<div class="container">
<form action="edicion_zona.php" method="post">
<div class="table-responsive">
<table class="table table-hover">
<tr>
<td>
<input type="hidden" name="modo" value="agregar">
<button type="submit" class="btn btn-primary" name="Agregar" value ="Agregar">Agregar</button></td>
</tr>
</table>
</div>
</form>
<br>
<div id="jqgrid">
    <table id="grid"></table>
    <div id="gridpager"></div>
</div>
<?php 

  function boton_modificar($idzona_z, $zona_z) {
	$cadena_z = "<form action=\"edicion_zona.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idzona\" value=\"". $idzona_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"zona\" value=\"". $zona_z  . "\" >";
	$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }

?>
