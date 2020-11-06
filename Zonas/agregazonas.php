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
	//carga la plantilla con la header y el footer
	require_once('../php/ejecuta_query.php');
	$numero_z = $_POST['numero'];
	$nombre_z = $_POST['nombre'];
	echo "Voy a agregar la Zona: " . $nombre_z;
	inserta_zona($numero_z, $nombre_z);
	$mensaje = "Zona Agregada";
	echo "<script>";
	echo "alert('$mensaje');";
	echo "window.location = '../index.php?menu=zonas';";
	echo "</script>";
 ?>
</body>
</html>
