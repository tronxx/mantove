<?php
	$tipovehiculo_z = "";
    $idtipovehiculo_z = 0;
        require_once('../../php/ejecuta_query.php');
	if(isset($_POST['idtipovehiculo'])) {
        $idtipovehiculo_z = $_POST['idtipovehiculo'];
    }
	if(isset($_POST['tipovehiculo'])) {
        $tipovehiculo_z = $_POST['tipovehiculo'];
    }
    
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if($modo_z == 'agregar_ok') {
            agrega_tipovehiculo($tipovehiculo_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_tipovehiculo($idtipovehiculo_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_tipovehiculo($idtipovehiculo_z, $tipovehiculo_z);
        } 

	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = 'tipovehiculos.php';";
			echo "</script>";
	}

	function busca_tipovehiculos() {
		$conn=conecta();
		$sql = "select idtipovehiculo, descripcion,idEstatus from tipovehiculos order by descripcion";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    
	function agrega_tipovehiculo($tipovehiculo_z) {
		$conn=conecta();
		$sql =  sprintf("insert into tipovehiculos (descripcion, idEstatus) 
          values ('%s', 1)",  $tipovehiculo_z);
        //echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_tipovehiculo("Tipo Vehiculo Agregado");
		return (0);
	}

	function modifica_tipovehiculo($idtipovehiculo_z, $tipovehiculo_z) {
		$conn=conecta();
		$sql =  sprintf("update tipovehiculos set descripcion='%s' where idtipovehiculo=%s", 
		 $tipovehiculo_z, $idtipovehiculo_z);
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_tipovehiculo("Tipo de Vehiculo Modificado");
		return (0);
	}


	function elimina_tipovehiculo($idtipovehiculo_z) {
		$conn=conecta();
		$sql =  sprintf("delete from tipovehiculos where idtipovehiculo = %s", $idtipovehiculo_z);
		//echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_tipovehiculo("tipovehiculo Eliminada");
		return (0);
	}

	function alertas_tipovehiculo($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = 'tipovehiculos.php';";
		echo "</script>";
	}
?>

