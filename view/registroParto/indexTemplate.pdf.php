<?php

use mvc\routing\routingClass as routing;

class PDF extends FPDF {

// Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

// Creación del objeto de la clase heredada
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
//     Salto de línea
$pdf->Ln(80);
//fondo
$pdf->Image(routing::getInstance()->getUrlImg('reporte_horizontal.jpg'), 0, 0, 318, 300);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 25);
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(40, 10, $mensaje, 0, 0, 'C');

// Salto de línea
$pdf->Ln(20);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20);
//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);//usuarios usuarios usuaruis
$pdf->Cell(25, 10, utf8_decode('N. Documento'), 1);
$pdf->Cell(25, 10, utf8_decode('Hembra'), 1);
$pdf->Cell(35, 10, utf8_decode('Fecha Registro'), 1);
$pdf->Cell(30, 10, utf8_decode('Hembras Vivas'), 1);
$pdf->Cell(30, 10, utf8_decode('Machos Vivos'), 1);
$pdf->Cell(30, 10, utf8_decode('Nacidos Muertos'), 1);

//$pdf->Cell(20, 10, utf8_decode('Raza'), 1);

$pdf->Ln();
foreach ($objParto as $key) {
    $pdf->Cell(20);
    $pdf->Cell(25, 10, utf8_decode($key->id), 1);
    $pdf->Cell(25, 10, utf8_decode($key->numero_identificacion), 1);
    $pdf->Cell(35, 10, utf8_decode($key->fecha_parto), 1);
    $pdf->Cell(30, 10, utf8_decode($key->hembras_nacidas_vivas), 1);
    $pdf->Cell(30, 10, utf8_decode($key->machos_nacidos_vivos), 1);
    $pdf->Cell(30, 10, utf8_decode($key->nacidos_muertos), 1);

//    $pdf->Cell(20, 10, utf8_decode($key->nombre_raza), 1);
    
    $pdf->Ln();
}

$pdf->Output();