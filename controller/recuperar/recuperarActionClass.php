<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of recuperarActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class recuperarActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
                $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
                $rePassword = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::SECOND_PASSWORD, true));
                $idPregunta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true));
                $respuesta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true));

                $flag = true;

                      if ($flag == true) {
                request::getInstance()->setMethod('GET');
            }
                
                $ids = array(
                    usuarioTableClass::ID => $id
                );
                $data = array(
                    usuarioTableClass::PASSWORD => md5($password),
                    usuarioTableClass::RESTAURAR_ID => $idPregunta,
                    usuarioTableClass::RESPUESTA_SECRETA => $respuesta
                );
                usuarioTableClass::update($ids, $data);
                            routing::getInstance()->getUrlObj('shfSecurity', 'index');
            }else{
                               routing::getInstance()->forward('recuperar', 'consultar'); 
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
