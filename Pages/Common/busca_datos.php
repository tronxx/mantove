<?php
	$modo_z = "";
	if(isset($_GET['modo'])) {
		$modo_z = $_GET['modo'];
        require_once('../../php/ejecuta_query.php');
        if(isset($_GET['idvehiculo'])) {
            $idvehiculo_z = $_GET['idvehiculo'];
        }
        if($modo_z == "BUSCA_ULTIMO_KMT" ) {
            echo busca_ultimo_kmt();
        }
        if($modo_z == "BUSCA_PRECIO_GAS" ) {
            echo busca_preciolitro();
        }
        if($modo_z == "BUSCA_SERVOP" ) {
            echo busca_serv_op();
        }
        if($modo_z == "BUSCA_SIGSERV" ) {
            echo busca_sigserv();
        }
        if($modo_z == "BUSCA_DATOS_CIA" ) {
            echo busca_datos_cia();
        }
        if($modo_z == "BUSCA_CIUDADES" ) {
            echo busca_ciudades();
        }
        if($modo_z == "BUSCA_ZONAS" ) {
            echo busca_zonas();
        }
        if($modo_z == "BUSCA_CHOFERES" ) {
            echo busca_choferes();
        }
    }


    function busca_zonas() {
		$conn=conecta();
		$sql = "select idzona, numero, zona from zonas order by numero";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }


    function busca_ciudades() {
		$conn=conecta();
		$sql = "select idciudad, ciudad from ciudades order by ciudad";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }


	function busca_ultimo_kmt() {
        $idvehiculo_z = 0;
        $fechanota_z = date("Y") . "-". date("m") . "-" . date("d");
        if(isset($_GET['idvehiculo'])) {
            $idvehiculo_z = $_GET['idvehiculo'];
        }
        if(isset($_GET['fechanota'])) {
            $fechanota_z = $_GET['fechanota'];
        }
        $conn=conecta();
        
        $sql = sprintf("select d.KMTACT from poligas e join renpogas d 
         on e.idpoligas = d.idpoligas
        where e.fecha = 
        (
          select max(fecha) from poligas pp
            join renpogas bb on pp.IDPOLIGAS = bb.IDPOLIGAS
          where pp.FECHA <= '%s'
           and bb.IDVEHICULO = %s) and d.idvehiculo=%s", 
           $fechanota_z, $idvehiculo_z,  $idvehiculo_z);
           //echo "<br>" . $sql . "<br>";
        $rs = mysqli_query($conn,$sql);
        
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
        mysqli_close($conn);
		return (json_encode($encode));
    }

    
	function busca_preciolitro() {
        $idcombustible_z = 0;
        $fechanota_z = date("Y") . "-". date("m") . "-" . date("d");
        if(isset($_GET['idcombustible'])) {
            $idcombustible_z = $_GET['idcombustible'];
        }
        if(isset($_GET['fechanota'])) {
            $fechanota_z = $_GET['fechanota'];
        }
        $conn=conecta();
        
		$sql = sprintf("select fecha, precio from precioscombustible a
        where a.idCombustible  = %s and fecha = 
        (select max(fecha) from precioscombustible b
          where b.idCombustible = a.idCombustible and fecha <= '%s')",
          $idcombustible_z, $fechanota_z);
        //echo $sql . "<br>";
		$rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
		mysqli_close($conn);
		return (json_encode($encode));
    }
    

	function busca_serv_op() {
        $idservmanto_z = 0;
        
        if(isset($_GET['idservmanto'])) {
            $idservmanto_z = $_GET['idservmanto'];
        }
        $conn=conecta();
        
        $sql = sprintf("select toggle, servop from servmanto where idservmanto=%s", $idservmanto_z);
        //echo $sql . "<br>";
        $rs = mysqli_query($conn,$sql);
        
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
        mysqli_close($conn);
		return (json_encode($encode));
    }

	function busca_sigserv() {
        $idvehiculo_z = 0;
        $fechanota_z = date("Y") . "-". date("m") . "-" . date("d");
        if(isset($_GET['idvehiculo'])) {
            $idvehiculo_z = $_GET['idvehiculo'];
        }
        if(isset($_GET['fecha'])) {
            $fechanota_z = $_GET['fecha'];
        }
        $conn=conecta();
        
        $sql = sprintf("select b.*, a.nvousa, tacacu from servmanto b 
        join vehiculos a 
        on a.idtipovehiculo = b.idtipovehiculo
        where a.idvehiculo = %s and b.perio = 'S'
        order by clave", $idvehiculo_z);
        $rs = mysqli_query($conn,$sql);
        
		$encode = array();
		while ($row =  mysqli_fetch_array($rs,MYSQLI_ASSOC)) {
            $kmofec_z = $row["KMOFE"];
            $toler_z = $row["TOLER"];
            $xcada_z = $row["XCADA"];
            $xcadanvo_z = $row["XCADANVO"];
            $descri_z = $row["DESCRI"];
            $esnuevo_z = $row["nvousa"];
            $cveserv_z = $row["CLAVE"];
            $kmtact_z = $row["tacacu"];
            if($esnuevo_z == "N") {
                $sigte_z = $xcadanvo_z;
            } else {
                $sigte_z = $xcada_z;
            }
    
            $idservmanto_z = $row["IDSERVMANTO"];
            if($kmofec_z == "D") {
                $sql = sprintf("select max(fecha) as ultifec from renposer 
                where idvehiculo = %s and idservmanto = %s
                and fecha <= '%s'", $idvehiculo_z, $idservmanto_z, $fechanota_z);
                $rs2 = mysqli_query($conn,$sql);
                while ($row2 =  mysqli_fetch_array($rs2,MYSQLI_ASSOC)) {
                    $ultifec_z = $row2["ultifec"];
                    if (empty($ultifec_z)) {
                        $ultifec_z = date("Y-m-d", strtotime($fechanota_z. " - 1 year"));
                    }
                    $proximo_z = date("Y-m-d", strtotime($ultifec_z. " + " . $sigte_z . " days"));
                    $proxbajo_z = date("Y-m-d", strtotime($fechanota_z. " - " . $sigte_z . " days"));
                    if ($proximo_z < $proxbajo_z) {
                        $d1_z = new DateTime($proximo_z);
                        $d2_z = new DateTime($fechanota_z);
                        $difer_z = $d2_z->diff($d1_z);
                        $diasdif_z = $difer_z->days;
                        //$diasdif_z = $difer_z->d;
                        if ($diasdif_z > ($toler_z + $sigte_z)) {
                            $urgente_z = "S";
                        } else {
                            $urgente_z = "N";
                        }
                        $encode[] = array("clave"=>$cveserv_z, "descri"=>$descri_z, "ultimo"=>$ultifec_z, "proximo"=>$proximo_z, "urgente"=>$urgente_z);
                    }
                }
            } else {
                $sql = sprintf("select max(kilom) as ultkm from renposer 
                where idvehiculo = %s and idservmanto = %s
                and fecha <= '%s'", $idvehiculo_z, $idservmanto_z, $fechanota_z);
                $rs2 = mysqli_query($conn,$sql);
                while ($row2 =  mysqli_fetch_array($rs2,MYSQLI_ASSOC)) {
                    $ultkmt_z = $row2["ultkm"];
                    if (empty($ultkmt_z)) {
                        $ultkmt_z = 0;
                    }
                    $proximo_z = $ultkmt_z  + $sigte_z;
                    $proxbajo_z = $kmtact_z - $sigte_z;
                    if($proximo_z < $proxbajo_z) {
                        $kmsdif_z =  $kmtact_z - $ultkmt_z;
                        if ($kmsdif_z > ($toler_z + $sigte_z)) {
                            $urgente_z = "S";
                        } else {
                            $urgente_z = "N";
                        }
                        $encode[] = array("clave"=>$cveserv_z, "descri"=>$descri_z, "ultimo"=>$ultkmt_z, "proximo"=>$proximo_z, "urgente"=>$urgente_z);
                    }
                }
            }
		}
        mysqli_close($conn);
		return (json_encode($encode));
    }
    
	function busca_datos_cia() {
        $minumcia_z = 1;
        if(isset($_GET['MINUMCIA'])) {
            $minumcia_z = $_GET['MINUMCIA'];
        }
        $conn=conecta();
        
        $sql = sprintf("select cia, razon, dir, dir2, nomfis, tel, rfc
           from cias where cia = %s", $minumcia_z);
           //echo "<br>" . $sql . "<br>";
        $rs = mysqli_query($conn,$sql);
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
		}
        mysqli_close($conn);
		return (json_encode($encode));
    }

	function busca_usuario($login_z, $clave_z) {
        $conn=conecta();
        
        $sql = sprintf("select * from car_usuarios where login = '%s' 
           and clave='%s'", 
           $login_z, $clave_z);
           echo "<br>" . $sql . "<br>";
        $rs = mysqli_query($conn,$sql);
        
		$encode = array();
		while ($row =  mysqli_fetch_array($rs)) {
			  $encode[] = $row;
            
		}
        mysqli_close($conn);
		return (json_encode($encode));
    }

    function checa_sesion() {
        $status = session_status();
        if($status == PHP_SESSION_NONE){
            echo "No Tengo Sesion Activa<br>";
          //There is no active session
          $archivo_z = "../Login/login.php";
          if(!file_exists($archivo_z)) {
              $archivo_z = "Pages/Login/login.php";
          }
          $abrelogin_z = "location: " . $archivo_z;
      
          //header($abrelogin_z);
        }
    }
    
?>
