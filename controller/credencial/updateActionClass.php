<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

/**
 * Description of updateActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::ID, true));

                $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));
//                $descripcion = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::DESCRIPCION, true));
                
                $ids = array(
                    credencialTableClass::ID => $id
                );
                $data = array(
                    credencialTableClass::ID => $id,
                    credencialTableClass::NOMBRE => $nombre
//                    credencialTableClass::DESCRIPCION => $descripcion
                );
                credencialTableClass::update($ids, $data);
            }//close if
            routing::getInstance()->redirect('credencial', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
