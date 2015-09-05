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
 * Description of deleteSelectEmpleadoActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deleteSelectEmpleadoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {

                $idsToDelete = request::getInstance()->getPost('chk');

                foreach ($idsToDelete as $id) {
                    $ids = array(
                        empleadoTableClass::ID => $id
                    );
                    empleadoTableClass::delete($ids, true);
                }

                log::register(i18n::__('delete'), empleadoTableClass::getNameTable());
                session::getInstance()->setSuccess(i18n::__('succesDelete', null, 'empleado'));
                routing::getInstance()->redirect('empleado', 'indexEmpleado');
            } else {
                log::register(i18n::__('errorDelete'), empleadoTableClass::getNameTable());
                session::getInstance()->setError(i18n::__('errorDeleteMasivo', null, 'user'));
                routing::getInstance()->redirect('empleado', 'indexEmpleado');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
