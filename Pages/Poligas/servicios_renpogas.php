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

	if(isset($_POST['idpoligas'])) {
        $idpoligas_z = $_POST['idpoligas'];
    }
	if(isset($_POST['fecha'])) {
        $fecha_z = $_POST['fecha'];
    }
	if(isset($_POST['almacen'])) {
        $almacen_z = $_POST['almacen'];
    }
    
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        if($modo_z == 'Agregar_renpogas_ok') {
            agrega_renpoligas($idpoligas_z, $fecha_z);
        } 
        if($modo_z == 'eliminar_ok') {
            elimina_poligas($idpoligas_z);
        }
        if($modo_z == 'modificar_ok') {
            modifica_poligas($idpoligas_z, $poligas_z);
        }
        if($modo_z == 'Cerrar_poligas_ok') {
            cerrar_poligas($idpoligas_z, $poligas_z);
        }

	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = '../../index.php?menu=poligas';";
			echo "</script>";
	}

	function busca_renpogas($idpoligas_z) {
		$conn=conecta();
		$sql = sprintf("select idrenpogas, idpoligas, a.idvehiculo, kmtant, kmtact, recorr,
		  litros, preciou,
		  ( recorr / ( litros - .01 ) ) as rendto,
  		  idcombust, a.idchofer, a.zona, importe, iva, total,
		  piva, idusuario, fecnot, conse, kmtacu, a.cia, a.idtipago,
		  b.codigo as codvehi, b.DESCRI as descrivehi, c.codigo as cvechofer, 
		  d.descripcion as descritipago
		  from renpogas a join vehiculos b on a.idvehiculo = b.idvehiculo
		  join choferes c on a.idchofer = c.idchofer
		  join tipopagos d on a.idtipago = d.idTipoPago
		  where idpoligas = %s
		  order by a.zona,  b.codigo, idrenpogas", $idpoligas_z);
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    

	function agrega_renpoligas($idpoligas_z, $fecha_z) {
		$fecnota_z = $_POST['fecnota'];
		$idtipopago_z = $_POST['idtipopago'];
		$idvehiculo_z = $_POST['idvehiculo'];
		$kmtant_z = $_POST['kmtant'];
		$kmtact_z = $_POST['kmtact'];
		$recorr_z = $_POST['recorr'];
		$idtipocombustible_z = $_POST['idcombustible'];
		$prelit_z = $_POST['prelit'];
		$total_z = $_POST['importe'];
		$litros_z = $_POST['litros'];
		$idzona_z = $_POST['idzona'];
		$idchofer_z = $_POST['idchofer'];
		$piva_z = 16;
		$importe_z = round( $total_z / (1 + $piva_z) / 100, 2);
		$iva_z = $total_z - $importe_z;
		$idusuario_z = 0;
		$conse_z = 0;
		$kmtacu_z = $kmtact_z;
		$cia_z = 1;

			
		$conn=conecta();
		$sql = sprintf("insert into renpogas ( idpoligas, idvehiculo, kmtant, kmtact, recorr,
		  litros, preciou, idcombust, idchofer, zona, importe, iva, total,
		  piva, idusuario, fecnot, conse, kmtacu, cia, idtipago )
		  values (%s, %s, %s, %s,  %s,
		   %s, %s, %s, %s, %s, %s, %s, %s,
		   %s, %s, '%s', %s, %s, %s, %s )",
		   $idpoligas_z, $idvehiculo_z, $kmtant_z, $kmtact_z, $recorr_z,
		   $litros_z, $prelit_z, $idtipocombustible_z, $idchofer_z, $idzona_z,
		   $importe_z, $iva_z, $total_z,
		   $piva_z, $idusuario_z, $fecnota_z, $conse_z, $kmtacu_z, $cia_z, $idtipopago_z);
		   //echo "<br> Renglones: " . $sql . "<br>";
		$rs = mysqli_query($conn,$sql);
		$sql2_z = sprintf("update poligas set importe = importe + %s, iva = iva + %s, total = total + %s,
		  litros = litros + %s, kmts = kmts + %s, 
		  promkml = round((kmts + %s) / (litros + %s), 2)
		  where idpoligas = %s",
		  $importe_z, $iva_z, $total_z, $litros_z, $recorr_z, $recorr_z, $litros_z, $idpoligas_z);
		  //echo "<br> Poligas: " . $sql2_z . "<br>";
		  $rs = mysqli_query($conn,$sql2_z);
		  $sql3_z = sprintf("update vehiculos set kilom = kilom + %s, tacacu = tacacu + %s
		   where idvehiculo = %s",
		  $recorr_z, $recorr_z, $idvehiculo_z);
		  //echo "<br> Vehiculos: " . $sql3_z . "<br>";
		  $rs = mysqli_query($conn,$sql3_z);
		mysqli_close($conn);
		alertas_renpoligas("Movimiento Agregado", $idpoligas_z);

		//return (json_encode($encode));
    }
    
	function cerrar_poligas($idpoligas_z, $poliza_z) {
		$conn=conecta();
		$sql2_z = sprintf("update poligas set status='C' where idpoligas = %s", $idpoligas_z);
		  //echo "<br> Poligas: " . $sql2_z . "<br>";
		  $rs = mysqli_query($conn,$sql2_z);
		mysqli_close($conn);
		alertas_renpoligas("Poliza Cerrada", $idpoligas_z);
		//return (json_encode($encode));
    }

	function alertas_renpoligas($mensaje_z, $idpoligas_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "</script>";
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
