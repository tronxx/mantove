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
  $numero_z =  $_POST['idzona'];
  $nombre_z =  $_POST['zona'];
?>
<div class="table-responsive">
<table class="table table-hover" border="1">
<tr>
<td align="center">Teclee los datos de la Zona</td>
</tr>
<tr>
<td>
<div class="container">
<form class="form-inline" role="form"  action="../Zonas/modificarzona.php" method="post" >
  <div class="form-group">
    
    <?php 
      echo  "<div class=\"form-group\">";
      echo "<label for=\"numero\">Numero:</label>";
      echo "<input type=\"number\"  readonly class=\"form-control\" id=\"numero\" name=\"numero\" value = \"" . $numero_z . "\" >";
      echo "</div>";
      echo  "<div class=\"form-group\">";
      echo "<label for=\"nombre\">Nombre:</label>";
      echo "<input type=\"text\"  class=\"form-control\" id=\"nombre\" name=\"nombre\" value = \"" . $nombre_z . "\" >";
      echo "</div>";
    ?>
  <br>
  <div class="form-group">
   <div class="col-md-12 text-center">
  <button type="submit" class="btn btn-primary btn-lg">  Aceptar</button>
  </div>
  </div>
</form>
</td>
</tr>
</td>
</tr>
</table>
</div>

</body>
</html>
