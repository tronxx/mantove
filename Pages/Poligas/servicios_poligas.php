<?php
	$poligas_z = "";
	$idpoligas_z = 0;
	$piva_z = 0;
	$fecha_z = date("Y") . "/". date("m") . "/" . date("d");
	$almacen_z = "";
	$archivo_z = "../../php/ejecuta_query.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "php/ejecuta_query.php";
	}
	require_once($archivo_z);

	
	if(isset($_POST['idpoligas'])) {
        $idpoligas_z = $_POST['idpoligas'];
    }
	if(isset($_POST['fecha'])) {
        $fecha_z = $_POST['fecha'];
    }
	if(isset($_POST['almacen'])) {
        $idalmacen_z = $_POST['almacen'];
    }
    
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if($modo_z == 'agregar_ok') {
            agrega_poligas($idalmacen_z, $fecha_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_poligas($idpoligas_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_poligass($idpoligas_z, $poligas_z);
        } 

	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = '../../index.php?menu=poligas';";
			echo "</script>";
	}
	function busca_poligas() {
		$conn=conecta();
		$sql = "select a.idpoligas, a.idalmacen, a.fecha, a.status, a.idusuario, a.importe, 
		  a.iva, a.total, a.promkml, a.litros, a.kmts, a.cia, b.clave, b.nombre 
		  from poligas a join almacenes b on a.IDALMACEN = b.idAlmacen 
		  where a.fecha between DATE_ADD(CURDATE(), INTERVAL -1 MONTH) and curdate()
		  order by fecha desc, b.clave";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
	}
	
	function busca_mi_poliza($idpoligas_z) {
		$conn=conecta();
		$sql = sprintf("select a.idpoligas, a.idalmacen, a.fecha, a.status, a.idusuario, a.importe, 
		  a.iva, a.total, a.promkml, a.litros, a.kmts, a.cia, b.clave, b.nombre 
		  from poligas a join almacenes b on a.IDALMACEN = b.idAlmacen 
		  where a.idpoligas = %s", $idpoligas_z);
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }

    
	function agrega_poligas($idalmacen_z, $fecha_z) {
		$conn=conecta();
		$idusuario_z = 0;
		
		$sql =  sprintf("insert into poligas (idalmacen, fecha, status, idusuario, importe, 
		 iva, total, promkml, litros, KMTS, cia) 
		  values (%s, '%s', 'A', %s, 0, 0, 0, 0, 0, 0, 1)",  
		  $idalmacen_z, $fecha_z, $idusuario_z);
        //echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		$idpoligas_z = $conn->insert_id;
		mysqli_close($conn);
		//alertas_poligas("Póliza Creada");
		mostrar_poligas($idpoligas_z);
		return (0);
	}

	function modifica_poligas($idpoligas_z, $poligas_z) {
		$conn=conecta();
		$sql =  sprintf("update poligas set poligas='%s' where idpoligas=%s", 
		 $poligas_z, $idpoligas_z);
		// echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		alertas_poligas("poligas Modificada");
		return (0);
	}


	function elimina_poligas($idpoligas_z) {
		$conn=conecta();
		$sql =  sprintf("delete from poligas where idpoligas = %s", $idpoligas_z);
		//echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_poligas("poligas Eliminada");
		return (0);
	}

	function alertas_poligas($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = '../../index.php?menu=poligas';";
		echo "</script>";
	}

	function mostrar_poligas($idpoligas_z) {
		$fecha_z = "2018-07-01";
		$cadena_z = "<form action=\"renpogas.php\" name=\"renpogas\" id=\"renpogas\" method=\"post\">";
		$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpoligas\" value=\"". $idpoligas_z  . "\" >";
		$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecha\" value=\"". $fecha_z  . "\" >";
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Visualizar</button>";
		$cadena_z = $cadena_z . "</form>";
		$cadena_z = $cadena_z . "<script type=\"text/javascript\"> 
		    document.renpogas.submit(); 
		    </script>";
		echo $cadena_z;
	}
?>
