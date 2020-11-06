<?php
    $archivo_z = "../../php/ejecuta_query.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "php/ejecuta_query.php";
	}
	require_once($archivo_z);	
    $archivo_z = "../Common/busca_datos.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Common/busca_datos.php";
	}
    require_once($archivo_z);	
    checa_sesion();

    $minumcia_z = 1;
    $micia_z = json_decode(busca_datos_cia($minumcia_z));
    foreach($micia_z as $midatocia_z) {
      $_SESSION["nomcia"] = $midatocia_z->razon;
      $_SESSION["dircia"] = $midatocia_z->dir . " ". $midatocia_z->dir2;
    }
?>

<img src="imagenes/cintillo.jpg" ><br>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">			
			<a class="navbar-brand" href="#">
			<span class="glyphicon glyphicon-cloud" aria-hidden="true" ></span>
			Mantenimiento Vehicular 
            <?php
              echo $_SESSION["nomcia"];
            ?>
			</a>
		</div>
          <br>
          <div class="nav navbar-nav">
          <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Mantenimientos<span class="caret"></span></button>
            <ul class="dropdown-menu">
            <?php 
                 $menus_z = '[
                      {"titulo":"Zonas","destino":"?menu=zonas"},
                      {"titulo":"Almacenes","destino":"?menu=almacenes"},
                      {"titulo":"Ciudades","destino":"?menu=ciudades"},
                      {"titulo":"Choferes","destino":"?menu=choferes"},
                      {"titulo":"Combustibles","destino":"?menu=combustibles"},
                      {"titulo":"Talleres","destino":"?menu=talleres"},
                      {"titulo":"Marcas de Vehiculos","destino":"?menu=marcas"},
                      {"titulo":"Tipos de pago","destino":"?menu=tipospago"},
                      {"titulo":"Tipos de Vehiculos","destino":"?menu=tipovehiculos"},
                      {"titulo":"Vehiculos","destino":"?menu=vehiculos"},
                      {"titulo":"Definicion Servicios Mantenimiento","destino":"?menu=mantenimientos"},
                      {"titulo":"Captura Polizas de Gasolina","destino":"?menu=poligas"},
                      {"titulo":"Captura Polizas de Servicios","destino":"?menu=polser"}
                 ]';
                 $mismenus_z =  json_decode($menus_z);
                 foreach ($mismenus_z as $mimenu_z) {
                      $opcion_z = "<li><a href=\"". $mimenu_z->destino . "\">".$mimenu_z->titulo . "</a></li>";
                      echo $opcion_z;
                 }
               ?>
          </ul>
	</div>
     </div>
</nav>
