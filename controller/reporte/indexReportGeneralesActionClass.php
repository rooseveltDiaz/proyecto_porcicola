<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
/**
 * Description of indexReportGeneralesActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexReportGeneralesActionClass extends controllerClass implements controllerActionInterface {
    public function execute() {
        try {
            session_start(); 
//            $where = NULL;
            $fields = array(
                viewReporteVentaBaseTableClass::ANIMAL,
                viewReporteVentaBaseTableClass::DETALLE_VENTA,
                viewReporteVentaBaseTableClass::FACTURA_VENTA,
                viewReporteVentaBaseTableClass::FECHA,
                viewReporteVentaBaseTableClass::GENERO,
                viewReporteVentaBaseTableClass::IDENTIFICACION,
                viewReporteVentaBaseTableClass::VALOR
            );
            $objReportGenerales = viewReporteVentaBaseTableClass::getAll($fields, true);
            $fechaAuto = 0;
            $fechaAuto2 = 0;
            foreach ($objReportGenerales as $key){
                $this->fechaAuto[$fechaAuto2++] = array($key->fecha);
            }
            
            
//session::getInstance()->setAttribute("Variable", "ola");
//$_GET["prueba"] = "ola";
//$_GET['array'] = $objReportGenerales;
//$array = serialize($objReportGenerales); 
//    $tmp = serialize($array); 
//    $tmp = urlencode($array); 
//$_SESSION["Variable"] = 1; 
            $this->defineView('indexReportGeneralesVenta', 'reporte', session::getInstance()->getFormatOutput());
// header('Location:http://localhost/proyecto_porcicola/prueba/index.php?cadena='.$tmp);
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }
}