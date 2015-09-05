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
 * Description of createDetalleEntradaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createDetalleEntradaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id_registro = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_ENTRADA, true));
                $tipo_insumo = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::TIPO_INSUMO, true));
                $id_insumo = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_INSUMO, true));
                $cantidad = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::CANDITDAD, true));

                detalleEntradaBodegaTableClass::validateCreate($tipo_insumo, $id_insumo, $cantidad);

                   //Manejo de inventario
                $fieldsInventario = array(
                    insumoTableClass::CANTIDAD
                );
                $whereInventario = array(
                    insumoTableClass::ID => $id_insumo
                );
                $objInsumoInventario = insumoTableClass::getAll($fieldsInventario, true, null, null, null, null, $whereInventario);
                $insumoInventario = ($objInsumoInventario[0]->cantidad) + $cantidad;
                $id_inventario_insumo = array(
                    insumoTableClass::ID => $id_insumo
                );
                $data_inventario_insuom = array(
                    insumoTableClass::CANTIDAD => $insumoInventario
                );
                insumoTableClass::update($id_inventario_insumo, $data_inventario_insuom);


              
                $data = array(
                    detalleEntradaBodegaTableClass::CANDITDAD => $cantidad,
                    detalleEntradaBodegaTableClass::ID_ENTRADA => $id_registro,
                    detalleEntradaBodegaTableClass::ID_INSUMO => $id_insumo,
                    detalleEntradaBodegaTableClass::TIPO_INSUMO => $tipo_insumo
                );
//                print_r($data);
//                  exit();
                detalleEntradaBodegaTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate2', null, 'bodega'));
                log::register(i18n::__('create'), detalleEntradaBodegaTableClass::getNameTable());
                routing::getInstance()->redirect('bodega', 'indexEntrada');
            } else {
                log::register(i18n::__('create'), detalleEntradaBodegaTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError('El Detalle de Vacunación no pudo ser insertado');
                routing::getInstance()->redirect('bodega', 'indexEntrada');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
