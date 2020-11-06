<?php
	$idvehiculo_z = 0;
	$codigo_z = "";
	$descripcion_z = "";
	$idtipoveh_z = 0;
	$idmarca_z = 0;
	$modelo_z = "";
	$fecing_z = date("Y") . "-". date("m") . "-" . date("d");
	$baja_z = date("Y") . "-". date("m") . "-" . date("d");
	$status_z = "A";
	$placas_z = "";
	$chasis_z = "";
	$sermot_z = "";
	$maxtac_z = 0;
	$kilom_z = 0;
	$tacacu_z = 0;
	$nvohasta_z = 0;
	$nvousa_z = "U";
	$idtipogas_z = 0;
	$caractm_z = "";
	$tipllanta_z = "";
	$bateria_z = "";
	$polseg_z = "";
	$venpol_z = date("Y") . "-". date("m") . "-" . date("d");
	$idchofer_z = 0;
	$camtac_z = "";
	$kmtcamtac_z = 0;
	$fecamtac_z = date("Y") . "-". date("m") . "-" . date("d");
	$idzona_z = 0;
	$cia_z = 0;
	$idtipovehiculo_z = 0;

	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
        require_once('../../php/ejecuta_query.php');
        if(isset($_POST['idvehiculo'])) {
            $idvehiculo_z = $_POST['idvehiculo'];
        }
        if(isset($_POST['codigo'])) {
            $codigo_z = $_POST['codigo'];
        }
        if(isset($_POST['descripcion'])) {
            $descripcion_z = $_POST['descripcion'];
        }
        if(isset($_POST['idmarca'])) {
            $idmarca_z = $_POST['idmarca'];
        }
        if(isset($_POST['fecing'])) {
            $fecing_z = $_POST['fecing'];
        }
        if(isset($_POST['modelo'])) {
            $modelo_z = $_POST['modelo'];
        }
        if(isset($_POST['placas'])) {
            $placas_z = $_POST['placas'];
        }
        if(isset($_POST['chasis'])) {
            $chasis_z = $_POST['chasis'];
        }
        if(isset($_POST['sermot'])) {
            $sermot_z = $_POST['sermot'];
        }
        if(isset($_POST['caractm'])) {
            $caractm_z = $_POST['caractm'];
        }
        if(isset($_POST['tipllanta'])) {
            $tipllanta_z = $_POST['tipllanta'];
        }
        if(isset($_POST['bateria'])) {
            $bateria_z = $_POST['bateria'];
        }
        if(isset($_POST['polseg'])) {
            $polseg_z = $_POST['polseg'];
        }
        if(isset($_POST['venpol'])) {
            $venpol_z = $_POST['venpol'];
        }
        if(isset($_POST['idchofer'])) {
            $idchofer_z = $_POST['idchofer'];
        }
        if(isset($_POST['maxtac'])) {
            $maxtac_z = $_POST['maxtac'];
        }
        if(isset($_POST['kilom'])) {
            $kilom_z = $_POST['kilom'];
        }
        if(isset($_POST['tacacu'])) {
            $tacacu_z = $_POST['tacacu'];
        }
        if(isset($_POST['nvohasta'])) {
            $nvohasta_z = $_POST['nvohasta'];
        }
        if(isset($_POST['idtipoveh'])) {
            $idtipoveh_z = $_POST['idtipoveh'];
        }
        if(isset($_POST['idcombustible'])) {
            $idtipogas_z = $_POST['idcombustible'];
        }
        if(isset($_POST['status'])) {
            $status_z = $_POST['status'];
        }
        if(isset($_POST['idzona'])) {
            $idzona_z = $_POST['idzona'];
        }
		
        if($modo_z == 'agregar_ok') {
			agrega_vehiculo( $codigo_z, $descripcion_z, $idtipoveh_z,
				$idmarca_z,	$modelo_z, $fecing_z, $baja_z, $status_z, $placas_z,
				$chasis_z, $sermot_z, $maxtac_z, $kilom_z, $tacacu_z, $nvohasta_z,
				$nvousa_z, $idtipogas_z, $caractm_z, $tipllanta_z, $bateria_z,
				$polseg_z, $venpol_z, $idchofer_z, $camtac_z, $kmtcamtac_z,
				$fecamtac_z, $idzona_z
			);
        } 
        
        if($modo_z == 'eliminar_ok') {
            elimina_vehiculos($idvehiculo_z);
        }
        if($modo_z == 'modificar_ok') {
			modifica_vehiculo($idvehiculo_z, $codigo_z, $descripcion_z, $idtipoveh_z,
				$idmarca_z,	$modelo_z, $fecing_z, $baja_z, $status_z, $placas_z,
				$chasis_z, $sermot_z, $maxtac_z, $kilom_z, $tacacu_z, $nvohasta_z,
				$nvousa_z, $idtipogas_z, $caractm_z, $tipllanta_z, $bateria_z,
				$polseg_z, $venpol_z, $idchofer_z, $camtac_z, $kmtcamtac_z,
				$fecamtac_z, $idzona_z
			);
        } 
	} elseif (isset($_POST['cancelar'])) {
			// SI es cancelar me regreso a la pagina principal
			echo "<script>";
			echo "window.location = '../../index.php?menu=vehiculos';";
			echo "</script>";
	}
	else {
        require_once('php/ejecuta_query.php');

    }

	function busca_vehiculos() {
		$conn=conecta();
		$sql = "select a.idvehiculo,a.codigo,a.descri,a.idmarcaveh,a.modelo,a.fecing,
		  a.fecbaj,a.status,a.placas,a.chasis,a.sermot,a.maxtac,a.kilom,
		  a.tacacu,a.nvohasta,a.nvousa,a.tipogas,a.caractm,a.tipllanta,
		  a.bateria,a.polseg,a.venpol,a.idchofer,a.camtac,a.kmtcamtac,a.zona,
		  a.idtipovehiculo, a.fecamtac,a.cia,
		  c.descripcion as descritipoveh,
		  d.codigo as cvechofer
		  from vehiculos a join marcas b on a.idmarcaveh = b.idmarca
		  join combustibles c on a.tipogas = c.idcombustible
		  join choferes d on a.idchofer = d.idchofer order by a.codigo";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
	}
	
	function busca_mi_vehiculo($idvehiculo_z) {
		$conn=conecta();
		$sql = sprintf("select a.idvehiculo,a.codigo,a.descri,a.idmarcaveh,a.modelo,a.fecing,
		  a.fecbaj,a.status,a.placas,a.chasis,a.sermot,a.maxtac,a.kilom,
		  a.tacacu,a.nvohasta,a.nvousa,a.tipogas,a.caractm,a.tipllanta,
		  a.bateria,a.polseg,a.venpol,a.idchofer,a.camtac,a.kmtcamtac,a.zona,
		  a.idtipovehiculo, a.fecamtac,a.cia,
		  c.descripcion as descritipoveh,
		  d.codigo as cvechofer
		  from vehiculos a join marcas b on a.idmarcaveh = b.idmarca
		  join combustibles c on a.tipogas = c.idcombustible
		  join choferes d on a.idchofer = d.idchofer 
		  where idvehiculo=%s order by a.codigo", $idvehiculo_z);
		//echo "<br>" . $sql . "<br>";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }

    
	function agrega_vehiculo(
		$codigo_z, $descripcion_z, $idtipoveh_z,
		$idmarca_z,	$modelo_z, $fecing_z, $baja_z, $status_z, $placas_z,
		$chasis_z, $sermot_z, $maxtac_z, $kilom_z, $tacacu_z, $nvohasta_z,
		$nvousa_z, $idtipogas_z, $caractm_z, $tipllanta_z, $bateria_z,
		$polseg_z, $venpol_z, $idchofer_z, $camtac_z, $kmtcamtac_z,
		$fecamtac_z, $idzona_z) 
	{
		$conn=conecta();
		$idperio_z = 0;
		$status_z = substr($status_z, 0, 1);
		
		$sql =  sprintf("insert into vehiculos  (codigo,descri, idmarcaveh,
		  modelo,fecing,fecbaj,status,placas,chasis,sermot,maxtac,kilom,tacacu,
		  nvohasta,nvousa,tipogas,caractm,tipllanta,bateria,polseg,venpol,idchofer,
		  camtac,kmtcamtac,zona,fecamtac,cia, idtipovehiculo)
		values (%s, '%s', %s, '%s', '%s', '%s', '%s', '%s', '%s', '%s',
		%s, %s, %s, %s, '%s', %s, '%s', '%s', '%s', '%s', '%s', %s,
		'%s', %s, %s, '%s',1, %s)",  
		$codigo_z, $descripcion_z, $idmarca_z,
		$modelo_z, $fecing_z, $baja_z, $status_z, $placas_z,
		$chasis_z, $sermot_z, $maxtac_z, $kilom_z, $tacacu_z, $nvohasta_z,
		$nvousa_z, $idtipogas_z, $caractm_z, $tipllanta_z, $bateria_z,
		$polseg_z, $venpol_z, $idchofer_z, $camtac_z, $kmtcamtac_z,
		$idzona_z, $fecamtac_z,  $idtipoveh_z);
		echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		//alertas_vehiculos("Vehiculo Agregado");
		return (0);
	}

	function modifica_vehiculo(
		$idvehiculo_z, $codigo_z, $descripcion_z, $idtipoveh_z,
		$idmarca_z,	$modelo_z, $fecing_z, $baja_z, $status_z, $placas_z,
		$chasis_z, $sermot_z, $maxtac_z, $kilom_z, $tacacu_z, $nvohasta_z,
		$nvousa_z, $idtipogas_z, $caractm_z, $tipllanta_z, $bateria_z,
		$polseg_z, $venpol_z, $idchofer_z, $camtac_z, $kmtcamtac_z,
		$fecamtac_z, $idzona_z) 
	{
		$conn=conecta();
		$idperio_z = 0;
		$status_z = substr($status_z, 0, 1);
		
		$sql =  sprintf("update vehiculos set descri='%s', 
		  idmarcaveh = %s, modelo='%s',fecing='%s', fecbaj='%s',
		  status='%s', placas='%s',chasis='%s',sermot='%s',maxtac=%s,
		  kilom=%s, tacacu='%s',
		  nvohasta=%s, nvousa='%s', tipogas=%s, caractm='%s', 
		  tipllanta='%s', bateria='%s', polseg='%s', venpol='%s', 
		  idchofer=%s, camtac='%s', kmtcamtac=%s, zona=%s, 
		  fecamtac='%s', idtipovehiculo=%s where idvehiculo=%s",
		  $descripcion_z, $idmarca_z,
		  $modelo_z, $fecing_z, $baja_z, $status_z, $placas_z,
		  $chasis_z, $sermot_z, $maxtac_z, $kilom_z, $tacacu_z, $nvohasta_z,
		  $nvousa_z, $idtipogas_z, $caractm_z, $tipllanta_z, $bateria_z,
		  $polseg_z, $venpol_z, $idchofer_z, $camtac_z, $kmtcamtac_z,
		  $idzona_z, $fecamtac_z,  $idtipoveh_z, $idvehiculo_z);
		echo $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo agregar registro";
		};
		mysqli_close($conn);
		//alertas_vehiculos("Vehiculo Agregado");
		return (0);
	}

	function elimina_vehiculos($idvehiculo_z) {
		$conn=conecta();
		$sql =  sprintf("delete from vehiculos  where idvehiculo = %s", $idvehiculo_z);
		echo "Sql:" . $sql;
		if ( ! $rs = mysqli_query($conn,$sql) ) {
			echo "Error: No se pudo eliminar el registro";
		};
		mysqli_close($conn);
		alertas_vehiculos("Vehiculo Eliminado");
		return (0);
	}

	function alertas_vehiculos($mensaje_z) {
		echo "<script>";
		echo "alert(' . $mensaje_z . ');";
		echo "window.location = '../../index.php?menu=vehiculos';";
		echo "</script>";
	}


?>
