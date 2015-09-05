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
 * Description of deleteDetalleFacturaCompraActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deleteDetalleFacturaCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')and request::getInstance()->isAjaxRequest()) {

                $id = request::getInstance()->getPost(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::ID, true));

                $ids = array(
                    detalleProcesoCompraTableClass::ID => $id
                );
                $this->arrayAjax = array(
                    'code' => 11,
                    'msg' => 'La eliminacion ha sido exitosa'
                );

                detalleProcesoCompraTableClass::stateToToggle($ids);
//                detalleVacunacionTableClass::delete($ids, true);
//                session::getInstance()->setSuccess(i18n::__('succesDelete1', null, 'facturaCompra'));
//                log::register(i18n::__('delete'), detalleVacunacionTableClass::getNameTable());
                $this->defineView('delete', 'detalleFacturaCompra', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('factura', 'indexDetalleFacturaCompra');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
