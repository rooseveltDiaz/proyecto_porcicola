<?php

use mvc\routing\routingClass as routing;

$numero = animalTableClass::NUMERO;
$fecha = hojaVidaTableClass::FECHA_NACIMIENTO;
$peso = hojaVidaTableClass::PESO;
$genero = generoTableClass::NOMBRE;
$lote = animalTableClass::LOTE_ID;
$raza = razaTableClass::NOMBRE_RAZA;

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
$pdf->Image(routing::getInstance()->getUrlImg('reporte_horizontal.jpg'), 0, 0, 218, 300);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 25);
// Movernos a la derecha
$pdf->Cell(90);
// Título
$pdf->Cell(30, 10, $mensaje, 0, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 12);
//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
$pdf->Cell(5);
$pdf->Cell(32, 10, utf8_decode('N. Identificación'), 1);
$pdf->Cell(45, 10, utf8_decode('Fecha de nacimiento'), 1);
$pdf->Cell(22, 10, utf8_decode('Género'), 1);
//$pdf->Cell(30, 10, utf8_decode('N. Parto'), 1);
$pdf->Cell(38, 10, utf8_decode('Raza'), 1);
$pdf->Cell(20, 10, utf8_decode('Peso (Kg)'), 1);
$pdf->Cell(38, 10, utf8_decode('Lote'), 1);

$pdf->Ln();
foreach ($objHojaVida as $key) {
    $pdf->Cell(5);
    $pdf->Cell(32, 10, utf8_decode($key->$numero), 1);
    $pdf->Cell(45, 10, utf8_decode($key->$fecha), 1);
    $pdf->Cell(22, 10, utf8_decode($key->$genero), 1);
    $pdf->Cell(38, 10, utf8_decode($key->$raza), 1);
    $pdf->Cell(20, 10, utf8_decode($key->$peso), 1);

//    $pdf->Cell(30, 10, utf8_decode($key->numero_parto), 1);
    $pdf->Cell(38, 10, utf8_decode($key->$lote), 1);

//    $pdf->Cell(30, 10, utf8_decode($key->precio_animal), 1);
    $pdf->Ln();
}

$pdf->Output();
