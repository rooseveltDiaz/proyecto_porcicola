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
 * Description of reportDetalleEntradaBodegaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportDetalleFacturaCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            $idVacunacion = request::getInstance()->getRequest(procesoCompraTableClass::ID);
            if (request::getInstance()->hasRequest('report')) {
                $report = request::getInstance()->getPost('report');

//                if (isset($report['fecha']) and $report['fecha'] !== null and $report['fecha'] !== '') {
//                    $where[detalleVacunacionTableClass::FECHA] = $report['fecha'];
//                }//close if

                if (isset($report['tipo']) and $report['tipo'] !== null and $report['tipo'] !== '') {
                    $where[detalleProcesoCompraTableClass::TIPO_INSUMO] = $report['tipo'];
                }//close if


                if (isset($report['insumo']) and $report['insumo'] !== null and $report['insumo'] !== '') {
                    $where[detalleProcesoCompraTableClass::INSUMO_ID] = $report['insumo'];
                }//close if

                if (isset($report['cantidad']) and $report['cantidad'] !== null and $report['cantidad'] !== '') {
                    $where[detalleProcesoCompraTableClass::CANTIDAD] = $report['cantidad'];
                }//close if
                if (isset($report['valor']) and $report['valor'] !== null and $report['valor'] !== '') {
                    $where[detalleProcesoCompraTableClass::VALOR_UNITARIO] = $report['valor'];
                }//close if
            }//close if

            $where[detalleProcesoCompraTableClass::PROCESO_COMPRA_ID] = $idVacunacion;

            $fieldsDetalleProcesoCompra = array(
            detalleProcesoCompraTableClass::ID,
            detalleProcesoCompraTableClass::PROCESO_COMPRA_ID,
            detalleProcesoCompraTableClass::TIPO_INSUMO,
            detalleProcesoCompraTableClass::INSUMO_ID,
            detalleProcesoCompraTableClass::CANTIDAD,
            detalleProcesoCompraTableClass::VALOR_UNITARIO
          
            );

            $fieldsInsumo = array(
            insumoTableClass::NOMBRE
            );

            $fJoin1 = detalleProcesoCompraTableClass::INSUMO_ID;
            $fJoin2 = insumoTableClass::ID;

            $fieldsProcesoCompra = array(
            procesoCompraTableClass::ID,
            procesoCompraTableClass::NUMERO,
            procesoCompraTableClass::FECHA_HORA_COMPRA
            );

            $fieldsEmpleado = array(
            empleadoTableClass::NOMBRE
            );

            $fieldsTipo = array(
            tipoInsumoTableClass::DESCRIPCION
            );
            $fieldsProveedor = array (
            proveedorTableClass::NOMBRE
            );

            $fJoinVacunacion1 = procesoCompraTableClass::EMPLEADO_ID;
            $fJoinVacunacion2 = empleadoTableClass::ID;
            $fJoinVacunacion3 = detalleProcesoCompraTableClass::TIPO_INSUMO;
            $fJoinVacunacion4 = tipoInsumoTableClass::ID;
            $fJoin3 = procesoCompraTableClass::PROVEEDOR_ID;
            $fJoin4 = proveedorTableClass::ID;

            $whereVacunacion = array(
                procesoCompraTableClass::getNameTable() . "." . procesoCompraTableClass::ID => $idVacunacion
            );

            $this->objDetalleProcesoCompra = detalleProcesoCompraTableClass::getAllJoin($fieldsDetalleProcesoCompra, $fieldsInsumo, $fieldsTipo, null, $fJoin1, $fJoin2, $fJoinVacunacion3, $fJoinVacunacion4, null, null, false, null, null, null, null, $where);
            $this->objProcesoCompra = procesoCompraTableClass::getAllJoin($fieldsProcesoCompra, $fieldsEmpleado, $fieldsProveedor, null, $fJoinVacunacion1, $fJoinVacunacion2, $fJoin3, $fJoin4, null, null, true, null, null, null, null, $whereVacunacion);
            $this->mensajeDetalle = "Informe de Detalles de Factura de Compra";
            log::register(i18n::__('reporte'), detalleProcesoCompraTableClass::getNameTable());
            $this->defineView('reportDetalle', 'facturaCompra', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
