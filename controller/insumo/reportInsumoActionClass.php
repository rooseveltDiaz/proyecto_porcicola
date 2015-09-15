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
 * Description of reportInsumoActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportInsumoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

    $where = null;

            if (request::getInstance()->hasRequest('filter')) {

                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
                    $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::NOMBRE] = $filter['nombre'];
                }//close if

                if (isset($filter['fabricacionInicial']) and $filter['fabricacionInicial'] !== null and $filter['fabricacionInicial'] !== '') {
                    $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::FECHA_FABRICACION] = $filter['fabricacionInicial'];
                }//close if
                if (isset($filter['VencimientoInicial']) and $filter['VencimientoInicial'] !== null and $filter['VencimientoInicial'] !== '') {
                    $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::FECHA_VENCIMIENTO] = $filter['VencimientoInicial'];
                }//close if
                if (isset($filter['tipoInsumo']) and $filter['tipoInsumo'] !== null and $filter['tipoInsumo'] !== '') {
                    $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::TIPO_INSUMO] = $filter['tipoInsumo'];
                }//close if
                if (isset($filter['valor']) and $filter['valor'] !== null and $filter['valor'] !== '') {
                    $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::VALOR] = $filter['valor'];
                }//close if
                if (isset($filter['cantidad']) and $filter['cantidad'] !== null and $filter['cantidad'] !== '') {
                    $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::CANTIDAD] = $filter['cantidad'];
                }//close if
                if (isset($filter['stock']) and $filter['stock'] !== null and $filter['stock'] !== '') {
                    $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::STOCK_MINIMO] = $filter['stock'];
                }//close if
            }
            $fields = array(
                insumoTableClass::ID,
                insumoTableClass::TIPO_INSUMO,
                insumoTableClass::NOMBRE,
                insumoTableClass::FECHA_FABRICACION,
                insumoTableClass::FECHA_VENCIMIENTO,
                insumoTableClass::VALOR,
                insumoTableClass::CANTIDAD,
                insumoTableClass::STOCK_MINIMO
            );

            $fields2 = array(
                tipoInsumoTableClass::DESCRIPCION
            );

            $fJoin1 = insumoTableClass::TIPO_INSUMO;
            $fJoin2 = tipoInsumoTableClass::ID;

            $orderBy = array(
                insumoTableClass::ID
            );

            $this->objInsumo = insumoTableClass::getAllJoin($fields, $fields2, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Informe de Insumos en Nuestro Sistema';
            log::register(i18n::__('reporte'), insumoTableClass::getNameTable());
            $this->defineView('index', 'insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
