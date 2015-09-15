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
 * Description of reportDetalleSalidaBodegaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportDetalleSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            $idVacunacion = request::getInstance()->getRequest(salidaBodegaTableClass::ID);
            if (request::getInstance()->hasRequest('report')) {
                $report = request::getInstance()->getPost('report');

//                if (isset($report['fecha']) and $report['fecha'] !== null and $report['fecha'] !== '') {
//                    $where[detalleVacunacionTableClass::FECHA] = $report['fecha'];
//                }//close if

                if (isset($report['tipoInsumo']) and $report['tipoInsumo'] !== null and $report['tipoInsumo'] !== '') {
                    $where[detalleSalidaBodegaTableClass::TIPO_INSUMO] = $report['tipoInsumo'];
                }//close if


                if (isset($report['Insumo']) and $report['Insumo'] !== null and $report['Insumo'] !== '') {
                    $where[detalleSalidaBodegaTableClass::ID_INSUMO] = $report['Insumo'];
                }//close if

                if (isset($report['cantidad']) and $report['cantidad'] !== null and $report['cantidad'] !== '') {
                    $where[detalleSalidaBodegaTableClass::getNameTable() . '.' . detalleSalidaBodegaTableClass::CANDITDAD] = $report['cantidad'];
                }//close if
               
            }//close if

            $where[detalleSalidaBodegaTableClass::ID_SALIDA] = $idVacunacion;

            $fieldsDetalleSalidaBodega = array(
                detalleSalidaBodegaTableClass::ID,
//                detalleSalidaBodegaTableClass::ID_SALIDA,
            detalleSalidaBodegaTableClass::CANDITDAD
//                detalleSalidaBodegaTableClass::TIPO_INSUMO,
//                detalleSalidaBodegaTableClass::ID_INSUMO,
             
            );

            $fieldsS = array(
                salidaBodegaTableClass::ID
            );

    
            
            $fieldsTipo = array(
                tipoInsumoTableClass::DESCRIPCION
            );

                    $fieldsInsumo = array(
                insumoTableClass::NOMBRE
            );
                    

            $fJoin1 = detalleSalidaBodegaTableClass::ID_SALIDA;
            $fJoin2 = salidaBodegaTableClass::ID;
            $fJoin3 = detalleSalidaBodegaTableClass::TIPO_INSUMO;
            $fJoin4 = tipoInsumoTableClass::ID;
            $fJoin5 = detalleSalidaBodegaTableClass::ID_INSUMO;
            $fJoin6 = insumoTableClass::ID;



            $fieldsSalida = array(
                salidaBodegaTableClass::ID,
                salidaBodegaTableClass::FECHA
            );

            $fieldsEmpleado = array(
                empleadoTableClass::NOMBRE
            );




            $fJoinVacunacion1 = salidaBodegaTableClass::EMPLEADO;
            $fJoinVacunacion2 = empleadoTableClass::ID;



            $whereVacunacion = array(
                salidaBodegaTableClass::getNameTable() . "." . salidaBodegaTableClass::ID => $idVacunacion
            );

            $orderBy = array(
                detalleSalidaBodegaTableClass::ID
            );

            $this->objDetalleSalidaBodega = detalleSalidaBodegaTableClass::getAllJoin($fieldsDetalleSalidaBodega, $fieldsS, $fieldsTipo, $fieldsInsumo,  $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, $orderBy, 'ASC', $where);
            $this->objSalidaBodega = salidaBodegaTableClass::getAllJoin($fieldsSalida, $fieldsEmpleado, null, null, $fJoinVacunacion1, $fJoinVacunacion2, null, null, null, null, true, null, null, null, null, $whereVacunacion);
            $this->mensajeDetalle = "Informe de Detalles de Salida de Bodega";
            log::register(i18n::__('reporte'), detalleSalidaBodegaTableClass::getNameTable());
            $this->defineView('reportDetalle', 'bodega', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
