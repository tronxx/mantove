<?php
	$zona_z = "";
	$idzona_z = 0;
	$piva_z = 0;
	if(isset($_POST['idzona'])) {
        $idzona_z = $_POST['idzona'];
    }
	if(isset($_POST['zona'])) {
        $zona_z = $_POST['zona'];
    }
    
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        require_once('../../php/ejecuta_query.php');
        if($modo_z == 'agregar_ok') {
            agrega_zonas($zona_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_zona($idzona_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_zonas($idzona_z, $zona_z);
        } 

	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = './zonas.php';";
			echo "</script>";
	}
	else {
        require_once('../../php/ejecuta_query.php');
    }

	function agrega_zonas($zona_z) {
		$conn=conecta();
		$sql =  sprintf("insert into zonas (zona) 
          values ('%s')",  $zona_z);
        //echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_zona("zona Agregada");
		return (0);
	}

	function modifica_zonas($idzona_z, $zona_z) {
		$conn=conecta();
		$sql =  sprintf("update zonas set zona='%s' where idzona=%s", 
		 $zona_z, $idzona_z);
		 echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_zona("zona Modificada");
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
		alertas_zona("zona Eliminada");
		return (0);
	}

	function alertas_zona($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = '../../index.php?menu=zonas';";
		echo "</script>";
	}
?>
