<?php
	$clave_z = "";
	$nombre_z = "";
	$representante_z = "";
    $idtaller_z = 0;
    $giro_z = "";
    $direc_z = "";
    $telefono_z = "";
    $status_z = "";
    $fecbaj_z = "";
    require_once('../../php/ejecuta_query.php');
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
		if(isset($_POST['idtaller'])) {
			$idtaller_z = $_POST['idtaller'];
		}
		if(isset($_POST['nombre'])) {
			$nombre_z = $_POST['nombre'];
		}
		if(isset($_POST['representante'])) {
			$representante_z = $_POST['representante'];
		}
		if(isset($_POST['clave'])) {
			$clave_z = $_POST['clave'];
		}
		if(isset($_POST['direc'])) {
			$direc_z = $_POST['direc'];
		}
		if(isset($_POST['giro'])) {
			$giro_z = $_POST['giro'];
		}
		if(isset($_POST['telefono'])) {
			$telefono_z = $_POST['telefono'];
		}
		if(isset($_POST['status'])) {
			$status_z = $_POST['status'];
		}
		if(isset($_POST['fecbaj'])) {
			$fecbaj_z = $_POST['fecbaj'];
		}
		$conn=conecta();
		$clave_z = mysqli_real_escape_string($conn,(strip_tags($clave_z,ENT_QUOTES)));
		$nombre_z = mysqli_real_escape_string($conn,(strip_tags($nombre_z,ENT_QUOTES)));
		$representante_z = mysqli_real_escape_string($conn,(strip_tags($representante_z,ENT_QUOTES)));
		$direc_z = mysqli_real_escape_string($conn,(strip_tags($direc_z,ENT_QUOTES)));
		$giro_z = mysqli_real_escape_string($conn,(strip_tags($giro_z,ENT_QUOTES)));
		$telefono_z = mysqli_real_escape_string($conn,(strip_tags($telefono_z,ENT_QUOTES)));
					  
        if($modo_z == 'agregar_ok') {
            agrega_taller($clave_z, $nombre_z, $representante_z, $direc_z, $giro_z, $telefono_z);
        } 
        
        if($modo_z == 'eliminar_ok') {
            elimina_taller($idtaller_z);
        }
        if($modo_z == 'modificar_ok') {
			modifica_taller($idtaller_z, $clave_z, $nombre_z, $representante_z, 
			$direc_z, $giro_z, $telefono_z, $status_z, $fecbaj_z);
        } 
	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = 'talleres.php';";
			echo "</script>";
	}

	function busca_talleres() {
		$conn=conecta();
		$sql = "select idtaller, clave, nombre, representante, direccion, telefonos, giro, 
		  idEstatus, fecbaj
		  from talleres order by clave";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    
	function agrega_taller($clave_z, $nombre_z, $representante_z, $direc_z, $giro_z,
	  $telefono_z) {
		$conn=conecta();
		$idciudad_z = 0;
		$sql =  sprintf("insert into talleres (clave, nombre, representante, direccion, giro,
		telefonos, idEstatus) 
		  values ('%s', '%s', '%s', '%s', '%s', '%s', 1 )",  
		  $clave_z, $nombre_z, $representante_z, $direc_z, $giro_z, $telefono_z);
		//echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_taller("Taller Agregado");
		return (0);
	}

	function modifica_taller($idtaller_z, $clave_z, $nombre_z, $representante_z,
	 $direc_z, $giro_z, $telefono_z, $status_z, $fecbaj_z) {
		 if($status_z == "ACTIVO") {
			 $idstatus_z = 1;
		 } else {
			$idstatus_z = 2;
		 }
		$conn=conecta();
		$sql =  sprintf("update talleres set  nombre='%s', representante='%s', direccion='%s', 
		giro='%s', telefonos='%s', idEstatus=%s, fecbaj = '%s'
		where idtaller = %s", $nombre_z, $representante_z, $direc_z,
		 $giro_z, $telefono_z, $idstatus_z, $fecbaj_z, $idtaller_z);
		 //echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo Modificar registro";
		};
		mysqli_close($conn);
		alertas_taller("Taller Modificado");
		return (0);
	}

	function elimina_taller($idtaller_z) {
		$conn=conecta();
		$sql =  sprintf("delete from talleres where idtaller = %s", $idtaller_z);
		//echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_taller("Taller Eliminado");
		return (0);
	}

	function alertas_taller($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = 'talleres.php';";
		echo "</script>";
	}

?>
