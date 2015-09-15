<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of reportVacunaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportVacunaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
                        $where = null;
            if (request::getInstance()->hasRequest('filter')) {
                $report = request::getInstance()->getPost('filter');
    
                if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
                    $where[vacunaTableClass::NOMBRE_VACUNA] = $filter['nombre'];
                }//close if

                if (isset($filter['lote']) and $filter['lote'] !== null and $filter['lote'] !== '') {
                    $where[vacunaTableClass::LOTE_VACUNA] = $filter['lote'];
                }//close if

                if (isset($filter['fecha_f']) and $filter['fecha_f'] !== null and $filter['fecha_f'] !== '') {
                    $where[vacunaTableClass::FECHA_FABRICACION] = $filter['fecha_f'];
                }//close if

                if (isset($filter['fecha_v']) and $filter['fecha_v'] !== null and $filter['fecha_v'] !== '') {
                    $where[vacunaTableClass::FECHA_VENCIMIENTO] = $filter['fecha_v'];
                }//close if
                if (isset($filter['valor']) and $filter['valor'] !== null and $filter['valor'] !== '') {
                    $where[vacunaTableClass::VALOR] = $filter['valor'];
                }//close if
                if (isset($filter['cantidad']) and $filter['cantidad'] !== null and $filter['cantidad'] !== '') {
                    $where[vacunaTableClass::CANTIDAD] = $filter['cantidad'];
                }//close if
                if (isset($filter['stock']) and $filter['stock'] !== null and $filter['stock'] !== '') {
                    $where[vacunaTableClass::STOCK_MINIMO] = $filter['stock'];
                }//close if

             } 
            $fields = array(
                vacunaTableClass::ID,
                vacunaTableClass::NOMBRE_VACUNA,
                vacunaTableClass::LOTE_VACUNA,
                vacunaTableClass::FECHA_FABRICACION,
                vacunaTableClass::FECHA_VENCIMIENTO,
                vacunaTableClass::VALOR,
                vacunaTableClass::CANTIDAD,
                vacunaTableClass::STOCK_MINIMO
            );

            $orderBy = array(
                vacunaTableClass::ID
            );

            $this->objVacuna = vacunaTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Informe de Vacunas en Nuestro Sistema';
            log::register(i18n::__('reporte'), vacunaTableClass::getNameTable());
            $this->defineView('index', 'vacuna', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
