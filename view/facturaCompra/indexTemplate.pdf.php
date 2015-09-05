<?php use mvc\routing\routingClass as routing;
$id = procesoCompraTableClass::NUMERO;
$empleado = empleadoTableClass::NOMBRE;
$proveedor = proveedorTableClass::NOMBRE;
$fecha = procesoCompraTableClass::FECHA_HORA_COMPRA;
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
$pdf->Image(routing::getInstance()->getUrlImg('background.jpg'), 0, 0, 218, 300);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 25);
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(30, 10, $mensaje, 0, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 12);
//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
$pdf->Cell(20, 10, utf8_decode('N° Documento'), 1);
$pdf->Cell(20, 10, utf8_decode('Fecha'), 1);
$pdf->Cell(20, 10, utf8_decode('Empleado'), 1);
$pdf->Cell(42, 10, utf8_decode('Proveedor'), 1);
//$pdf->Cell(30, 10, utf8_decode('Genero'), 1);
//$pdf->Cell(30, 10, utf8_decode('Lote'), 1);
//$pdf->Cell(30, 10, utf8_decode('Raza'), 1);
$pdf->Ln();
foreach ($objFacturaCompra as $key) {

    $pdf->Cell(20, 10, utf8_decode($key->$id), 1);
    $pdf->Cell(20, 10, utf8_decode($key->$fecha), 1);
    $pdf->Cell(20, 10, utf8_decode($key->$empleado), 1);
    $pdf->Cell(42, 10, utf8_decode($key->$proveedor), 1);
//    $pdf->Cell(30, 10, utf8_decode($key->nombre_genero), 1);
//    $pdf->Cell(30, 10, utf8_decode($key->nombre_lote), 1);
//    $pdf->Cell(30, 10, utf8_decode($key->nombre_raza), 1);
    $pdf->Ln();
}//close foreach
$pdf->Output();
