<?php
	$codigo_z = "";
	$nombre_z = "";
	$apellido_z = "";
    $idchofer_z = 0;
    $idciudad_z = 0;
    $direc_z = "";
    $telefono_z = "";
    $status_z = "";
    $fecbaj_z = "";
    $archivo_z = "../../php/ejecuta_query.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "php/ejecuta_query.php";
	}
	require_once($archivo_z);

	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if(isset($_POST['nombre'])) {
            $nombre_z = $_POST['nombre'];
        }
        if(isset($_POST['apellido'])) {
            $apellido_z = $_POST['apellido'];
        }
        if(isset($_POST['clave'])) {
            $codigo_z = $_POST['clave'];
        }
        if(isset($_POST['idchofer'])) {
            $idchofer_z = $_POST['idchofer'];
        }
        if(isset($_POST['direc'])) {
            $direc_z = $_POST['direc'];
        }
        if(isset($_POST['idciudad'])) {
            $idciudad_z = $_POST['idciudad'];
        }
        if(isset($_POST['telefono'])) {
            $telefono_z = $_POST['telefono'];
        }
        if(isset($_POST['status'])) {
            $status_z = $_POST['status'];
        }
        if(isset($_POST['fecbaj'])) {
            $idfecbaj_z = $_POST['fecbaj'];
		}
		$conn=conecta();
		$codigo_z = mysqli_real_escape_string($conn,(strip_tags($codigo_z,ENT_QUOTES)));
		$nombre_z = mysqli_real_escape_string($conn,(strip_tags($nombre_z,ENT_QUOTES)));
		$direc_z = mysqli_real_escape_string($conn,(strip_tags($direc_z,ENT_QUOTES)));
		$apellido_z = mysqli_real_escape_string($conn,(strip_tags($apellido_z,ENT_QUOTES)));
		$telefono_z = mysqli_real_escape_string($conn,(strip_tags($telefono_z,ENT_QUOTES)));
	
                
        if($modo_z == 'agregar_ok') {
            agrega_chofer($codigo_z, $nombre_z, 	$apellido_z, 	$direc_z, 	$idciudad_z,	$telefono_z);
        } 
        
        if($modo_z == 'eliminar_ok') {
            elimina_chofer($idchofer_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_chofer($idchofer_z, $codigo_z, $nombre_z, $apellido_z, $direc_z, $idciudad_z,
			$telefono_z, $status_z);
        } 
	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = 'Choferes.php';";
			echo "</script>";
	}

	function busca_choferes() {
		$conn=conecta();
		$sql = "select a.idchofer, a.codigo, a.nombres, a.apellidos, direccion, 
		  a.idciudad, a.idEstatus, a.telefono, b.ciudad 
		  from choferes a join ciudades b on a.idciudad = b.idciudad 
		  where idEstatus = 1 order by codigo";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    
	function agrega_chofer($codigo_z, $nombre_z, $apellido_z, $direc_z, $idciudad_z,
	$telefono_z) {
		$midciudad_z = busca_idciudad($idciudad_z);
		$conn=conecta();
		//$idtelefono_z = busca_idtelefono($telefono_z);
		$sql =  sprintf("insert into choferes (codigo, nombres, apellidos, direccion, idCiudad,
		idEstado, idEstatus, telefono) 
		  values ('%s', '%s', '%s', '%s', %s, 0, 1, '%s')",  
		  $codigo_z, $nombre_z, $apellido_z, $direc_z, $midciudad_z, $telefono_z);
		// echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_chofer("Chofer Agregado");
		return (0);
	}

	function modifica_chofer($idchofer_z, $codigo_z, $nombre_z, $apellido_z, $direc_z, $idciudad_z,
	$telefono_z, $status_z) {
		$conn=conecta();
		if ($status_z == "ACTIVO") {
			$mistatus_z = 1;
		} else {
			$mistatus_z = 2;
		}
		$sql =  sprintf("update choferes set  nombres='%s', apellidos='%s', direccion='%s', 
		idCiudad=(select idciudad from ciudades where ciudad = '%s'), 
		telefono='%s', idEstatus=%s where idchofer = %s", 
		$nombre_z, $apellido_z, $direc_z,
		 $idciudad_z, $telefono_z, $mistatus_z, $idchofer_z);
		 //echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_chofer("Chofer Modificado");
		return (0);
	}

	function elimina_chofer($idchofer_z) {
		$conn=conecta();
		$sql =  sprintf("delete from choferes where idchofer = %s", $idchofer_z);
		echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_chofer("Chofer Eliminado");
		return (0);
	}

	function alertas_chofer($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = 'Choferes.php';";
		echo "</script>";
	}

	function busca_idciudad($ciudad_z) {
		$conn=conecta();
		$idciudad_z = -1;
		$sql = sprintf("select idciudad from ciudades where ciudad = '%s' order by ciudad", $ciudad_z);
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $idciudad_z = $row['idciudad'];
		}
		mysqli_close($conn);
		return ($idciudad_z);
    }

?>
