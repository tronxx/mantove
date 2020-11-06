<h1>Lista de Zonas</h1>
<?php 
	//carga la plantilla con la header y el footer
	require_once('php/ejecuta_query.php');	
    $zonas_z = json_decode(busca_zonas());

 ?>
<div class="container">
<form action="Zonas/Altazonas.php" method="post">
<div class="table-responsive">
<table class="table table-hover">
<tr>
<td><button type="submit" class="btn btn-primary" name="Agregar" value ="Agregar">Agregar</button></td>
</tr>
</table>
</div>
</form>
<br>

	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Zona</th>
					<th>Nombre</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($zonas_z as $mizona_z) {
				   echo "<tr>";
				  echo "<td>" . $mizona_z->idzona   . "</td>";
				  echo "<td>" . $mizona_z->zona . "</td>";
				  echo "<td>";
				  echo "<form action=\"Zonas/Editarzonas.php\" method=\"post\">";
				  echo "<input type =\"hidden\" name=\"idzona\" value=\"". $mizona_z->idzona  . "\" >";
				  echo "<input type =\"hidden\" name=\"zona\" value=\"". $mizona_z->zona  . "\" >";
				  echo "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modificar\">Modificar</button>";
				  echo "</form>";
				  echo "</td>";
				  echo "<td>";
				  $cadena_z = "<form action=\"Zonas/eliminarzona.php\" method=\"post\">";
				  $cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idzona\" value=\"". $mizona_z->idzona  . "\" >";
				  $cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-danger\"  name=\"eliminar\">Eliminar</button>";
				  $cadena_z = $cadena_z . "</form>";
				  echo $cadena_z;
				  echo "</td>";
				  echo "</tr>";
				  echo "\n";
			   }
			?>
			</tbody>
		</table>
	</div>
</div>