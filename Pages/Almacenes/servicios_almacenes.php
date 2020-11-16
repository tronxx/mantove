<?php
	$clave_z = "";
	$nombre_z = "";
	$idalmacen_z = -1;
    $archivo_z = "../../php/ejecuta_query.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "php/ejecuta_query.php";
	}
	require_once($archivo_z);
	if(isset($_POST['idalmacen'])) { $idalmacen_z = $_POST['idalmacen']; }
	if(isset($_POST['clave'])) { $clave_z = $_POST['clave']; }
	if(isset($_POST['nombre'])) { $nombre_z = $_POST['nombre']; }
	$conn=conecta();
	$clave_z = mysqli_real_escape_string($conn,(strip_tags($clave_z,ENT_QUOTES)));
	$nombre_z = mysqli_real_escape_string($conn,(strip_tags($nombre_z,ENT_QUOTES)));


	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if($modo_z == 'agregar_ok') {
            agrega_almacenes($clave_z, $nombre_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_almacen($idalmacen_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_almacenes($idalmacen_z, $clave_z, $nombre_z);
        } 
	}
	if(isset($_POST['cancelar'])) {
		echo "<script>";
		echo "window.location = 'almacenes.php';";
		echo "</script>";
	    // En Cualquier otro caso me regreso al Main
	}


	function busca_almacenes() {
		$conn=conecta();
		$sql = "select idalmacen, clave, nombre from almacenes order by clave";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    
	function agrega_almacenes($clave_z, $nombre_z) {
		$conn=conecta();
		$idalmacen_z = 0;
		$sql =  sprintf("insert into almacenes (clave, nombre, direccion, idciudad, idestado) 
		  values ('%s', '%s', 0, 0, 1)",  $clave_z, $nombre_z);
		//echo "Sql:". $sql . "<br>";
		  
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			alertas ("Error: No se pudo agregar registro:". $sql );
		};
		mysqli_close($conn);
		alertas_almacenes("Almacen Agregado:");
		return (0);
	}

	function modifica_almacenes($idalmacen_z, $clave_z, $nombre_z) {
		$conn=conecta();
		$sql =  sprintf("update almacenes  set clave='%s', nombre='%s' where idalmacen=%s", 
		$clave_z, $nombre_z, $idalmacen_z);
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo Modificar registro";
		};
		mysqli_close($conn);
		alertas_almacenes("Almacen Modificado");
		return (0);
	}


	function elimina_almacen($idalmacen_z) {
		$conn=conecta();
		$sql =  sprintf("delete from almacenes where idalmacen = %s", $idalmacen_z);
		//echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_almacenes("Almacen Eliminado");
		return (0);
	}

	function alertas_almacenes($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = './almacenes.php';";
		echo "</script>";
	}
?>

