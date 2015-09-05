<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of updateFacturaCompraActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateFacturaCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true));
                $fecha = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::FECHA_HORA_COMPRA, true));
                $empleado = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true));
                $proveedor = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true));
                $numero = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::NUMERO, true));

                procesoCompraTableClass::validateUpdate($fecha, $empleado, $proveedor);

//                $id = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::ID, true));
//                $nombre = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::NOMBRE_RAZA, true));
//
//                $ids = array(
//                    razaTableClass::ID => $id
//                );
//
//                $data = array(
//                    razaTableClass::NOMBRE_RAZA => $nombre
//                );
//
//                razaTableClass::update($ids, $data); 
                //      session::getInstance()->setSuccess(i18n::__('succesUpdate'));
                //      log::register(i18n::__('update'), razaTableClass::getNameTable());
                procesoCompraTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'facturaCompra'));
                log::register(i18n::__('update'), procesoCompraTableClass::getNameTable());
                routing::getInstance()->redirect('factura', 'indexFacturaCompra');
            } else {
//                log::register(i18n::__('update'), razaTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
//                session::getInstance()->setError(i18n::__('errorUpdate'));
                log::register(i18n::__('update'), procesoCompraTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate'));
                routing::getInstance()->redirect('factura', 'updateFacturaCompra');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
