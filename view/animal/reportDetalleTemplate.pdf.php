<?php use mvc\routing\routingClass as routing;

$lote = loteTableClass::NOMBRE;
$num_animal = animalTableClass::NUMERO;

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
$pdf->Cell(130, 10, $mensajeDetalle, 0, 0, 'C');


$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(40);
$pdf->Cell(30, 10, utf8_decode('Animal'), 1, 0, 'C');
$pdf->Cell(120, 10, utf8_decode('Lote'), 1, 0, 'C');
$pdf->Ln();
foreach ($objAnimal as $key) {
    $pdf->Cell(40);
    $pdf->Cell(30, 10, utf8_decode($key->$num_animal), 1, 0);
    $pdf->Cell(120, 10, utf8_decode($key->$lote), 1, 0);
    $pdf->Ln();
}//close foreach

//$pdf->Link(10,8,10,10,"http://www.granjaporcicola.com/index.php/animal/index");

$pdf->Output();
