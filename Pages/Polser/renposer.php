<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="es">
<!--<![endif]-->
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- LIBRERIAS BOOTSTRAP-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="../../bootstrap/js/bootstrap.min.js"></script>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>
<?php 
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
	$polser_z = "";
	$idpolser_z = 0;
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
	session_start();
	$nomcia_z = $_SESSION["nomcia"];
	$dircia_z = $_SESSION["dircia"];
	if(isset($_POST['idpolser'])) {
        $idpolser_z = $_POST['idpolser'];
	}
	$polser_z = json_decode(busca_renposer($idpolser_z));
	$mipoli_z =  json_decode(busca_mi_poliza($idpolser_z));
	foreach ($mipoli_z as $mipolser_z) {
		$fecha_z = $mipolser_z->fecha;
		$alm_z = $mipolser_z->nombre;
		$statuspol_z  = $mipolser_z->status;
	}
	if(isset($_POST['modo'])) {
		$modo_z = $_POST['modo'];
		if ($modo_z == "imprimir") {
			imprimir_poliza($idpolser_z);
		}
	}
 ?>
<h1> Poliza de Servicios </h1>

<form action="edicion_renposer.php" method="post">
<div class="table-responsive">
<table class="table table-hover" border = "1">
<tr>
<th>
<?php echo $nomcia_z . " Almacen:" . $alm_z . " Fecha:" . $fecha_z; ?>
</th>
</tr>
</table>
<table>
<tr>
<td>
<input type="hidden" name="modo" value="Agregar_renposer">
<?php 
    $cadena_z = "";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idpolser\" value=\"". $idpolser_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"fecha\" value=\"". $fecha_z  . "\" >";
	echo $cadena_z;
	$cadena_z = "";
	if($statuspol_z == "A") {
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\" name=\"Agregar\" value =\"Agregar_renposers\">Agregar Movimiento</button>";
		$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\" name=\"Cerrar\" value =\"Cerrar_polser\">Cerrar Poliza</button>";
		echo $cadena_z;
	 }

?>
</td>
</tr>
</table>
</div>
</form>

<br>

	<div class="table-responsive">
		<table class="table table-hover" border="1">
			<thead>
				<tr>
					<th>Vehiculo</th>
					<th>Descripcion Vehiculo</th>
					<th>Chofer</th>
					<th>Servicio</th>
					<th>Kilometraje</th>
					<th>Taller</th>
					<th>$ Total</th>
					<th>Observaciones</th>
				</tr>
			</thead>
			<tbody>
            <?php
  		       foreach ($polser_z as $mipolser_z) {
				  echo "<tr>";
				  echo "<td>" . $mipolser_z->codvehi       . "</td>";
				  echo "<td>" . $mipolser_z->descrivehi    . "</td>";
				  echo "<td>" . $mipolser_z->cvechofer     . "</td>";
				  $cadena_z = $mipolser_z->descriserv;
				  if ($mipolser_z->tienealternante == "S") {
					  if($mipolser_z->edotoggle == "S") {
						$cadena_z .= " CON ";
					  } else {
						$cadena_z .= " SIN ";					  
					  }
					$cadena_z .= " " . $mipolser_z->servalternante;

				  }
				  echo "<td>" . $cadena_z    . "</td>";
				  echo "<td>" . $mipolser_z->kilom         . "</td>";
				  echo "<td>" . $mipolser_z->codigotaller . " " . $mipolser_z->nombretaller  . "</td>";
				  echo "<td>" . number_format( $mipolser_z->costo,   2 ) . "</td>";
				  echo "<td>" . $mipolser_z->observs . "</td>";
				  if($statuspol_z == "A") {
				     $cadena_z = boton_modificar($mipolser_z->idrenposer, 
					   $mipolser_z->codvehi);
				  }
				  echo "<td>" . $cadena_z . "</td>";
				  echo "</tr>";
				  echo "\n";
			   }
			?>
			</tbody>
		</table>
	</div>
</div>
<?php 

function boton_modificar($idrenposer_z, $codvehi_z) {
	$cadena_z = "<form action=\"Pages/Polser/edicion_renposer.php\" method=\"post\">";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"idrenposer\" value=\"". $idrenposer_z  . "\" >";
	$cadena_z = $cadena_z . "<input type =\"hidden\" name=\"vehiculo\" value=\"". $codvehi_z  . "\" >";
	//$cadena_z = $cadena_z . "<button type=\"submit\" class=\"btn btn-primary\"  name=\"modo\" value=\"modificar\" >Modificar</button>";
	$cadena_z = $cadena_z . " <button type=\"submit\" class=\"btn btn-danger\"  name=\"modo\" value=\"eliminar_renglon\" >Eliminar</button>";
	$cadena_z = $cadena_z . "</form>";
	return ($cadena_z);
  }

function imprimir_poliza($idpolser_z) {
    $archivo_z = "fpdf/fpdf.php";
	if(!file_exists($archivo_z)) {
		$archivo_z = "../../fpdf/fpdf.php";
				
	}
	require($archivo_z);
	$mipoli_z =  json_decode(busca_mi_poliza($idpolser_z));
	$polser_z = json_decode(busca_renposer($idpolser_z));
	global $fecha_z;
	global $alm_z;
	global $minumcia_z;
	global $nomcia_z;
	global $dircia_z;
	$total_z=0;
	$fechaimpresion_z = date("Y-m-d h:m:s");

	class PDF_MC_Table extends FPDF
	{
		var $widths;
		var $aligns;
	
		function SetWidths($w)	{
			//Set the array of column widths
			$this->widths=$w;
		}
		
		function SetAligns($a)	{
			//Set the array of column alignments
			$this->aligns=$a;
		}
	
		function Row($data)	{
			//Calculate the height of the row
			$nb=0;
			for($i=0;$i<count($data);$i++)
				$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
			$h=5*$nb;
			//Issue a page break first if needed
			$this->CheckPageBreak($h);
			//Draw the cells of the row
			for($i=0;$i<count($data);$i++)	{
				$w=$this->widths[$i];
				$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
				//Save the current position
				$x=$this->GetX();
				$y=$this->GetY();
				//Draw the border
				$this->Rect($x,$y,$w,$h);
				//Print the text
				$this->MultiCell($w,5,$data[$i],0,$a);
				//Put the position to the right of the cell
				$this->SetXY($x+$w,$y);
			}
			//Go to the next line
			$this->Ln($h);
		}
	
		function CheckPageBreak($h)	{
			//If the height h would cause an overflow, add a new page immediately
			if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
		}
	
		function NbLines($w,$txt)	{
			//Computes the number of lines a MultiCell of width w will take
			$cw=&$this->CurrentFont['cw'];
			if($w==0)
				$w=$this->w-$this->rMargin-$this->x;
			$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			$s=str_replace("\r",'',$txt);
			$nb=strlen($s);
			if($nb>0 and $s[$nb-1]=="\n") $nb--;
			$sep=-1;
			$i=0;
			$j=0;
			$l=0;
			$nl=1;
			while($i<$nb)	{
				$c=$s[$i];
				if($c=="\n")	{
					$i++;
					$sep=-1;
					$j=$i;
					$l=0;
					$nl++;
					continue;
				}
				if($c==' ')	$sep=$i;
				$l+=$cw[$c];
				if($l>$wmax) {
					if($sep==-1) {
						if($i==$j)	$i++;
					} else{
						$i=$sep+1;
					}
					$sep=-1;
					$j=$i;
					$l=0;
					$nl++;
				} else {
					$i++;
				}
			}
			return $nl;
		}
	}	

	ob_start();
	$pdf = new  PDF_MC_Table('P','mm','Letter');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','b',7);
	$pdf->Cell(25,3,$fechaimpresion_z,0,'L');
	$pdf->SetFont('Arial','b',12);
	$pdf->Cell(140,3,$nomcia_z,0,0,'C');
	$pdf->SetFont('Arial','b',7);
	$pdf->Cell(20,3,"Pagina:". $pdf->PageNo(),0,'L');
	$pdf->Ln();
	$pdf->SetFont('Arial','b',12);
	$pdf->Cell(0,3,$dircia_z,0,1,'C');
	$pdf->Ln();
	$pdf->Cell(0,3,'Poliza de Servicios '."Fecha: ".$fecha_z." " . "Almacen:" . $alm_z,0,1,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','b',9);
	$pdf->SetFillColor(255,0,0);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(128,0,0);
	$pdf->SetLineWidth(.3);
	$pdf->SetFont('','B');
	$pdf->Cell(10,7,'Vehiculo',1,0,'C',1);
	$pdf->Cell(35,7,'Descripcion',1,0,'C',1);
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
	$pdf->SetWidths(array(10,35,12,35,18,30,18,35));
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
			$mipolser_z->codvehi,
			$descrivehi_z,
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
		"",
		"Totales",
		"",
		"",
		"",
		"",
		number_format( $total_z,   2 ),
		""
	));

	$pdf->Output();
	ob_end_flush(); 
}

?>

</body>
</html>
