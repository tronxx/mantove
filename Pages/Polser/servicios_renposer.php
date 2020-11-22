<?php
	$poligas_z = "";
	$idpoligas_z = 0;
	$idrenpogas_z = 0;
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
	if(isset($_POST['idrenposer'])) {
        $idrenposer_z = $_POST['idrenposer'];
    }
	if(isset($_POST['fecha'])) {
        $fecha_z = $_POST['fecha'];
    }
	if(isset($_POST['almacen'])) {
        $almacen_z = $_POST['almacen'];
    }
    
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
		// echo "Modo:" . $modo_z . "<br>";
        if($modo_z == 'Agregar_renposer_ok') {
            agrega_renposer($idpolser_z, $fecha_z);
        } 
        if($modo_z == 'eliminar_renglon_ok') {
            elimina_renposer($idrenposer_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_polser($idpolser_z, $poligas_z);
        }
        if($modo_z == 'Cerrar_polser_ok') {
            cerrar_polser($idpolser_z, $poligas_z);
        }

	} elseif (isset($_POST['cancelar'])) {
		manda_a_renposer($idpolser_z);
	}

	function busca_renposer($idpolser_z) {
		$conn=conecta();
		$sql = sprintf("select idrenposer, idpolser, a.idvehiculo, a.kilom,
		  costo, idusuario, conse, a.cia, a.edotoggle, a.idtalleraut,
		  a.idobserv,a.idservmanto, a.observs,
		  b.codigo as codvehi, b.DESCRI as descrivehi, c.codigo as cvechofer, 
		  d.descri  as descriserv, 
		  d.servop  as servalternante, 
		  d.toggle as tienealternante,
		  e.clave as codigotaller,
		  e.nombre as nombretaller
		  from renposer a join vehiculos b on a.idvehiculo = b.idvehiculo
		  join choferes c on a.idchofer = c.idchofer
		  join servmanto d on a.idservmanto = d.idservmanto
		  join talleres e on a.idtalleraut = e.idtaller
		  where idpolser = %s
		  order by b.codigo, idrenposer", $idpolser_z);
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    

	function agrega_renposer($idpolser_z, $fecha_z) {
		$fechaa_z = $_POST['fecha'];
		$idtaller_z = $_POST['idtaller'];
		$idvehiculo_z = $_POST['idvehiculo'];
		$kilom_z = $_POST['kmtact'];
		$idservmanto_z = $_POST['idservmanto'];
		$costo_z = $_POST['importe'];
		$idzona_z = $_POST['idzona'];
		$idchofer_z = $_POST['idchofer'];
		$edotoggle_z = $_POST['edotoggle'];
		$observs_z = $_POST['observs'];
		$conse_z = 0;
		$cia_z = 1;
		$idobserv_z = 1;

			
		$conn=conecta();
		$sql = sprintf("insert into renposer ( idpolser, idvehiculo, fecha, conse,
		  idservmanto, kilom, edotoggle, idtalleraut, idobserv, costo, idchofer, 
		  cia, observs)
		  values (%s, %s, '%s', %s,  %s,
		   %s, '%s', %s, %s, %s, %s, %s, '%s')",
		   $idpolser_z, $idvehiculo_z, $fecha_z, $conse_z, $idservmanto_z,
		   $kilom_z, $edotoggle_z, $idtaller_z, $idobserv_z, $costo_z, 
		   $idchofer_z, $cia_z, $observs_z);
		 //echo "<br> Renglones: " . $sql . "<br>";
		if ( ! $rs = mysqli_query($conn,$sql) ) {
		   alertas_renposer("Error. No se pudo agregar el movimiento", $idpolser_z);
		}
		$sql2_z = sprintf("update polser set total = total + %s
		  where idpolser = %s",
		  $costo_z, $idpolser_z);
		//echo "<br> Poligas: " . $sql2_z . "<br>";
		if ( ! $rs = mysqli_query($conn,$sql2_z) ) {
		   alertas_renposer("Error. No se pudo agregar el movimiento", $idpolser_z);
		}
		mysqli_close($conn);
		alertas_renposer("Movimiento Agregado", $idpolser_z);

		//return (json_encode($encode));
    }
    
	function cerrar_polser($idpolser_z, $poliza_z) {
		$conn=conecta();
		$sql2_z = sprintf("update polser set status='C' where idpolser = %s", $idpolser_z);
		  //echo "<br> Poligas: " . $sql2_z . "<br>";
		if ( ! $rs = mysqli_query($conn,$sql2_z) ) {
		   alertas_renposer("Error. No se pudo Cerrar la Póliza", $idpolser_z);
		}
		mysqli_close($conn);
		alertas_renposer("Poliza Cerrada", $idpolser_z);
		//return (json_encode($encode));
    }

	function elimina_renposer($idrenposer_z, $idpolser_z) {
		$costo_z = -1;
		$conn=conecta();
		$sql2_z = sprintf("delete from renposer where idrenposer = %s", $idrenposer_z);
		  //echo "<br> Poligas: " . $sql2_z . "<br>";
		if ( ! $rs = mysqli_query($conn,$sql2_z) ) {
		   alertas_renposer("Error. No se pudo Eliminar el Movimiento", $idrenposer_z);
		}
		$sql2_z = sprintf("update polser set total = total - %s
		  where idpolser = %s",
		  $costo_z, $idpolser_z);
		//echo "<br> Poligas: " . $sql2_z . "<br>";
		if ( ! $rs = mysqli_query($conn,$sql2_z) ) {
		   alertas_renposer("Error. No se pudo actualizar la Póliza", $idpolser_z);
		}
		mysqli_close($conn);
		alertas_renposer("Movimiento Eliminado", $idrenposer_z);


		mysqli_close($conn);
		alertas_renposer("Poliza Cerrada", $idpolser_z);
		//return (json_encode($encode));
    }

	function alertas_renposer($mensaje_z, $idpolser_z) {
		$alerta_z = "<script>";
		$alerta_z = $alerta_z . "alert(' . $mensaje_z . ');";
		$alerta_z = $alerta_z . "</script>";
		echo $alerta_z;
		manda_a_renposer($idpolser_z);
	}

	function manda_a_renposer($idpolser_z) {
		$fecha_z = date('Y-m-d');
		$cadena_z = "<form action=\"renposer.php\" name=\"renposer\" id=\"renposer\" method=\"post\">";
		$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpolser\" value=\"". $idpolser_z  . "\" >";
		$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecha\" value=\"". $fecha_z  . "\" >";
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Visualizar</button>";
		$cadena_z = $cadena_z . "</form>";
		$cadena_z = $cadena_z . "<script type=\"text/javascript\"> 
		    document.renposer.submit(); 
		    </script>";
		echo $cadena_z;
		
	}

?>
