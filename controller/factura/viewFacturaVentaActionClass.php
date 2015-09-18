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
 * Description of viewFacturaVentaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class viewFacturaVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {


        /* $where = array(
          'campo' => 'valor',
          'campo' => array(
          'valor de rango inicial',
          'valor de rango final'
          ),
          'campo LIKE "hola%" OR campo LIKE "%hola" OR campo "%valor%"'
          ); */







        try {
            if (request::getInstance()->hasRequest(procesoVentaTableClass::ID)) {
                $idFactura = request::getInstance()->getRequest(procesoVentaTableClass::ID);



//                if (request::getInstance()->hasPost('filter')) {
//                    $where = null;
//                    $filter = request::getInstance()->getPost('filter');
//
//                   if (isset($filter['numero']) and $filter['numero'] !== null and $filter['numero'] !== '') {
//                        $where[detalleProcesoVentaTableClass::ID] = $filter['numero'];
//                    }//close if
//                    if (isset($filter['animal']) and $filter['animal'] !== null and $filter['animal'] !== '') {
//                        $where[detalleProcesoVentaTableClass::ANIMAL] = $filter['animal'];
//                    }//close if
//                    if (isset($filter['valor']) and $filter['valor'] !== null and $filter['valor'] !== '') {
//                        $where[detalleProcesoVentaTableClass::VALOR] = $filter['valor'];
//                    }//close if
//                    
////                    if (isset($filter['accion']) and $filter['accion'] !== null and $filter['accion'] !== '') {
////                        $where[detalleVacunacionTableClass::ACCION] = $filter['accion'];
////                    }
//
////                    $where[detalleVacunacionTableClass::ID_REGISTRO] = $idVacunacion;
//
//                    session::getInstance()->setAttribute('detalleFacturaVentaFilters');
//                } elseif (session::getInstance()->hasAttribute('detalleFacturaVentaFilters')) {
//                    $where = session::getInstance()->getAttribute('detalleFacturaVentaFilters');
//                }//close if
                
                $fieldsFacturaVenta = array(
                    procesoVentaTableClass::ID,
                    procesoVentaTableClass::FECHA_HORA_VENTA,
                    procesoVentaTableClass::EMPLEADO_ID,
                    procesoVentaTableClass::CLIENTE_ID,
                    procesoVentaTableClass::ACTIVA
                );
                $fieldsEmpleado = array(
                    empleadoTableClass::NOMBRE
                );
                $fieldsCliente = array(
                    clienteTableClass::NOMBRE
                );
                $fJoin1 = procesoVentaTableClass::EMPLEADO_ID;
                $fJoin2 = empleadoTableClass::ID;
                $fJoin3 = procesoVentaTableClass::CLIENTE_ID;
                $fJoin4 = clienteTableClass::ID;
                $whereVenta = array(
                    procesoVentaTableClass::getNameTable() . '.' . procesoVentaTableClass::ID => $idFactura
                );

                $page = 0;
//                if (request::getInstance()->hasGet('page')) {
//                    $page = request::getInstance()->getGet('page') - 1;
//                    $page = $page * config::getRowGrid();
//                }
//
//                $f = array(
//                    detalleProcesoCompraTableClass::ID
//                );
//
//                $lines = config::getRowGrid();
//                $this->cntPages = detalleVacunacionTableClass::getAllCount($f, true, $lines, $whereCnt);
                $fieldsDetalle = array(
                    detalleProcesoVentaTableClass::ID,
                    detalleProcesoVentaTableClass::VENTA,
                    detalleProcesoVentaTableClass::VALOR,
                    detalleProcesoVentaTableClass::ANIMAL,
                    detalleProcesoVentaTableClass::PESO,
                    detalleProcesoVentaTableClass::SUBTOTAL
                );
//                $fieldsProcesoVenta= array(
//                procesoVentaTableClass::ID
//                );
                
                $fieldsAnimal = array(
              
                    animalTableClass::NUMERO,
                    animalTableClass::LOTE_ID
                
                    
                );
                $fieldsFactura = array (
                procesoVentaTableClass::ID  
                );
               
              

                $fJoinDetalle = detalleProcesoVentaTableClass::ANIMAL;
                $fJoinAnimal = animalTableClass::ID;
                $fFactura = detalleProcesoVentaTableClass::VENTA;
                $fVenta = procesoVentaTableClass::ID;

                $whereDetalle = array(
                    detalleProcesoVentaTableClass::VENTA => $idFactura
                );
                $orderByDetalle = array(
                    detalleProcesoVentaTableClass::ID
                );

                $this->objFacturaVenta = procesoVentaTableClass::getAllJoin($fieldsFacturaVenta, $fieldsEmpleado, $fieldsCliente, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, null, null, null, null, $whereVenta);
                $this->objDetalleFacturaVenta = detalleProcesoVentaTableClass::getAllJoin($fieldsDetalle, $fieldsAnimal, $fieldsFactura , null, $fJoinDetalle, $fJoinAnimal, $fFactura, $fVenta, null, null, false, $orderByDetalle, 'ASC', 10, $page, $whereDetalle);
            
                log::register(i18n::__('ver1', null, 'facturaVenta'), detalleProcesoVentaTableClass::getNameTable());
                $this->defineView('view', 'facturaVenta', session::getInstance()->getFormatOutput());
            } else {
                session::getInstance()->setError('pailas');
                routing::getInstance()->redirect('factura', 'viewFacturaVenta');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
