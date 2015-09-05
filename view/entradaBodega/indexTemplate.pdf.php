<?php
use mvc\routing\routingClass as routing;

$doc= entradaBodegaTableClass::ID;
$fecha = entradaBodegaTableClass::FECHA;
$empleado = empleadoTableClass::NOMBRE;

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
$pdf->Image(routing::getInstance()->getUrlImg('reporte_Vertical.jpg'), 0, 0, 218, 300);
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
$pdf->Cell(30);
$pdf->Cell(30, 10, utf8_decode('N.'), 1, 0, 'C');
$pdf->Cell(43, 10, utf8_decode('Fecha del Registro'), 1, 0 ,'C');
$pdf->Cell(110, 10, utf8_decode('Empleado'), 1, 0, 'C');

$pdf->Ln();
foreach ($objEntrada as $key) {
    $pdf->Cell(30);
    $pdf->Cell(30, 10, utf8_decode($key->$doc), 1);
    $pdf->Cell(43, 10, date("Y-M-d G:i", strtotime($key->$fecha)), 1, 0 , 'C');
    $pdf->Cell(110, 10, utf8_decode($key->$empleado), 1);

    $pdf->Ln();
}
$pdf->Output();
