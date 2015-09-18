<?php use mvc\routing\routingClass as routing;

$empleado = empleadoTableClass::NOMBRE;
$fecha = registroPesoTableClass::FECHA;
$numero = animalTableClass::NUMERO;
$peso = registroPesoTableClass::PESO;
$kilo = registroPesoTableClass::KILO;
$total = registroPesoTableClass::VALOR;

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
$pdf = new PDF('L', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
//     Salto de línea
$pdf->Ln(40);
//fondo
$pdf->Image(routing::getInstance()->getUrlImg('reporte_horizontal.jpg'), 0, 0, 218, 300);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 25);
// Movernos a la derecha
$pdf->Cell(90);
// Título
$pdf->Cell(70, 10, $mensaje, 0, 0, 'C');
// Salto de línea
$pdf->Ln(20);

$pdf->SetFont('Arial', '', 12);
//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
$pdf->Cell(1);
$pdf->Cell(35, 10, utf8_decode('Fecha'), 1, 0, 'C');
$pdf->Cell(108, 10, utf8_decode('Empleado'), 1, 0 ,'C');
$pdf->Cell(33, 10, utf8_decode('Animal'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode('Peso (Kg)'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode('Valor por Kg.'), 1, 0 ,'C');
$pdf->Cell(30, 10, utf8_decode('Valor Total'), 1, 0, 'C');

$pdf->Ln();
foreach ($objRegistroPeso as $key) {
    $pdf->Cell(1);
    $pdf->Cell(35, 10, date("Y-M-d G:i", strtotime($key->$fecha)), 1, 0 , 'C');
    $pdf->Cell(108, 10, utf8_decode($key->$empleado), 1);
   $pdf->Cell(33, 10, utf8_decode($key->$numero), 1);
    $pdf->Cell(30, 10, utf8_decode($key->$peso), 1);
    $pdf->Cell(30, 10, utf8_decode($key->$kilo), 1);
    $pdf->Cell(30, 10, utf8_decode($key->$total), 1);
    $pdf->Ln();
}
$pdf->Output();
