<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\validatorFields\validatorFieldsClass as validator;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of createDetalleFacturaCompraActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateDetalleProcesoCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {


                $id_registro = request::getInstance()->getPost(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::PROCESO_COMPRA_ID, true));
                $insumo = request::getInstance()->getPost(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::INSUMO_ID, true));
                $tipo = request::getInstance()->getPost(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::TIPO_INSUMO, true));
                $cantidad = request::getInstance()->getPost(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::CANTIDAD, true));
                $valor = request::getInstance()->getPost(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::VALOR_UNITARIO, true));
                detalleProcesoCompraTableClass::validateCreate($id_registro, $insumo, $cantidad, $valor);
                $subtotal = $valor * $cantidad;
                $data = array(
                    detalleProcesoCompraTableClass::CANTIDAD => $cantidad,
                    detalleProcesoCompraTableClass::INSUMO_ID => $insumo,
                    detalleProcesoCompraTableClass::TIPO_INSUMO => $tipo,
                    detalleProcesoCompraTableClass::PROCESO_COMPRA_ID => $id_registro,
                    detalleProcesoCompraTableClass::VALOR_UNITARIO => $valor,
                    detalleProcesoCompraTableClass::SUBTOTAL => $subtotal
                );

//                //Manejo de inventario
//                $fieldsInventario = array(
//                    insumoTableClass::CANTIDAD
//                );
//                $whereInventario = array(
//                    insumoTableClass::ID => $insumo
//                );
//                $objInsumoInventario = insumoTableClass::getAll($fieldsInventario, true, null, null, null, null, $whereInventario);
//                $insumoInventario = ($objInsumoInventario[0]->cantidad) + $cantidad;
//                $id_inventario_insumo = array(
//                    insumoTableClass::ID => $insumo
//                );
//                $data_inventario_insuom = array(
//                    insumoTableClass::CANTIDAD => $insumoInventario
//                );


//                insumoTableClass::update($id_inventario_insumo, $data_inventario_insuom);
                detalleProcesoCompraTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'facturaCompra'));
                log::register(i18n::__('update'), detalleProcesoCompraTableClass::getNameTable());
                routing::getInstance()->redirect('factura', 'indexDetalleFacturaCompra');
            } else {
                session::getInstance()->setError('El Detalle de Vacunación no pudo ser insertado');
                routing::getInstance()->redirect('factura', 'indexDetalleFacturaCompra');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
