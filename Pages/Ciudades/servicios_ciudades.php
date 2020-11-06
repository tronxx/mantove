<?php
	$ciudad_z = "";
    $idciudad_z = 0;
    $archivo_z = "../../php/ejecuta_query.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "php/ejecuta_query.php";
	}
	require_once($archivo_z);

	if(isset($_POST['idciudad'])) {
        $idciudad_z = $_POST['idciudad'];
    }
	if(isset($_POST['ciudad'])) {
        $ciudad_z = $_POST['ciudad'];
    }
    
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if($modo_z == 'agregar_ok') {
            agrega_ciudades($ciudad_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_ciudad($idciudad_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_ciudades($idciudad_z, $ciudad_z);
        } 

	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = 'ciudades.php';";
			echo "</script>";
	}

    
	function agrega_ciudades($ciudad_z) {
		$conn=conecta();
		$sql =  sprintf("insert into ciudades (ciudad) 
          values ('%s')",  $ciudad_z);
        //echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_ciudad("Ciudad Agregada");
		return (0);
	}

	function modifica_ciudades($idciudad_z, $ciudad_z) {
		$conn=conecta();
		$sql =  sprintf("update ciudades set ciudad='%s' where idciudad=%s", 
		    $ciudad_z, $idciudad_z);
		//echo "sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_ciudad("Ciudad Modificada ");
		return (0);
	}

	function busca_ciudades() {
		$conn=conecta();
		$sql = "select idciudad, ciudad from ciudades order by ciudad";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }


	function elimina_ciudad($idciudad_z) {
		$conn=conecta();
		$sql =  sprintf("delete from ciudades where idciudad = %s", $idciudad_z);
		//echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_ciudad("Ciudad Eliminada");
		return (0);
	}

	function alertas_ciudad($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = 'ciudades.php';";
		echo "</script>";
	}
?>

