<?php
	$marca_z = "";
	$idmarca_z = 0;
	$piva_z = 0;
    require_once('../../php/ejecuta_query.php');
	if(isset($_POST['idmarca'])) {
        $idmarca_z = $_POST['idmarca'];
    }
	if(isset($_POST['marca'])) {
        $marca_z = $_POST['marca'];
    }

	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if($modo_z == 'agregar_ok') {
            agrega_marcas($marca_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_marca($idmarca_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_marcas($idmarca_z, $marca_z);
        } 

	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = 'marcas.php';";
			echo "</script>";
	}

	function busca_marcas() {
		$conn=conecta();
		$sql = "select idmarca, marca from marcas order by marca";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    
	function agrega_marcas($marca_z) {
		$conn=conecta();
		$sql =  sprintf("insert into marcas (marca) 
          values ('%s')",  $marca_z);
        //echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_marca("Marca Agregada");
		return (0);
	}

	function modifica_marcas($idmarca_z, $marca_z) {
		$conn=conecta();
		$sql =  sprintf("update marcas set marca='%s' where idmarca=%s", 
		 $marca_z, $idmarca_z);
		 //echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_marca("Marca Modificada");
		return (0);
	}


	function elimina_marca($idmarca_z) {
		$conn=conecta();
		$sql =  sprintf("delete from marcas where idmarca = %s", $idmarca_z);
		//echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_marca("Marca Eliminada");
		return (0);
	}

	function alertas_marca($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = 'marcas.php';";
		echo "</script>";
	}
?>

