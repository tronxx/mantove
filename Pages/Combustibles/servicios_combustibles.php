<?php
	$combustible_z = "";
	$idcombustible_z = 0;
	$piva_z = 0;
	$precioxlit_z = 0;
    $fecha_z = date("Y") . "-". date("m") . "-" . date("d");
    require_once('../../php/ejecuta_query.php');
	if(isset($_POST['idcombustible'])) {
        $idcombustible_z = $_POST['idcombustible'];
    }
	if(isset($_POST['combustible'])) {
        $combustible_z = $_POST['combustible'];
    }
	if(isset($_POST['piva'])) {
        $piva_z = $_POST['piva'];
    }
	if(isset($_POST['precioxlit'])) {
        $precioxlit_z = $_POST['precioxlit'];
    }
	if(isset($_POST['fecha'])) {
        $fecha_z = $_POST['fecha'];
    }
      
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        require_once('../../php/ejecuta_query.php');
        if($modo_z == 'agregar_ok') {
            agrega_combustibles($combustible_z, $piva_z, $precioxlit_z, $fecha_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_combustible($idcombustible_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_combustibles($idcombustible_z, $combustible_z, $piva_z, $precioxlit_z, $fecha_z);
        } 

	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = 'combustibles.php';";
			echo "</script>";
	}
	function busca_combustibles() {
		$conn=conecta();
		$sql = "select idcombustible, descripcion, iva, precioxlit, fecha from combustibles order by descripcion";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    
	function agrega_combustibles($combustible_z, $piva_z, $precioxlit_z, $fecha_z) {
		$conn=conecta();
		$sql =  sprintf("insert into combustibles (descripcion, iva, idEstatus, precioxlit, fecha) 
          values ('%s', %s, 1, %s, '%s')",  $combustible_z, $piva_z, $precioxlit_z, $fecha_z);
        echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		$idcombustible_z = mysqli_insert_id($conn);
		mysqli_close($conn);
		agrega_cambio_precio_combustible($idcombustible_z, $piva_z, $precioxlit_z, $fecha_z);
		//alertas_combustible("Combustible Agregado");
		return (0);
	}

	function agrega_cambio_precio_combustible($idcombustible_z, $piva_z, $precioxlit_z, $fecha_z) {
		$conn=conecta();
		$sql =  sprintf("select * from precioscombustible where idcombustible=%s and fecha = '%s'", 
		 $idcombustible_z, $fecha_z);
		$rs = mysqli_query($conn,$sql);
		if (mysqli_num_rows($rs)==0) { 
   			$sql =  sprintf("insert into precioscombustible (idcombustible, precio, fecha) values (%s, %s, '%s')", $idcombustible_z, $precioxlit_z, $fecha_z);
		} else {
   			$sql =  sprintf("update precioscombustible set precio=%s, fecha='%s' where (idcombustible = %s)", $precioxlit_z, $fecha_z, $idcombustible_z);
		}
		echo "<br>" .  $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};


	}

	function modifica_combustibles($idcombustible_z, $combustible_z, $piva_z, $precioxlit_z, $fecha_z) {
		$conn=conecta();
		$sql =  sprintf("update combustibles set descripcion='%s', iva=%s, fecha='%s', precioxlit = %s where idcombustible=%s", 
		 $combustible_z, $piva_z, $fecha_z, $precioxlit_z, $idcombustible_z);
		 echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		agrega_cambio_precio_combustible($idcombustible_z, $piva_z, $precioxlit_z, $fecha_z);
		//alertas_combustible("Combustible Modificado");
		return (0);
	}


	function elimina_combustible($idcombustible_z) {
		$conn=conecta();
		$sql =  sprintf("delete from combustibles where idcombustible = %s", $idcombustible_z);
		//echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_combustible("Combustible Eliminado");
		return (0);
	}

	function alertas_combustible($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = 'combustibles.php';";
		echo "</script>";
	}
?>

