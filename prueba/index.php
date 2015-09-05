<?php
# PHPlot Example: Simple line graph
require_once 'phplot-6.1.0/phplot.php';

session_start();
$obj = $_GET['cadena'];
//$tmp = urlencode($obj); 

    $tmp = stripslashes($obj); 
    $tmp = urldecode($tmp); 
    $tmp = unserialize($tmp); 

//print_r($tmp);
//    $dataa = array();
//foreach ($tmp as $key){
//    $a =  array(
//        
//        array(
//           $key->factura_venta => $key->factura_venta
//        )   
//        
//    );
//    
//    echo  $key->factura_venta;
//    $dataa .= array($date. " ". array($key->factura_venta) . "," . " ");
//    $dataa = $dataa . ",". array( $key->factura_venta);
//}
//$data = array(
//  array('', 1800,   5),
//  array('', 1800,   5), array('', 1810,   7), array('', 1820,  10),
//  array('', 1830,  13), array('', 1840,  17), array('', 1850,  23),
//  array('', 1860,  31), array('', 1870,  39), array('', 1880,  50),
//  array('', 1890,  63), array('', 1900,  76), array('', 1910,  92),
//  array('', 1920, 106), array('', 1930, 123), array('', 1940, 132),
//  array('', 1950, 151), array('', 1960, 179), array('', 1970, 203),
//  array('', 1980, 227), array('', 1990, 249), array('', 2000, 281),
//);
//
//print_r($data);
foreach ($tmp as $key){
$data = array(
    
  array('', $key->factura_venta,   $key->factura_venta++) . "," 
//  array('', 1800,   5), array('', 1810,   7), array('', 1820,  10),
//  array('', 1830,  13), array('', 1840,  17), array('', 1850,  23),
//  array('', 1860,  31), array('', 1870,  39), array('', 1880,  50),
//  array('', 1890,  63), array('', 1900,  76), array('', 1910,  92),
//  array('', 1920, 106), array('', 1930, 123), array('', 1940, 132),
//  array('', 1950, 151), array('', 1960, 179), array('', 1970, 203),
//  array('', 1980, 227), array('', 1990, 249), array('', 2000, 281),
);
}
print_r($data);

//$plot = new PHPlot(800, 600);
//$plot->SetImageBorderType('plain');
//
//$plot->SetPlotType('lines');
//$plot->SetDataType('data-data');
//$plot->SetDataValues($data);
//
//# Main plot title:
//$plot->SetTitle('US Population, in millions');
//
//# Make sure Y axis starts at 0:
//$plot->SetPlotAreaWorld(NULL, 0, NULL, NULL);
//
//$plot->DrawGraph();

