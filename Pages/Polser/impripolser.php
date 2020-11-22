<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- LIBRERIAS BOOTSTRAP-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="../../bootstrap/js/bootstrap.min.js"></script>
	<script src="../../js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="../../js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="../../js/jquery.jqGrid.min.js" type="text/javascript"></script>
</head>
<body>
<?php 
    require('../Common/fpdf/mc_table.php');
	session_start();

    $archivo_z = "servicios_polser.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Polser/servicios_polser.php";
				
	}
	require_once($archivo_z);	
    $archivo_z = "servicios_renposer.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/Polser/servicios_renposer.php";
				
	}
	require_once($archivo_z);	
    $archivo_z = "../common/busca_datos.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "Pages/common/busca_datos.php";
	}
	require_once($archivo_z);	
	//carga la plantilla con la header y el footer
	$idpolser_z = -1;
	$piva_z = 16;
	$statuspol_z  = "A";
	$fecha_z;
	$alm_z;
	$minumcia_z;
	$nomcia_z;
	$dircia_z;
	$alm_z = "";
	$minumcia_z = 1;
	$nomcia_z = "MI CIA";
	$dircia_z = "DIRECCION CIA";
	$fecha_z = date("Y") . "/". date("m") . "/" . date("d");
	if(isset($_SESSION["nomcia"])) {  $nomcia_z = $_SESSION["nomcia"]; }
	if(isset($_SESSION["dircia"])) {  $nomcia_z = $_SESSION["dircia"]; }
	if(isset($_POST['idpolser'])) {
        $idpolser_z = $_POST['idpolser'];
	}
	if($idpolser_z == -1) {
		alertas_renposer("Póliza Inválida", $idpolser_z);
	}

	$polser_z = json_decode(busca_renposer($idpolser_z));
	$mipoli_z =  json_decode(busca_mi_poliza($idpolser_z));
	imprimir_poliza($polser_z, $mipoli_z);
	//alertas_renposer("Aqui ya debio generar el pdf", $idpolser_z);

function imprimir_poliza($polser_z, $mipoli_z) {
	$fecha_z="" ;
	$alm_z = "" ;
	$minumcia_z ="" ;
	$nomcia_z = "" ;
	$dircia_z = "" ;
	$total_z=0;
	$fechaimpresion_z = date("Y-m-d h:m:s");
	foreach ($mipoli_z as $mipolser_z) {
		$fecha_z = $mipolser_z->fecha;
		$alm_z = $mipolser_z->nombre;
		$statuspol_z  = $mipolser_z->status;
	}
    $cintillo_z = "../../imagenes/cintillo.jpg";


	ob_start();
	$pdf = new  PDF_MC_Table('P','mm','Letter');
	$pdf->AliasNbPages();
	$pdf->AddPage();
    encab($pdf, $alm_z, $fecha_z, $cintillo_z);
	$pdf->Ln();
	$pdf->SetFont('Arial','b',9);  
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);
	$pdf->SetLineWidth(.3);
	$pdf->SetFont('','B');
	$pdf->Cell(45,7,'Vehiculo',1,0,'C',1);
	$pdf->Cell(12,7,'Chofer',1,0,'C',1);
	$pdf->Cell(35,7,'Servicio',1,0,'C',1);
	$pdf->Cell(18,7,'Kilometraje',1,0,'C',1);
	$pdf->Cell(30,7,'Taller',1,0,'C',1);
	$pdf->Cell(18,7,'Importe',1,0,'R',1);
	$pdf->Cell(35,7,'Observaciones',1,0,'C',1);
	$pdf->Ln();
	//Restauración de colores y fuentes
	$pdf->SetFillColor(224,235,255);
	$pdf->SetTextColor(0);
	$pdf->SetFont('');

	$numero=0;
	$fill=false;
	$pdf->SetWidths(array(45,12,35,18,30,18,35));
	$pdf->SetAligns(array('L','L','L','L','L','L','R','L'));
	foreach($polser_z as $mipolser_z) {
		$descrivehi_z = $mipolser_z->descrivehi;
		$descriserv_z = $mipolser_z->descriserv;
		if ($mipolser_z->tienealternante == "S") {
			if($mipolser_z->edotoggle == "S") {
				$descriserv_z .= " CON ";
			} else {
				$descriserv_z .= " SIN ";					  
			}
			$descriserv_z .= " " . $mipolser_z->servalternante;
		}
		$obs_z = $mipolser_z->observs;
		$taller_z = $mipolser_z->codigotaller . " " . $mipolser_z->nombretaller;
		$pdf->Row(array(
			$mipolser_z->codvehi . " " . $descrivehi_z,
			$mipolser_z->cvechofer,
			$descriserv_z,
			$mipolser_z->kilom,
			$taller_z,
			number_format( $mipolser_z->costo,   2 ),
			$obs_z
		));
		$total_z = $total_z + $mipolser_z->costo;

	}
	$pdf->Row(array(
		"Totales",
		"",
		"",
		"",
		"",
		number_format( $total_z,   2 ),
		""
	));


	$pdf->Output("impresionpoliza.pdf", "I");
	ob_end_flush(); 
}

function encab($mipdf, $alm_z, $fecha_z, $cintillo_z)   {
      $fechaimpresion_z = date("Y-m-d H:m:s");
      //$mipdf->Image($cintillo_z, 0 ,20,  180, 40,'JPG', 'http://diazysolis.com.mx');
      $posx_z = 10;
      $mipdf->SetXY(5, $posx_z);
      $mipdf->SetFont('Arial','B',6);  
      $mipdf->Cell(30, 30, utf8_decode  ("$fechaimpresion_z "), 0, 0, "L");
      $mipdf->Cell(150,30, $mipdf->Image($cintillo_z, $mipdf->GetX(), $mipdf->GetY(),150,30),0);
      $mipdf->Cell(30, 30,'Pagina '. $mipdf->PageNo().'/{nb}',0,0,'R');
      $mipdf->SetFont('Arial','B',12);
      $posx_z = 40;
      $mipdf->SetXY(5, $posx_z);
      $mipdf->Cell(130, 5, utf8_decode  ("Póliza de Servicios: $alm_z Fecha: $fecha_z "), 0, 0, "C");
      //$pdf->SetFont('Arial','B',10);
     //$pdf->MultiCell(190,5, "Fecha: $fechaimpresion_z", 0, "C", false);
    
}

?>
