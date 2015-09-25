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
            $filter = request::getInstance()->getPost('filter');
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
            $objReportGenerales = viewReporteVentaBaseTableClass::getAll($fields, false);
            $fechaAuto = 0;
            $fechaAuto2 = 0;
            foreach ($objReportGenerales as $key){
                $this->fechaAuto[$fechaAuto2++] = array($key->fecha);
            }
            $fecha_inicio = $filter['fecha_inicio'];
            $fecha_fin = $filter['fecha_fin'];
            $sql = 'SELECT COUNT(proceso_venta.animal_id) AS total_animal,proceso_venta.fecha_venta_hora FROM ANIMAL,PROCESO_VENTA WHERE PROCESO_VENTA.ANIMAL_ID=ANIMAL.ID AND PROCESO_VENTA.ID_VENTA=PROCESO_VENTA.ID';
            $sql2 = 'SELECT count(proceso_venta.animal_id) AS total_animal,proceso_venta.fecha_hora_venta FROM DETALLE_PROCESO_VENTA,ANIMAL,PROCESO_VENTA WHERE DETALLE_PROCESO_VENTA.ANIMAL_ID=ANIMAL.ID AND PROCESO_VENTA.ID=PROCESO_VENTA.ID GROUP BY proceso_venta.fecha_hora_venta';
            $sql3 = 'SELECT COUNT(proceso_venta.animal_id) AS total_animal, proceso_venta.fecha_hora_venta FROM ANIMAL,PROCESO_VENTA WHERE proceso_venta.fecha_hora_venta BETWEEN '."'$fecha_inicio'". ' AND '."'$fecha_fin'".' AND PROCESO_VENTA.ANIMAL_ID=ANIMAL.ID GROUP BY proceso_venta.fecha_hora_venta';
            $objReporte = mvc\model\modelClass::getInstance()->query($sql3)->fetchAll(\PDO::FETCH_OBJ);
            $x = 0;
            foreach ($objReporte as $reporte) {
                $grafica[] = array(
                    $reporte->total_animal,
                    $reporte->fecha_hora_venta
                );
                //$ticks [] = array($x,$reporte->fecha_hora_venta);
                //$x++;
            }
            $this->fecha_inicio = $fecha_inicio;
            $this->fecha_fin = $fecha_fin;
            $this->objReporte = $objReporte;
            $this->grafica = $grafica;
            $this->ticks = $ticks;
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