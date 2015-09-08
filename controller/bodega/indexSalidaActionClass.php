<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of indexSalidaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexSalidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;

            if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');
                if (isset($filter['fecha_fin']) and $filter['fecha_fin'] !== null and $filter['fecha_fin'] !== '' and isset($filter['fecha_inicio']) and $filter ['fecha_inicio'] !== null and $filter['fecha_inicio'] !== '') {

                    $where [salidaBodegaTableClass::getNameTable() . '.' . salidaBodegaTableClass::FECHA] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_inicio'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_fin'] . ' 23.59.59'))
                    );
                }
                if (isset($filter['empleado']) and $filter['empleado'] !== null and $filter['empleado'] !== '') {
                    $where[salidaBodegaTableClass::EMPLEADO] = $filter['empleado'];
                }//close if
                session::getInstance()->setAttribute('salidaFilter', $where);
            } elseif (session::getInstance()->hasAttribute('salidaFilter')) {
                $where = session::getInstance()->getAttribute('salidaFilter');
            }//close if

            $fieldsSalida = array(
                salidaBodegaTableClass::EMPLEADO,
                salidaBodegaTableClass::ESTADO,
                salidaBodegaTableClass::FECHA,
                salidaBodegaTableClass::ID
            );
            $fieldsEmpleado = array(
                empleadoTableClass::NOMBRE,
            );
            $fieldsEmpleado2 = array(
                empleadoTableClass::NOMBRE,
                empleadoTableClass::ID
            );
            $fJoin1 = salidaBodegaTableClass::EMPLEADO;
            $fJoin2 = empleadoTableClass::ID;
            $orderBy = array(
                salidaBodegaTableClass::ID
            );
            $fieldsInsumo = array(
                insumoTableClass::ID,
                insumoTableClass::NOMBRE
            );
            $fieldsTipoInsumo = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION
            );
            $fieldsLote = array(
                loteTableClass::ID,
                loteTableClass::NOMBRE
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if

            $f = array(
                salidaBodegaTableClass::ID
            );
            $lines = config::getRowGrid();
            $this->cntPages = salidaBodegaTableClass::getAllCount($f, true, $lines, $where);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }//close if 
            $this->objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo, false);
            $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true);
            $this->objLote = loteTableClass::getAll($fieldsLote, true);
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado2, false);
            $this->objSalidaBodega = salidaBodegaTableClass::getAllJoin($fieldsSalida, $fieldsEmpleado, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            log::register(i18n::__('ver1', null, 'bodega'), salidaBodegaTableClass::getNameTable());
            $this->defineView('index', 'salidaBodega', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
