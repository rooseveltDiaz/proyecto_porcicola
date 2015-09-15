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
 * Description of reportSalidaBodegaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

        $where = null;
            if (request::getInstance()->hasRequest('filter')) {
                $report = request::getInstance()->getPost('filter');
    
                if (isset($report['fecha_inicio']) and $report['fecha_inicio'] !== null and $report['fecha_inicio'] !== '' and isset($report['fecha_fin']) and $report['fecha_fin'] !== null and $report['fecha_fin'] !== '') {
                    $where[salidaBodegaTableClass::getNameTable() . '.' . salidaBodegaTableClass::FECHA] = array(
                        date(config::getFormatTimestamp(), strtotime($report['fecha_inicio'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($report['fecha_fin'] . ' 23.59.59'))
                    );
                }//close if

                 if (isset($report['empleado']) and $report['empleado'] !== null and $report['empleado'] !== '')  {
                    $where [salidaBodegaTableClass::getNameTable() . '.' . salidaBodegaTableClass::EMPLEADO] = $report['empleado'];
                }
               } 
            $fields = array(
                salidaBodegaTableClass::ID,
                salidaBodegaTableClass::FECHA,
                salidaBodegaTableClass::EMPLEADO
            );
            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );


            $fJoin1 = salidaBodegaTableClass::EMPLEADO;
            $fJoin2 = empleadoTableClass::ID;

            $orderBy = array(
                salidaBodegaTableClass::ID
            );
            $this->mensaje = "Informe de Salidas de Bodega";
            $this->objSalida = salidaBodegaTableClass::getAllJoin($fields, $fieldsEmpleado, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC', null, null, $where);
            log::register(i18n::__('reporte'), salidaBodegaTableClass::getNameTable());
            $this->defineView('index', 'salidaBodega', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
