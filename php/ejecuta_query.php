<?php
    error_reporting(E_ALL  ^  E_WARNING );    
    $accion_z = "";
    //$accion_z = "$_GET['accion']";
  	
    if($accion_z == "getcia") {
      $cia_z = $_GET['cia'];
      busca_cia($cia_z);
    }

	function busca_cia($cia_z) {
		return (0);
	}

	function conecta() {
		$data_source='localhost:3306';
		$user='root';
		$password='';
		$basedatos = 'mantove';
       //$data_source='localhost';
       //$user='root';
       //$password='';
	     //$basedatos = 'mantove';
       //echo "DataSource:" . $data_source;
       //echo " User:" . $user;
       //echo " Password:" . $password;
       $conn=mysqli_connect($data_source,$user,$password, $basedatos );
		if (!($conn)) { 
		  echo "<p>Connection to DB failed: ";
		  echo "Ha ocurrido un error en la conexion a la BD";
		  echo "</p>\n";
		}
		// mysql_select_db('my_database') or die('No se pudo seleccionar la base de datos');
		//$db = mysqli_select_db( $conn, ) or die ( "No se ha podido conectar a la base de datos" );
 	    
		return ($conn);
	}


	function busca_articulos($linea_z) {
		$conn=conecta();
		$sql = "select linea, b.codigo as grupo, b.descri as nombregpo, a.codigo, a.descri, precio, a.empaqe, 
		(a.existes + a.existen )  as exist
		  from inven a join inv_invhist c on a.codigo = c.codigo and a.cia = c.cia
		  join inv_relinv d on c.idart = d.idart and d.idrel = 1
		  join inv_grupos b on d.iddato = b.idgrupo 
		  where a.linea = '". $linea_z ."' and a.empaqe <> 'REMATE' and a.empaqe <> 'DESCONT'  and a.empaqe <> 'UNICO' 
		  order by linea, b.codigo, b.descri, a.codigo, a.descri, precio, a.empaqe";

		$rs = odbc_exec($conn,$sql);
		$encode = array();
		while ($row = odbc_fetch_row($rs)) {
			  $encode[] = array(
			  	  "codigo" => limpiarString(odbc_result($rs,"codigo")),
			  	  "descri" => limpiarcadena(odbc_result($rs,"descri")),
			  	  "grupo" => limpiarcadena(odbc_result($rs,"nombregpo")),
			  	  "precio" => odbc_result($rs,"precio"),
			  	  "exist" => odbc_result($rs,"exist")
			  	);

		}
		odbc_close($conn);
		return (json_encode($encode));
	}

	function limpiarcadena($cadena=""){
	  $datos = explode(" ", $cadena);//separar palabras
	  if(is_array($datos) && count($datos)>0) {
	    $aux="";
	    for($i=0;$i<count($datos);$i++) {
	        $aux.= limpiarString($datos[$i])." ";
	    }
        $cadena = $aux;
      } else {
        $cadena = limpiarString($dadena);
      }
      return $cadena;
    }

    function limpiarString($texto) {
    	$textoLimpio = preg_replace('([^A-Za-z0-9])', '_', $texto);
        return $textoLimpio;
    }

	function busca_detalle($codigo_z) {
		$conn=conecta();
		$sql = "SELECT a.codigo, a.descri, a.linea, a.precio  from inven a  
		  where codigo = '". $codigo_z. "' and ( empaqe <> 'REMATE' and empaqe <> 'UNICO' ) order by codigo";
		$rs = odbc_exec($conn,$sql);
		$encode = array();
		while ($row = odbc_fetch_row($rs)) {
			  $encode[] = array(
			  	  "codigo" => limpiarString(odbc_result($rs,"codigo")),
			  	  "descri" => limpiarcadena(odbc_result($rs,"descri")),
			  	  "linea" => limpiarcadena(odbc_result($rs,"linea")),
			  	  "precio" => odbc_result($rs,"precio")
			  	);

		}
		odbc_close($conn);
		return (json_encode($encode));
	}

	function busca_exist($codigo_z) {
		$conn=conecta();
		$sql = "select a.alm, a.existes + a.existen  as  exist from exist a  
		  where a.codigo = '" . $codigo_z . "' and ( alm not in ('BO', 'IB', 'SB' ) ) 
		  and a.existes + a.existen  > 0 order by alm";

		$rs = odbc_exec($conn,$sql);
		$encode = array();
		while ($row = odbc_fetch_row($rs)) {
			  $encode[] = array(
			  	  "alm"   => odbc_result($rs,"alm"),
			  	  "exist" => odbc_result($rs,"exist")
			  	);

		}
		odbc_close($conn);
		return (json_encode($encode));
	}

	function busca_imagen_art($linea_z= "", $codigo_z="", $numimg_z = 0){
		$src_z = "http://www.diazysolis.com.mx/catalogo/html/fotos/";
		$empty_z = "-1";
		$src_z = $src_z . $linea_z . "/";
		$ult_z = "";
		if($numimg_z > 0 ) {
			$ult_z = "_" . $numimg_z;
			$src_z = $src_z . $codigo_z . $ult_z . ".jpg";
			if (!is_array(@getimagesize($src_z))) 
			{ 
				$src_z = "-1";
			} 
		} else {
			$src_z = $src_z . $codigo_z . $ult_z . ".jpg";
		}
        return ($src_z) ;
		}
		
		function busca_iddirec($direccion_z) {
			$conn=conecta();
			$iddirec_z = 0;
			$sql =  sprintf("select iddirec from direcciones where direccion = '%s", $direccion_z); 
			$sql =  sprintf("insert into chofer (codigo, nombre) 
				values ('%s', '%s')",  $clave_z, $nombre_z);
			if ( ! $rs = mysqli_query($conn,$sql) ) {
				echo "Error: No se pudo agregar registro";
			};
			mysqli_close($conn);
			alertas("Almacen Agregado");
			return (0);
		}

		function busca_idtelefono($telefono_z) {
			$conn=conecta();
			$idtelefono_z = -1;
			$sql =  sprintf("select idtelefono from telefonos where telefono = '%s", $telefono_z); 
			if ( ! $rs = mysqli_query($conn,$sql) ) {
				echo "Error: No se pudo consultar";
			}
			while ($row = mysqli_fetch_array($rs)) {
				$idtelefono_z = $row['idtelefono'];
			}
			if($idtelefono_z == -1 ) {
				$sql =  sprintf("insert telefonos (telefono) 
				values ('%s')",  $telefono_z);
			    if ( ! $rs = mysqli_query($conn,$sql) ) {
					echo "Error: No se pudo agregar registro";
				};
				$idtelefono_z= $mysqli->insert_id;
			}
			mysqli_close($conn);
			return ($idtelefono_z);
		}
?>
