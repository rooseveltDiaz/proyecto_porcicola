<?php

use mvc\routing\routingClass as routing;
$num = procesoCompraTableClass::NUMERO;
$fecha = procesoCompraTableClass::FECHA_HORA_COMPRA;
$empleado = empleadoTableClass::NOMBRE;
$proveedor =  proveedorTableClass::NOMBRE;
$nombreInsumo = insumoTableClass::NOMBRE;
$id = detalleProcesoCompraTableClass::ID;
$tipo = tipoInsumoTableClass::DESCRIPCION;
$cantidad = detalleProcesoCompraTableClass::CANTIDAD;
$valor = detalleProcesoCompraTableClass::VALOR_UNITARIO;
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
$pdf->Cell(50);
$pdf->Cell(20, 10, utf8_decode('N.'), 1, 0, 'C');
$pdf->Cell(60, 10, utf8_decode('Fecha'), 1, 0, 'C');

$pdf->Cell(50, 10, utf8_decode('Empleado'), 1, 0, 'C');
$pdf->Cell(50, 10, utf8_decode('Proveedor'), 1, 0, 'C');
$pdf->Ln();
foreach ($objProcesoCompra as $key) {
    $pdf->Cell(50);
    $pdf->Cell(20, 10, utf8_decode($key->$num), 1, 0, 'C');
    $pdf->Cell(60, 10, date("Y-M-d h:s", strtotime($key->$fecha)), 1, 0, 'C');
    $pdf->Cell(50, 10, utf8_decode($key->$empleado), 1, 0, 'C');
    $pdf->Cell(50, 10, utf8_decode($key->$proveedor), 1, 0, 'C');
  
    $pdf->Ln();
}//close foreach
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(50);
$pdf->Cell(20, 10, utf8_decode('Item'), 1, 0, 'C');
$pdf->Cell(55, 10, utf8_decode('Tipo Insumo'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode('Insumo'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode('Cantidad'), 1, 0, 'C');
$pdf->Cell(40, 10, utf8_decode('Valor Unitario'), 1, 0, 'C');
//$pdf->Cell(30, 10, utf8_encode('Accion'), 1, 0, 'C');
$pdf->Ln();
foreach ($objDetalleProcesoCompra as $key) {
    $pdf->Cell(50);
    $pdf->Cell(20, 10, utf8_decode($key->$id), 1, 0, 'C');
    $pdf->Cell(55, 10, utf8_decode($key->$tipo), 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($key->$nombreInsumo), 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($key->$cantidad), 1, 0, 'C');
    $pdf->Cell(40, 10, utf8_decode($key->$valor), 1, 0, 'C');    
//    $pdf->Cell(30, 10, utf8_encode($key->id), 1,0,'C');
    $pdf->Ln();
}//close foreach
$pdf->Output();


