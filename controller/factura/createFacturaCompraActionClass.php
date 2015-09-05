<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;

/**
 * Description of createFacturaCompraActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createFacturaCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fecha = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::FECHA_HORA_COMPRA, true));
            $empleado = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true));
            $proveedor = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true));
            $numero= request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::NUMERO, true));
            procesoCompraTableClass::validateCreate($fecha, $empleado, $proveedor, $numero);
            
            $data = array(
                procesoCompraTableClass::FECHA_HORA_COMPRA => $fecha,
                procesoCompraTableClass::EMPLEADO_ID => $empleado,
                procesoCompraTableClass::PROVEEDOR_ID => $proveedor,
                procesoCompraTableClass::NUMERO => $numero
            );

            procesoCompraTableClass::validateCreate($fecha, $empleado, $proveedor);

            procesoCompraTableClass::insert($data);
            session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'facturaCompra'));
            log::register(i18n::__('create'), procesoCompraTableClass::getNameTable());
            routing::getInstance()->redirect('factura', 'indexFacturaCompra');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
