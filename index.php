<?php 
	//carga la plantilla con la header y el footer
    $archivo_z = "../Pages/Login/login.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Login/login.php";
	}
	require_once($archivo_z);	
 ?>