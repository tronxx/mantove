<?php 
	/**
	* Archivo que redirecciona al contenido que se va incrustar dentro de la header y el footer
	* Autor: Elivar Largo
	* Sitio Web: wwww.ecodeup.com
	**/
	if(isset($_GET['menu'])) {
		$menu_z = $_GET['menu'];
	} else {
		$menu_z = 'logo';
	}
	
	if ($menu_z =='registrar') {
		require_once('Clientes/registrar.php');
	} if ($menu_z =='mostrar') {
		require_once('Clientes/mostrar.php');
	} if ($menu_z=='zonas') {
		require_once('Pages/Zonas/zonas.php');
	} if ($menu_z=='almacenes') {
		require_once('Pages/Almacenes/almacenes.php');
	} if ($menu_z=='ciudades') {
		require_once('Pages/Ciudades/ciudades.php');
	} if ($menu_z=='choferes') {
		require_once('Pages/Choferes/choferes.php');
	} if ($menu_z=='combustibles') {
		require_once('Pages/Combustibles/combustibles.php');
	} if ($menu_z=='marcas') {
		require_once('Pages/Marcas/marcas.php');
	}  if ($menu_z=='talleres') {
		require_once('Pages/Talleres/talleres.php');
	}  if ($menu_z=='mantenimientos') {
		require_once('Pages/Mantenimientos/mantenimientos.php');
	}  if ($menu_z=='tipospago') {
		require_once('Pages/Tipospago/tipospago.php');
	}  if ($menu_z=='poligas') {
		require_once('Pages/Poligas/poligas.php');
	}  if ($menu_z=='tipovehiculos') {
		require_once('Pages/Tipovehiculos/tipovehiculos.php');
	}  if ($menu_z=='vehiculos') {
		require_once('Pages/Vehiculos/vehiculos.php');
	} if($menu_z == 'logo') {
		require_once('logo/despliegalogo.php');
	} if ($menu_z=='polser') {
		require_once('Pages/Polser/polser.php');
	}

	 
 ?>