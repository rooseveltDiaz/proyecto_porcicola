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
class reportDetalleEntradaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            $idVacunacion = request::getInstance()->getRequest(entradaBodegaTableClass::ID);
            if (request::getInstance()->hasRequest('report')) {
                $report = request::getInstance()->getPost('report');

//                if (isset($report['fecha']) and $report['fecha'] !== null and $report['fecha'] !== '') {
//                    $where[detalleVacunacionTableClass::FECHA] = $report['fecha'];
//                }//close if

                if (isset($report['tipoInsumo']) and $report['tipoInsumo'] !== null and $report['tipoInsumo'] !== '') {
                    $where[detalleEntradaBodegaTableClass::TIPO_INSUMO] = $report['tipoInsumo'];
                }//close if


                if (isset($report['Insumo']) and $report['Insumo'] !== null and $report['Insumo'] !== '') {
                    $where[detalleEntradaBodegaTableClass::ID_INSUMO] = $report['Insumo'];
                }//close if

                if (isset($report['cantidad']) and $report['cantidad'] !== null and $report['cantidad'] !== '') {
                    $where[detalleEntradaBodegaTableClass::CANDITDAD] = $report['cantidad'];
                }//close if
            }//close if

            $where[detalleEntradaBodegaTableClass::ID_ENTRADA] = $idVacunacion;

            $fieldsDetalleEntradaBodega = array(
            detalleEntradaBodegaTableClass::ID,
            detalleEntradaBodegaTableClass::ID_ENTRADA,
            detalleEntradaBodegaTableClass::TIPO_INSUMO,
            detalleEntradaBodegaTableClass::ID_INSUMO,
            detalleEntradaBodegaTableClass::CANDITDAD
          
            );

            $fieldsInsumo = array(
            insumoTableClass::NOMBRE
            );

            $fJoin1 = detalleEntradaBodegaTableClass::ID_INSUMO;
            $fJoin2 = insumoTableClass::ID;

            $fieldsEntrada = array(
            entradaBodegaTableClass::ID,
            entradaBodegaTableClass::FECHA
            );

            $fieldsEmpleado = array(
            empleadoTableClass::NOMBRE
            );

            $fieldsTipo = array(
            tipoInsumoTableClass::DESCRIPCION
            );
            $fieldsS = array(
            entradaBodegaTableClass::ID
            );

            $fJoinVacunacion1 = entradaBodegaTableClass::EMPLEADO;
            $fJoinVacunacion2 = empleadoTableClass::ID;
            $fJoinVacunacion3 = detalleEntradaBodegaTableClass::TIPO_INSUMO;
            $fJoinVacunacion4 = tipoInsumoTableClass::ID;
            $fJoinVacunacion5 = detalleEntradaBodegaTableClass::ID_ENTRADA;
            $fJoinVacunacion6 = entradaBodegaTableClass::ID;

            $whereVacunacion = array(
                entradaBodegaTableClass::getNameTable() . "." . entradaBodegaTableClass::ID => $idVacunacion
            );

            $this->objDetalleEntradaBodega = detalleEntradaBodegaTableClass::getAllJoin($fieldsDetalleEntradaBodega, $fieldsInsumo, $fieldsTipo, $fieldsS, $fJoin1, $fJoin2, $fJoinVacunacion3, $fJoinVacunacion4,  $fJoinVacunacion5, $fJoinVacunacion6, true, null, null, null, null, $where);
            $this->objEntradaBodega = entradaBodegaTableClass::getAllJoin($fieldsEntrada, $fieldsEmpleado, null, null, $fJoinVacunacion1, $fJoinVacunacion2, null, null, null, null, true, null, null, null, null, $whereVacunacion);
            $this->mensajeDetalle = "Informe de Detalles de Entrada de Bodega";
            log::register(i18n::__('reporte'), detalleEntradaBodegaTableClass::getNameTable());
            $this->defineView('reportDetalle', 'bodega', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
