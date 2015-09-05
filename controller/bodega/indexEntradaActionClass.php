<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of indexEntradaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexEntradaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;

            if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['fecha_fin']) and $filter['fecha_fin'] !== null and $filter['fecha_fin'] !== '' and isset($filter['fecha_inicio']) and $filter ['fecha_inicio'] !== null and $filter['fecha_inicio'] !== '') {

                    $where [entradaBodegaTableClass::getNameTable() . '.' . entradaBodegaTableClass::FECHA] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_inicio'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_fin'] . ' 23.59.59'))
                    );
                }
//                if (isset($filter['fecha']) and $filter['fecha'] !== null and $filter['fecha'] !== '') {
//                    $where[entradaBodegaTableClass::FECHA] = $filter['fecha'];
//                }//close if
                if (isset($filter['empleado']) and $filter['empleado'] !== null and $filter['empleado'] !== '') {
                    $where[entradaBodegaTableClass::EMPLEADO] = $filter['empleado'];
                }//close if
                session::getInstance()->setAttribute('entradaFilter', $where);
            } elseif (session::getInstance()->hasAttribute('entradaFilter')) {
                $where = session::getInstance()->getAttribute('entradaFilter');
            }//close if

            $fieldsEntrada = array(
                entradaBodegaTableClass::ID,
                entradaBodegaTableClass::FECHA,
                entradaBodegaTableClass::EMPLEADO,
                entradaBodegaTableClass::ESTADO
            );
            $fieldsEmpleado = array(
                empleadoTableClass::NOMBRE,
            );
            $fieldsEmpleado2 = array(
                empleadoTableClass::NOMBRE,
                empleadoTableClass::ID
            );
            $fJoin1 = entradaBodegaTableClass::EMPLEADO;
            $fJoin2 = empleadoTableClass::ID;
            $orderBy = array(
                entradaBodegaTableClass::ID
            );
            $fieldsInsumo = array(
                insumoTableClass::ID,
                insumoTableClass::NOMBRE
            );
            $fieldsTipoInsumo = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if

            $f = array(
                entradaBodegaTableClass::ID
            );
            $lines = config::getRowGrid();
            $this->cntPages = entradaBodegaTableClass::getAllCount($f, true, $lines, $where);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }//close if 
            $this->objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo, false);
            $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true);
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado2, false);
            $this->objEntradaBodega = entradaBodegaTableClass::getAllJoin($fieldsEntrada, $fieldsEmpleado, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            log::register(i18n::__('ver', null, 'bodega'), entradaBodegaTableClass::getNameTable());
            $this->defineView('index', 'entradaBodega', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
