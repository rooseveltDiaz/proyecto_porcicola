<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of deleteActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::ID, true));

                $ids = array(
                    datosUsuarioTableClass::ID => $id
                );
                datosUsuarioTableClass::delete($ids, true);
            }
            routing::getInstance()->redirect('dataUser', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
