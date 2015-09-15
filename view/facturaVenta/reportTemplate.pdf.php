<?php use mvc\routing\routingClass as routing;

//$id = procesoVentaTableClass::ID;
$fecha = procesoVentaTableClass::FECHA_HORA_VENTA;
$cliente = clienteTableClass::NOMBRE;
$empleado = empleadoTableClass::NOMBRE;
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
$pdf->Cell(1);
//$pdf->Cell(20, 10, utf8_decode('N.'), 1, 0, 'C');
$pdf->Cell(36, 10, utf8_decode('Fecha'), 1, 0, 'C');
$pdf->Cell(75, 10, utf8_decode('Empleado'), 1, 0, 'C');
$pdf->Cell(72, 10, utf8_decode('Cliente'), 1, 0, 'C');
$pdf->Ln();
foreach ($objFacturaVenta as $key){
    $pdf->Cell(1);
//    $pdf->Cell(20, 10, utf8_decode($key->$id), 1);
    $pdf->Cell(36, 10, date("Y-M-d", strtotime($key->$fecha)), 1, 0, 'C');
    $pdf->Cell(75, 10, utf8_decode($key->$empleado), 1);
    $pdf->Cell(72, 10, utf8_decode($key->$cliente), 1);
  $pdf->Ln();  
}//close foreach
$pdf->Output();
