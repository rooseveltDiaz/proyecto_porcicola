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
                $id = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::ID, true));
                $nombre = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NOMBRE, true));
                $apellidos = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::APELLIDOS, true));
                $cedula = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CEDULA, true));
                $direccion = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::DIRECCION, true));
                $idCiudad = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CIUDAD_ID, true));
                $telefono = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TELEFONO, true));
                $correo = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CORREO, true));
                $ids = array(
                    datosUsuarioTableClass::ID => $id
                );
                $data = array(
                    datosUsuarioTableClass::NOMBRE => $nombre,
                    datosUsuarioTableClass::APELLIDOS => $apellidos,
                    datosUsuarioTableClass::CEDULA => $cedula,
                    datosUsuarioTableClass::DIRECCION => $direccion,
                    datosUsuarioTableClass::CIUDAD_ID => $idCiudad,
                    datosUsuarioTableClass::TELEFONO => $telefono,
                    datosUsuarioTableClass::CORREO => $correo
                );
                datosUsuarioTableClass::update($ids, $data);
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
