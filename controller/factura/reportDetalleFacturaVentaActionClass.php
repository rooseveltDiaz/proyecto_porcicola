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
 * Description of reportDetalleFacturaVentaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportDetalleFacturaVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            $idVacunacion = request::getInstance()->getRequest(procesoVentaTableClass::ID);
            if (request::getInstance()->hasRequest('report')) {
                $report = request::getInstance()->getPost('report');

//                if (isset($report['fecha']) and $report['fecha'] !== null and $report['fecha'] !== '') {
//                    $where[detalleVacunacionTableClass::FECHA] = $report['fecha'];
//                }//close if

//                if (isset($report['tipo']) and $report['tipo'] !== null and $report['tipo'] !== '') {
//                    $where[detalleProcesoCompraTableClass::TIPO_INSUMO] = $report['tipo'];
//                }//close if


                if (isset($report['numero']) and $report['numero'] !== null and $report['numero'] !== '') {
                    $where[detalleProcesoVentaTableClass::ID] = $report['numero'];
                }//close if

                if (isset($report['animal']) and $report['animal'] !== null and $report['animal'] !== '') {
                    $where[detalleProcesoVentaTableClass::ANIMAL] = $report['animal'];
                }//close if
                if (isset($report['valor']) and $report['valor'] !== null and $report['valor'] !== '') {
                    $where[detalleProcesoVentaTableClass::VALOR] = $report['valor'];
                }//close if
            }//close if

            $where[detalleProcesoVentaTableClass::VENTA] = $idVacunacion;

            $fieldsDetalleProcesoVenta = array(
            detalleProcesoVentaTableClass::ID,
            detalleProcesoVentaTableClass::VENTA,
            detalleProcesoVentaTableClass::VALOR,
            detalleProcesoVentaTableClass::ANIMAL
          
            );

            $fieldsAnimal = array(
            animalTableClass::NUMERO
            );

            $fJoin1 = detalleProcesoVentaTableClass::ANIMAL;
            $fJoin2 = animalTableClass::ID;

            $fieldsProcesoVenta = array(
            procesoVentaTableClass::ID,
            procesoVentaTableClass::FECHA_HORA_VENTA
          
            );

            $fieldsEmpleado = array(
            empleadoTableClass::NOMBRE
            );

   
            $fieldsCliente = array (
            clienteTableClass::NOMBRE
            );

            $fJoinVacunacion1 = procesoVentaTableClass::EMPLEADO_ID;
            $fJoinVacunacion2 = empleadoTableClass::ID;
   
            $fJoin3 = procesoVentaTableClass::CLIENTE_ID;
            $fJoin4 = clienteTableClass::ID;

            $whereVacunacion = array(
                procesoVentaTableClass::getNameTable() . "." . procesoVentaTableClass::ID => $idVacunacion
            );

            $this->objDetalleProcesoVenta = detalleProcesoVentaTableClass::getAllJoin($fieldsDetalleProcesoVenta, $fieldsAnimal, null, null, $fJoin1, $fJoin2, null, null, null, null, false, null, null, null, null, $where);
            $this->objProcesoVenta = procesoVentaTableClass::getAllJoin($fieldsProcesoVenta, $fieldsEmpleado, $fieldsCliente, null, $fJoinVacunacion1, $fJoinVacunacion2, $fJoin3, $fJoin4, null, null, true, null, null, null, null, $whereVacunacion);
            $this->mensajeDetalle = "Informe de Detalles de Factura de Venta";
            log::register(i18n::__('reporte'), detalleProcesoVentaTableClass::getNameTable());
            $this->defineView('reportDetalle', 'facturaVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
