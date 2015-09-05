<?php use mvc\routing\routingClass as routing;
$fecha = vacunacionTableClass::FECHA;
$animal = animalTableClass::NUMERO;
$veterinario = veterinarioTableClass::NOMBRE;
class PDf extends FPDF{
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page '. $this->PageNo() . '/{nb}', 0,0,'C' );
    }
}

$pdf = new PDF('P', 'mm', 'letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image(routing::getInstance()->getUrlImg('reporte_Vertical.jpg'), 0, 0, 216, 280);
$pdf->Ln(40);
$pdf->SetFont('Arial', 'B', 25);
$pdf->Cell(93);
$pdf->Cell(30, 10, $mensaje, 0,0, 'C');

$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(10);
//$pdf->Cell(37, 10, utf8_decode('N. Documento'), 1, 0, 'C');
$pdf->Cell(40, 10, utf8_decode('Fecha'), 1, 0, 'C');
$pdf->Cell(38, 10, utf8_decode('Animal'), 1, 0, 'C');
$pdf->Cell(100, 10, utf8_decode('Veterinario'), 1, 0, 'C');
$pdf->Ln();
foreach ($objVacunacion as $key){
    $pdf->Cell(10);
//    $pdf->Cell(37, 10, utf8_decode($key->id), 1);
    $pdf->Cell(40, 10, date("Y-M-d", strtotime($key->$fecha)), 1, 0, 'C');
    $pdf->Cell(38, 10, utf8_decode($key->$animal), 1);
    $pdf->Cell(100, 10, utf8_decode($key->$veterinario), 1);
  $pdf->Ln();  
}//close foreach
$pdf->Output();
