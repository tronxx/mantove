<?php 
  date_default_timezone_set("America/Mexico_City");
  require('../Common/fpdf/mc_table.php');
  $archivo_z = "servicios_renpogas.php";
  if(!file_exists($archivo_z)) {
    $archivo_z = "Pages/Poligas/servicios_renpogas.php";
        
  }
  require_once($archivo_z); 

  $archivo_z = "servicios_poligas.php";
  if(!file_exists($archivo_z)) {
    $archivo_z = "Pages/Poligas/servicios_poligas.php";
        
  }
  require_once($archivo_z); 

  //carga la plantilla con la header y el footer

  if ( ! function_exists( 'exif_imagetype' ) ) {
    function exif_imagetype ( $filename ) {
        if ( ( list($width, $height, $type, $attr) = getimagesize( $filename ) ) !== false ) {
            return $type;
        }
    return false;
    }
  }
  $dirimgs_z = "../html/fotos";
  $poligas_z = "";
  $idpoligas_z = -1;
  $piva_z = 16;
  $fecha_z = date("Y") . "/". date("m") . "/" . date("d");
  $fechaimp_z = date("Y") . "/". date("m") . "/" . date("d");
  $alm_z = "";
  if(isset($_POST['idpoligas'])) {
        $idpoligas_z = $_POST['idpoligas'];
    }
  $poligas_z = json_decode(busca_renpogas($idpoligas_z));
  $mipoli_z  =  json_decode(busca_mi_poliza($idpoligas_z));



  genera_pdf($mipoli_z, $poligas_z);
  //manda_a_renpogas($idpoligas_z);

function genera_pdf( $mipoli_z, $renpoligas_z) {
  $cintillo_z = "../../imagenes/cintillo.jpg";
  foreach ($mipoli_z as $mipoligas_z) {
    $fecha_z = $mipoligas_z->fecha;
    $alm_z = $mipoligas_z->nombre;
    $statuspol_z  = $mipoligas_z->status;
  }
  ob_start();

  $pdf = new  PDF_MC_Table('P','mm','Letter');
  $pdf->$alm_z = $alm_z;
  $pdf->$fecha_z = $fecha_z;
  $pdf->AliasNbPages();
  //$pdf = new  FPDF();
  $pdf->AddPage();
  encab($pdf, $alm_z, $fecha_z, $cintillo_z);
  //$pdf->Image($cintillo_z, 0 ,0,  217, 40,'JPG', 'http://diazysolis.com.mx');
  //$top_datos=45;
  //$posx_z = 45;
  //$pdf->SetXY(5, $posx_z);
    //Salto de línea
  //$pdf->SetFont('Arial','',8);
  //$pdf->Cell(20, 5, utf8_decode  ("$fechaimp_z "), 0, 2, "L");
  //$pdf->SetFont('Arial','B',14);
  //$pdf->Image('cintillo.jpg',10,8,400);
  //$pdf->Cell(170, 5, utf8_decode  ("Poliza de Gasolina: $alm_z Fecha: $fecha_z "), 0, 2, "C");
  //$pdf->SetFont('Arial','B',10);
  //$pdf->MultiCell(190,5, "Fecha: $fechaimpresion_z", 0, "C", false);
  $pdf->Ln();

  // Datos de la tienda
  $pdf->SetFont('Arial','B',12);

  $encabtabla_z = array();
  array_push($encabtabla_z, array('descri' => "Vehiculo", "ancho"=> 60, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Chofer", "ancho"=> 10, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Zona", "ancho"=> 10, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Kmt.Ant", "ancho"=> 11, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Kmt.Act", "ancho"=> 11, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Recorr", "ancho"=> 10, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Litros", "ancho"=> 10, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Rendto", "ancho"=> 10, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Pre.Lt", "ancho"=> 10, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Importe", "ancho"=> 11, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Fec.Nota", "ancho"=> 16, align=>"C"  ));
  array_push($encabtabla_z, array('descri' => "Forma.Pago", "ancho"=> 20, align=>"C"  ));

  $pdf->SetFont('Arial','b',7);
  $pdf->SetFillColor(255,255,255);
  $pdf->SetTextColor(0);
  $pdf->SetDrawColor(0,0,0);
  $pdf->SetLineWidth(.3);
  $pdf->SetFont('','B');
  foreach ($encabtabla_z as $miencol_z) {
    $pdf->Cell($miencol_z["ancho"],5,$miencol_z["descri"],1,0,$miencol_z["align"],1);
    # code...
  }
  $pdf->Ln();
  $totrec_z = 0;
  $totimporte_z = 0;
  $totlitros_z = 0;
  $pdf->SetFont('');
  foreach ($renpoligas_z as $mirenglon_z) {
    $rendto_z = 0;
    if($mipoligas_z->litros <> 0) {
      $rendto_z = $mirenglon_z->recorr / $mirenglon_z->litros;
    }
    $columnas_z  = array();
    array_push($columnas_z, array('descri' => $mirenglon_z->codvehi . " " . $mirenglon_z->descrivehi, "ancho"=> 60, align=>"L"  ));
    array_push($columnas_z, array('descri' => $mirenglon_z->cvechofer, "ancho"=> 10, align=>"L"  ));
    array_push($columnas_z, array('descri' => $mirenglon_z->zona, "ancho"=> 10, align=>"C"  ));
    array_push($columnas_z, array('descri' => $mirenglon_z->kmtant, "ancho"=> 11, align=>"R"  ));
    array_push($columnas_z, array('descri' => $mirenglon_z->kmtact, "ancho"=> 11, align=>"R"  ));
    array_push($columnas_z, array('descri' => $mirenglon_z->recorr, "ancho"=> 10, align=>"R"  ));
    array_push($columnas_z, array('descri' => number_format($mirenglon_z->litros, 2), "ancho"=> 10, align=>"R"  ));
    array_push($columnas_z, array('descri' => sprintf("%1.2f", $rendto_z), "ancho"=> 10, align=>"R"  ));
    array_push($columnas_z, array('descri' => number_format($mirenglon_z->preciou, 2), "ancho"=> 10, align=>"R"  ));
    array_push($columnas_z, array('descri' => number_format($mirenglon_z->total, 2), "ancho"=> 11, align=>"R"  ));
    array_push($columnas_z, array('descri' => $mirenglon_z->fecnot, "ancho"=> 16, align=>"C"  ));
    array_push($columnas_z, array('descri' => $mirenglon_z->descritipago, "ancho"=> 20, align=>"L"  ));
    foreach ($columnas_z as $micolum_z) {
       $pdf->Cell($micolum_z["ancho"],5,$micolum_z["descri"] ,1,0,$micolum_z["align"] ,1);
      # code...
    }
    $pdf->Ln();
    $totrec_z += $mirenglon_z->recorr;
    $totlitros_z += $mirenglon_z->litros;
    $totimporte_z += $mirenglon_z->total;
  }
  if($totlitros_z <> 0) {
      $rendto_z = $totrec_z / $totlitros_z;
  }
  $columnas_z  = array();
  array_push($columnas_z, array('descri' => "Totales", "ancho"=> 60, align=>"C" ));
  array_push($columnas_z, array('descri' => "", "ancho"=> 10, align=>"C"  ));
  array_push($columnas_z, array('descri' => "", "ancho"=> 10, align=>"C"  ));
  array_push($columnas_z, array('descri' => "", "ancho"=> 11, align=>"C"  ));
  array_push($columnas_z, array('descri' => "", "ancho"=> 11, align=>"C"  ));
  array_push($columnas_z, array('descri' => $totrec_z, "ancho"=> 10, align=>"R"  ));
  array_push($columnas_z, array('descri' => number_format($totlitros_z, 2), "ancho"=> 10, align=>"R"  ));
  array_push($columnas_z, array('descri' => number_format($rendto_z, 2), "ancho"=> 10, align=>"R"  ));
  array_push($columnas_z, array('descri' => "", "ancho"=> 10, align=>"C"  ));
  array_push($columnas_z, array('descri' => number_format($totimporte_z, 2), "ancho"=> 11, align=>"R"  ));
  array_push($columnas_z, array('descri' => "", "ancho"=> 16, align=>"C"  ));
  array_push($columnas_z, array('descri' => "", "ancho"=> 20, align=>"C"  ));
  foreach ($columnas_z as $micolum_z) {
     $pdf->Cell($micolum_z["ancho"],5,$micolum_z["descri"] ,1,0,$micolum_z["align"],1);
    # code...
  }
  $pdf->Ln();
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
      $mipdf->Cell(130, 5, utf8_decode  ("Póliza de Gasolina: $alm_z Fecha: $fecha_z "), 0, 0, "C");
      //$pdf->SetFont('Arial','B',10);
     //$pdf->MultiCell(190,5, "Fecha: $fechaimpresion_z", 0, "C", false);
    
  }


?>
