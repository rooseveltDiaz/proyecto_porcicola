<?php use mvc\routing\routingClass as routing;


$fecha = procesoCompraTableClass::FECHA_HORA_COMPRA;
$empleado = empleadoTableClass::NOMBRE;
$id = procesoCompraTableClass::NUMERO;
$proveedor = proveedorTableClass::NOMBRE;

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
$pdf->Cell(25, 10, utf8_encode('N.'), 1, 0, 'C');
$pdf->Cell(48, 10, utf8_encode('Fecha'), 1, 0, 'C');
$pdf->Cell(65, 10, utf8_encode('Empleado'), 1, 0, 'C');
$pdf->Cell(65, 10, utf8_encode('Proveedor'), 1, 0, 'C');
$pdf->Ln();
foreach ($objFacturaCompra as $key){
    $pdf->Cell(1);
    $pdf->Cell(25, 10, utf8_encode($key->$id), 1);
    $pdf->Cell(48, 10, date("Y-M-d G:i", strtotime($key->$fecha)), 1, 0, 'C');
    $pdf->Cell(65, 10, utf8_encode($key->$empleado), 1);
    $pdf->Cell(65, 10, utf8_encode($key->$proveedor), 1);
  $pdf->Ln();  
}//close foreach
$pdf->Output();
