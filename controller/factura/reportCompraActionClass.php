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
 * Description of reportCompraActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (request::getInstance()->hasRequest('filter')) {
                $report = request::getInstance()->getPost('filter');
    
                if (isset($report['fecha_inicio']) and $report['fecha_inicio'] !== null and $report['fecha_inicio'] !== '' and isset($report['fecha_fin']) and $report['fecha_fin'] !== null and $report['fecha_fin'] !== '') {
                    $where[procesoCompraTableClass::getNameTable() . '.' . procesoCompraTableClass::FECHA_HORA_COMPRA] = array(
                        date(config::getFormatTimestamp(), strtotime($report['fecha_inicio'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($report['fecha_fin'] . ' 23.59.59'))
                    );
                }//close if

                 if (isset($report['empleado']) and $report['empleado'] !== null and $report['empleado'] !== '')  {
                    $where [procesoCompraTableClass::getNameTable() . '.' . procesoCompraTableClass::EMPLEADO_ID] = $report['empleado'];
                }

                if (isset($report['proveedor']) and $report['proveedor'] !== null and $report['proveedor'] !== '') {
                    $where [procesoCompraTableClass::getNameTable() . '.' . procesoCompraTableClass::PROVEEDOR_ID] = $report['proveedor'];
                }

             } 
            $fieldsFacturaCompra = array(
                procesoCompraTableClass::ID,
                procesoCompraTableClass::NUMERO,
                procesoCompraTableClass::FECHA_HORA_COMPRA,
               
            );
            $fieldsEmpleado = array(
            empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );
            $fieldsProveedor = array(
            proveedorTableClass::ID,
                proveedorTableClass::NOMBRE
            );
            $fJoin1 = procesoCompraTableClass::EMPLEADO_ID;
            $fJoin2 = empleadoTableClass::ID;
            $fJoin3 = procesoCompraTableClass::PROVEEDOR_ID;
            $fJoin4 = proveedorTableClass::ID;
       
      
            $this->objFacturaCompra = procesoCompraTableClass::getAllJoin($fieldsFacturaCompra, $fieldsEmpleado, $fieldsProveedor, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, null, null, null, null, $where);
            $this->mensaje = "Informe de Facturas de Compra";
            log::register(i18n::__('reporte'), procesoCompraTableClass::getNameTable());
            $this->defineView('report', 'facturaCompra', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
