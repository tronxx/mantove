<?php
	$tipopago_z = "";
	$idtipopago_z = 0;
	$valor_z = 0;
    require_once('../../php/ejecuta_query.php');
	if(isset($_POST['idtipopago'])) {
        $idtipopago_z = $_POST['idtipopago'];
    }
	if(isset($_POST['tipopago'])) {
        $tipopago_z = $_POST['tipopago'];
    }
	if(isset($_POST['valor'])) {
        $valor_z = $_POST['valor'];
    }
    
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if($modo_z == 'agregar_ok') {
            agrega_tipopagos($tipopago_z, $valor_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_tipopago($idtipopago_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_tipopagos($idtipopago_z, $tipopago_z, $valor_z);
        } 

	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = 'tipospago.php';";
			echo "</script>";
	}

	function busca_tipopagos() {
		$conn=conecta();
		$sql = "select idtipopago, descripcion, valor, idestatus from tipopagos order by descripcion";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    
	function agrega_tipopagos($tipopago_z, $valor_z) {
		$conn=conecta();
		$sql =  sprintf("insert into tipopagos (descripcion, valor, idestatus) 
          values ('%s', %s, 1)",  $tipopago_z, $valor_z);
        //echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_tipopago("Tipo de pago Agregado");
		return (0);
	}

	function modifica_tipopagos($idtipopago_z, $tipopago_z, $valor_z) {
		$conn=conecta();
		$sql =  sprintf("update tipopagos set descripcion='%s', valor=%s where idtipopago=%s", 
		 $tipopago_z, $valor_z, $idtipopago_z);
		// echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_tipopago("tipo de Pago Modificado");
		return (0);
	}


	function elimina_tipopago($idtipopago_z) {
		$conn=conecta();
		$sql =  sprintf("delete from tipopagos where idtipopago = %s", $idtipopago_z);
		//echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_tipopago("Tipo de Pago Eliminado");
		return (0);
	}

	function alertas_tipopago($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = 'tipospago.php';";
		echo "</script>";
	}
?>

