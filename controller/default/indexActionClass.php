<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of indexActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $idUser = session::getInstance()->getUserId();

            $fields = array(
                datosUsuarioTableClass::CORREO,
                datosUsuarioTableClass::NOMBRE
            );
            $where = array(
                datosUsuarioTableClass::USUARIO_ID => $idUser
            );
            $objDatosUsuario = datosUsuarioTableClass::getAll($fields, true, null, null, null, null, $where);
            session::getInstance()->setAttribute('correoUser', $objDatosUsuario[0]->correo);
            $this->defineView('index', 'default', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
