<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">			
			<a class="navbar-brand" href="#">
			<span class="glyphicon glyphicon-cloud" aria-hidden="true" ></span>
			Mantenimiento Vehicular 
			</a>
		</div>
          <br>
          <div class="nav navbar-nav">
          <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Mantenimientos<span class="caret"></span></button>
            <ul class="dropdown-menu">
            <?php 
                 $menus_z = '[
                      {"titulo":"Zonas","destino":"../Zonas/zonas.php"},
                      {"titulo":"Almacenes","destino":"../Almacenes/almacenes.php"},
                      {"titulo":"Ciudades","destino":"../Ciudades/ciudades.php"},
                      {"titulo":"Choferes","destino":"../Choferes/choferes.php"},
                      {"titulo":"Combustibles","destino":"../Combustibles/combustibles.php"},
                      {"titulo":"Talleres","destino":"../Talleres/talleres.php"},
                      {"titulo":"Marcas de Vehiculos","destino":"../Marcas/marcas.php"},
                      {"titulo":"Tipos de pago","destino":"../Tipospago/tipospago.php"},
                      {"titulo":"Tipos de Vehiculos","destino":"../Tipovehiculos/tipovehiculos.php"},
                      {"titulo":"Vehiculos","destino":"../Vehiculos/vehiculos.php"},
                      {"titulo":"Definicion Servicios Mantenimiento","destino":"../Mantenimientos/mantenimientos.php"},
                      {"titulo":"Captura Polizas de Gasolina","destino":"../Poligas/poligas.php"},
                      {"titulo":"Captura Polizas de Servicios","destino":"../Polser/polser.php"}
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
