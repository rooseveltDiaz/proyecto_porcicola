<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of indexVacunaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexVacunaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $where = null;

            if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');



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
                session::getInstance()->setAttribute('vacunaFilters', $where);
            } elseif (session::getInstance()->hasAttribute('vacunaFilters')) {
                $where = session::getInstance()->getAttribute('vacunaFilters');
            }//close if

            $fields = array(
                vacunaTableClass::FECHA_VENCIMIENTO,
                vacunaTableClass::FECHA_FABRICACION,
                vacunaTableClass::ID,
                vacunaTableClass::LOTE_VACUNA,
                vacunaTableClass::NOMBRE_VACUNA,
                vacunaTableClass::VALOR,
                vacunaTableClass::CANTIDAD,
                vacunaTableClass::STOCK_MINIMO
            );

            $orderBy = array(
                vacunaTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if

            $f = array(
                vacunaTableClass::ID
            );
            $lines = config::getRowGrid();
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }//close if

            $objVacuna = vacunaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            foreach ($objVacuna as $key) {
                if ($key->cantidad < $key->stock_minimo and $key->cantidad >= 1) {
                    session::getInstance()->setWarning("La vacuna " . $key->nombre_vacuna . " " .
                            "esta a punto de agotarse " . "le quedan " . $key->cantidad .
                            " " . "y " . "su cantidad minima es de " . $key->stock_minimo);
                }elseif( $key->cantidad < $key->stock_minimo) {
                    session::getInstance()->setWarning("La vacuna " . $key->nombre_vacuna . " " .
                            "se ha agotado" );
                }
            }

            $this->cntPages = vacunaTableClass::getAllCount($f, false, $lines);
            $this->objVacuna = vacunaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            log::register(i18n::__('ver', null, 'vacunacion'), vacunaTableClass::getNameTable());
            $this->defineView('index', 'vacuna', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
