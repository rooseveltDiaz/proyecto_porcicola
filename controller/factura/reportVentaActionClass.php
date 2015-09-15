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
 * Description of reportVentaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
$where = null;
            if (request::getInstance()->hasRequest('filter')) {
                $report = request::getInstance()->getPost('filter');
    
                if (isset($report['fecha_inicio']) and $report['fecha_inicio'] !== null and $report['fecha_inicio'] !== '' and isset($report['fecha_fin']) and $report['fecha_fin'] !== null and $report['fecha_fin'] !== '') {
                    $where[procesoVentaTableClass::getNameTable() . '.' . procesoVentaTableClass::FECHA_HORA_COMPRA] = array(
                        date(config::getFormatTimestamp(), strtotime($report['fecha_inicio'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($report['fecha_fin'] . ' 23.59.59'))
                    );
                }//close if

                 if (isset($report['empleado']) and $report['empleado'] !== null and $report['empleado'] !== '')  {
                    $where [procesoVentaTableClass::getNameTable() . '.' . procesoVentaTableClass::EMPLEADO_ID] = $report['empleado'];
                }

                if (isset($report['proveedor']) and $report['proveedor'] !== null and $report['proveedor'] !== '') {
                    $where [procesoVentaTableClass::getNameTable() . '.' . procesoVentaTableClass::PROVEEDOR_ID] = $report['proveedor'];
                }

             } 

            $fieldsFacturaVenta = array(
                procesoVentaTableClass::ID,
                procesoVentaTableClass::FECHA_HORA_VENTA,
                procesoVentaTableClass::ACTIVA
            );
            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );
            $fieldsCliente = array(
                clienteTableClass::ID,
                clienteTableClass::NOMBRE
            );
            $fJoin1 = procesoVentaTableClass::EMPLEADO_ID;
            $fJoin2 = empleadoTableClass::ID;
            $fJoin3 = procesoVentaTableClass::CLIENTE_ID;
            $fJoin4 = clienteTableClass::ID;
            $orderBy = array(
                procesoVentaTableClass::FECHA_HORA_VENTA
            );
       

            $this->objFacturaVenta = procesoVentaTableClass::getAllJoin($fieldsFacturaVenta, $fieldsEmpleado, $fieldsCliente, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC', null, null, $where);
             $this->mensaje = "Inventario de Facturas de Venta";
            log::register(i18n::__('reporte'), procesoVentaTableClass::getNameTable());
            $this->defineView('report', 'facturaVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
