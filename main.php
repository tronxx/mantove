<?php 
	//carga la plantilla con la header y el footer
	$status = session_status();
	if($status == PHP_SESSION_NONE){
	  //There is no active session
		session_start();
	}
	if(!isset($_SESSION['usuario'])){
		header("location: Pages/Login/login.php");
	 } else {
		//require_once('Layouts/layout.php');	
		header("location: Pages/Common/menu.php");
		//require_once('Pages/Common/menu.php');	
	}
?>