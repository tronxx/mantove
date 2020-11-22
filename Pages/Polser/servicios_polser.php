<?php
	$poligas_z = "";
	$idpolser_z = 0;
	$piva_z = 0;
	$fecha_z = date("Y") . "/". date("m") . "/" . date("d");
	$almacen_z = "";
	$archivo_z = "../../php/ejecuta_query.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "php/ejecuta_query.php";
	}
	require_once($archivo_z);

	
	if(isset($_POST['idpolser'])) {
        $idpolser_z = $_POST['idpolser'];
    }
	if(isset($_POST['fecha'])) {
        $fecha_z = $_POST['fecha'];
    }
	if(isset($_POST['fecini'])) {
        $fecini_z = $_POST['fecini'];
    }
	if(isset($_POST['fecfin'])) {
        $fecfin_z = $_POST['fecfin'];
    }
	if(isset($_POST['almacen'])) {
        $idalmacen_z = $_POST['almacen'];
    }
    
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if($modo_z == 'agregar_ok') {
            agrega_polser($idalmacen_z, $fecha_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_polser($idpoligas_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_polser($idpoligas_z, $poligas_z);
        } 

	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = 'polser.php';";
			echo "</script>";
	}
	
	function busca_polser($fecini_z, $fecfin_z) {
		$conn=conecta();
		$sql = "select a.idpolser, a.idalmacen, a.fecha, a.status, a.idusuario, a.importe, 
		  a.iva, a.total, a.cia, b.clave, b.nombre 
		  from polser a join almacenes b on a.IDALMACEN = b.idAlmacen 
		  where a.fecha between '" . $fecini_z . "'  and '" . $fecfin_z . "' 
		  order by fecha desc, b.clave";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
	}
	
	function busca_mi_poliza($idpolser_z) {
		$conn=conecta();
		$sql = sprintf("select idpolser, a.idalmacen, a.fecha, a.status, a.idusuario, a.importe, 
		a.iva, a.total, a.cia, b.clave, b.nombre 
		from polser a join almacenes b on a.IDALMACEN = b.idAlmacen 
		  where a.idpolser = %s", $idpolser_z);
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }

    
	function agrega_polser($idalmacen_z, $fecha_z) {
		$conn=conecta();
		$idusuario_z = 0;
		
		$sql =  sprintf("insert into polser (idalmacen, fecha, status, idusuario, importe, 
		 iva, total,  cia) 
		  values (%s, '%s', 'A', %s, 0, 0, 0, 1)",  
		  $idalmacen_z, $fecha_z, $idusuario_z);
        //echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
   			alertas_polser("Error: No se pudo agregar registro");
	 		manda_a_polser();
		};
		$idpolser_z = $conn->insert_id;
		mysqli_close($conn);
		alertas_polser("Póliza Creada");
		mostrar_polser($idpolser_z);
		return (0);
	}

	function modifica_polser($idpolser_z, $poligas_z) {
		$conn=conecta();
		$sql =  sprintf("update polser set polser='%s' where idpolser=%s", 
		 $poligas_z, $idpoligas_z);
		// echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			alertas_polser("Error: No se pudo eliminar el registro");
	 		manda_a_polser();
		};
		mysqli_close($conn);
		alertas_polser("poligas Modificada");
		return (0);
	}


	function elimina_polser($idpolser_z) {
		$conn=conecta();
		$sql =  sprintf("delete from polser where idpolser = %s", $idpolser_z);
		//echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			alertas_polser("Error: No se pudo eliminar el registro");
	 		manda_a_polser();
		};
		mysqli_close($conn);
		alertas_polser("Poliza de Servicio Eliminada");
	 	manda_a_polser();
		return (0);
	}

	function alertas_polser($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		//echo "window.location = 'polser.php';";
		echo "</script>";
	}

	function manda_a_polser() {
		$cadena_z = "<script>";
		$cadena_z = $cadena_z . "window.location = 'polser.php';";
		$cadena_z = $cadena_z .  "</script>";
		echo $cadena_z;
	}


	function mostrar_polser($idpolser_z) {
		$cadena_z = "<form action=\"renposer.php\" name=\"renposer\" id=\"renposer\" method=\"post\">";
		$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpolser\" value=\"". $idpolser_z  . "\" >";
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Visualizar</button>";
		$cadena_z = $cadena_z . "</form>";
		$cadena_z = $cadena_z . "<script type=\"text/javascript\"> 
		    document.renposer.submit(); 
		    </script>";
		echo $cadena_z;
	}
?>
