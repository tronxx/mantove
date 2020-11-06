<?php
	$clave_z = "";
	$descripcion_z = "";
	$idtipoveh_z = 0;
    $idmantenimiento_z = 0;
    $perio_z = "";
    $kmofe_z = "";
    $xcada_z = 0;
    $xcadanvo_z = 0;
    $toler_z = 0;
	$toggle_z = "";
	$servop_z = "";
    require_once('../../php/ejecuta_query.php');
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if(isset($_POST['descripcion'])) {
            $descripcion_z = $_POST['descripcion'];
        }
        if(isset($_POST['idtipoveh'])) {
            $idtipoveh_z = $_POST['idtipoveh'];
        }
        if(isset($_POST['clave'])) {
            $clave_z = $_POST['clave'];
        }
        if(isset($_POST['idmantenimiento'])) {
            $idmantenimiento_z = $_POST['idmantenimiento'];
        }
        if(isset($_POST['kmofe'])) {
            $kmofe_z = $_POST['kmofe'];
        }
        if(isset($_POST['perio'])) {
            $perio_z = $_POST['perio'];
        }
        if(isset($_POST['xcada'])) {
            $xcada_z = $_POST['xcada'];
        }
        if(isset($_POST['xcadanvo'])) {
            $xcadanvo_z = $_POST['xcadanvo'];
        }
        if(isset($_POST['toler'])) {
            $toler_z = $_POST['toler'];
        }
        if(isset($_POST['toggle'])) {
            $toggle_z = $_POST['toggle'];
        }
        if(isset($_POST['servop'])) {
            $servop_z = $_POST['servop'];
		}
		
        if($modo_z == 'agregar_ok') {
			agrega_mantenimientos($clave_z, $descripcion_z, $idtipoveh_z, $kmofe_z, 
			  $perio_z, $xcada_z, $xcadanvo_z, $toler_z, $toggle_z, $servop_z);
        } 
        
        if($modo_z == 'eliminar_ok') {
            elimina_mantenimientos($idmantenimiento_z);
        }
        if($modo_z == 'modificar_ok') {
			modifica_mantenimientos($idmantenimiento_z, $clave_z, $descripcion_z, $idtipoveh_z, 
			$kmofe_z, $perio_z, $xcada_z, $xcadanvo_z, $toler_z, $toggle_z, $servop_z);
        } 
	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = 'mantenimientos.php';";
			echo "</script>";
	}

	function busca_mantenimientos() {
		$conn=conecta();
		$sql = "select a.idservmanto, a.clave, a.descri, a.idtipovehiculo, perio, kmofe, 
		  a.xcada, a.xcadanvo, a.toler, a.toggle, a.servop, b.descripcion as descritipoveh
		  from servmanto a join tipovehiculos b on a.idtipovehiculo = b.idtipovehiculo
		  order by clave";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    
	function agrega_mantenimientos($clave_z, $descripcion_z, $idtipoveh_z, $kmofe_z, $perio_z,
	$xcada_z, $xcadanvo_z, $toler_z, $toggle_z, $servop_z) {
		$conn=conecta();
		$idperio_z = 0;
		if($perio_z == "SI") {
			$idperio_z = "S";
		} else {
			$idperio_z = "N";
			$toggle_z = "N";
		}
		if($toggle_z == "SI") {
			$toggle_z = "S";
		} else {
			$toggle_z = "N";
		}
		//$idxcada_z = busca_idxcada($xcada_z);
		$sql =  sprintf("insert into servmanto (clave, descri, idtipovehiculo, perio, 
		  kmofe, xcada, xcadanvo, toler, toggle, servop) 
		  values ('%s', '%s', %s, '%s', '%s', %s, %s, %s, '%s', '%s')",  
		  $clave_z, $descripcion_z, $idtipoveh_z, $perio_z, $kmofe_z, $xcada_z,
		  $xcadanvo_z, $toler_z, $toggle_z, $servop_z);
		//echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_mantenimientos("mantenimientos Agregado");
		return (0);
	}

	function modifica_mantenimientos($idmantenimiento_z, $clave_z, $descripcion_z, $idtipoveh_z, $kmofe_z, 
	  $perio_z, $xcada_z, $xcadanvo_z, $toler_z, $toggle_z, $servop_z) {
		$conn=conecta();
		//$idperio_z = busca_idperio($perio_z);
		if($perio_z == "SI") {
			$idperio_z = "S";
		} else {
			$idperio_z = "N";
			$toggle_z = "N";
		}
		if($toggle_z == "SI") {
			$toggle_z = "S";
		} else {
			$toggle_z = "N";
		}
		$sql =  sprintf("update servmanto set  descri='%s', idtipovehiculo=%s, kmofe='%s', 
		perio='%s', xcada=%s, xcadanvo = %s, toler=%s, toggle='%s', servop='%s'
		where idservmanto = %s", $descripcion_z, $idtipoveh_z, $kmofe_z,
		 $idperio_z, $xcada_z, $xcadanvo_z, $toler_z, $toggle_z, $servop_z,
		 $idmantenimiento_z);
		// echo $sql . "<br>";
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_mantenimientos("mantenimientos Modificado");
		return (0);
	}

	function elimina_mantenimientos($idmantenimiento_z) {
		$conn=conecta();
		$sql =  sprintf("delete from servmanto where idservmanto = %s", $idmantenimiento_z);
		echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_mantenimientos("mantenimientos Eliminado");
		return (0);
	}

	function alertas_mantenimientos($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = 'mantenimientos.php';";
		echo "</script>";
	}

	function busca_idperio($perio_z) {
		$conn=conecta();
		$idperio_z = -1;
		$sql = sprintf("select idperio from perioes where perio = '%s' order by perio", $perio_z);
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $idperio_z = $row['idperio'];
		}
		mysqli_close($conn);
		return ($idperio_z);
    }

?>
