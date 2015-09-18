<?php use mvc\routing\routingClass as routing;


$fecha =  carneVacunasTableClass::FECHA_VACUNACION;
$veterinario = veterinarioTableClass::NOMBRE;
$vacuna = vacunaTableClass::NOMBRE_VACUNA;
$dosis = carneVacunasTableClass::DOSIS;
$accion = carneVacunasTableClass::ACCION;
$numero = animalTableClass::NUMERO;

class PDf extends FPDF {

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

$pdf = new PDF('L', 'mm', 'letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$image = $pdf->Image(routing::getInstance()->getUrlImg('reporte_horizontal.jpg'), 0, 0, 280, 215);


$pdf->Ln(30);
$pdf->SetFont('Arial', 'B', 25);
$pdf->Cell(70);
$pdf->Cell(130, 10, $mensaje, 0, 0, 'C');
$pdf->Ln(20);



$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(1);
$pdf->Cell(20, 10, utf8_decode('Animal'), 1, 0, 'C');
$pdf->Cell(45, 10, utf8_decode('Fecha'), 1, 0, 'C');
$pdf->Cell(60, 10, utf8_decode('Veterinario'), 1, 0, 'C');
$pdf->Cell(40, 10, utf8_decode('Vacuna'), 1, 0, 'C');
$pdf->Cell(20, 10, utf8_decode('Dosis'), 1, 0, 'C');
$pdf->Cell(83, 10, utf8_decode('Acción'), 1, 0, 'C');
$pdf->Ln();
foreach ($objCarne as $key) {
    $pdf->Cell(1);
    $pdf->Cell(20, 10, utf8_decode($key->$numero), 1, 0);
    $pdf->Cell(45, 10, date("Y-M-d G:i", strtotime($key->$fecha)), 1);
    $pdf->Cell(60, 10, utf8_decode($key->$veterinario), 1, 0);
    $pdf->Cell(40, 10, utf8_decode($key->$vacuna), 1, 0);
    $pdf->Cell(20, 10, utf8_decode($key->$dosis), 1, 0);
    $pdf->Cell(83, 10, utf8_decode($key->$accion), 1, 0);
    $pdf->Ln();
}//close foreach


$pdf->Output();
