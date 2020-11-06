<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Datos de la Zona</title>
</head>
<body>
<?php 
  $accion_z = $_POST['Agregar'];
?>
<div class="table-responsive">
<table class="table table-hover" border = "1">
<tr>
<td align="center"> Teclee los datos de la Zona</td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form"  action="../Zonas/agregazonas.php" method="post" >
  <div class="form-group">
    <label for="numero">Numero:</label>
    <input type="number" class="form-control" id="numero" name="numero">
    <label for="nombre">Nombre:</label>
    <input type="text" class="form-control" id="nombre" name="nombre">
   </div>
  <br>
  <div class="form-group">
   <div class="col-md-12 text-center">
  <button type="submit" class="btn btn-primary btn-lg">  Aceptar</button>
                            </div>
                        </div>
</form>
</td>
</tr>
</table>
</div>

</body>
</html>
