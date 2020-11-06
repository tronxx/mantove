<?php
	$numero_z = "";
	$zona_z = "";
	$idzona_z = -1;
    $archivo_z = "../../php/ejecuta_query.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "php/ejecuta_query.php";
	}
	require_once($archivo_z);
	if(isset($_POST['idzona'])) { $idzona_z = $_POST['idzona']; }
	if(isset($_POST['numero'])) { $numero_z = $_POST['numero']; }
	if(isset($_POST['zona']))   { $zona_z   = $_POST['zona']; }
	$conn=conecta();
	$numero_z = mysqli_real_escape_string($conn,(strip_tags($numero_z,ENT_QUOTES)));
	$zona_z = mysqli_real_escape_string($conn,(strip_tags($zona_z,ENT_QUOTES)));


	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if($modo_z == 'agregar_ok') {
            agrega_zona($numero_z, $zona_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_zona($idzona_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_zona($idzona_z, $numero_z, $zona_z);
        } 
	}
	if(isset($_POST['cancelar'])) {
		echo "<script>";
		echo "window.location = 'zonas.php';";
		echo "</script>";
	    // En Cualquier otro caso me regreso al Main
	}

  
	function agrega_zona($numero_z, $zona_z) {
		$conn=conecta();
		$idzona_z = 0;
		$sql =  sprintf("insert into zonas (numero, zona) 
		  values (%s, '%s' )",  $numero_z, $zona_z);
		//echo "Sql:". $sql . "<br>";
		  
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			alertas_zonas ("Error: No se pudo agregar registro:");
		};
		mysqli_close($conn);
		alertas_zonas("Zona Agregada:");
		return (0);
	}

	function modifica_zona($idzona_z, $numero_z, $zona_z) {
		$conn=conecta();
		$sql =  sprintf("update zonas  set zona='%s' where idzona=%s", 
		$zona_z, $idzona_z);
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo Modificar registro";
		};
		mysqli_close($conn);
		alertas_zonas("Zona Modificada");
		return (0);
	}


	function elimina_zona($idzona_z) {
		$conn=conecta();
		$sql =  sprintf("delete from zonas where idzona = %s", $idzona_z);
		//echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_zonas("Zona Eliminada");
		return (0);
	}

	function alertas_zonas($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = './zonas.php';";
		echo "</script>";
	}
?>

