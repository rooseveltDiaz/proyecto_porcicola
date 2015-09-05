<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

/**
 * Description of veterinarioTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class veterinarioTableClass extends veterinarioBaseTableClass {

    public static function validateCreate($nombre_completo, $direccion, $numero_documento, $telefono) {
        $flag = false;
        $patron = "^[a-zA-Z0-9]{3,20}$";

        if (empty($numero_documento)) {
            session::getInstance()->setError('vacio el campo num');
            $flag = true;
            session::getInstance()->setFirstCall(veterinarioTableClass::getNameField(veterinarioTableClass::NUMERO_DOC, true), true);
        }
        if (empty($telefono)) {
            session::getInstance()->setError('vacio el campo tel');
            $flag = true;
            session::getInstance()->setFirstCall(veterinarioTableClass::getNameField(veterinarioTableClass::TEL, true), true);
        }
        if (empty($direccion)) {
            session::getInstance()->setError('vacio el campo direc');
            $flag = true;
            session::getInstance()->setFirstCall(veterinarioTableClass::getNameField(veterinarioTableClass::DIRECCION, true), true);
        }
        if (empty($nombre_completo) or ! isset($nombre_completo) or $nombre_completo == '') {
            session::getInstance()->setError('No puede ser vacio');
            $flag = true;
            session::getInstance()->setFlash(veterinarioTableClass::getNameField(veterinarioTableClass::NOMBRE, true), true);
        } else if (strlen($nombre_completo) < 2) {
            session::getInstance()->setError('Minimo dos caracteres');
            $flag = true;
            session::getInstance()->setFlash(veterinarioTableClass::getNameField(veterinarioTableClass::NOMBRE, true), true);
        } else if (!ereg($patron, $nombre_completo)) {
            session::getInstance()->setError('No se permiten caracteres especiales');
            $flag = true;
            session::getInstance()->setFirstCall(veterinarioTableClass::getNameField(veterinarioTableClass::NOMBRE, true), true);
        }

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('personal', 'insertVeterinario');
        }
    }

    public static function validateEdit($nombre_completo, $direccion, $numero_documento, $telefono) {
        $flag = false;
        $patron = "^[a-zA-Z0-9]{3,20}$";
        if (empty($numero_documento)) {
            session::getInstance()->setError('vacio el campo num');
            $flag = true;
            session::getInstance()->setFirstCall(veterinarioTableClass::getNameField(clienteTableClass::NUMERO_DOC, true), true);
        }
        if (empty($telefono)) {
            session::getInstance()->setError('vacio el campo tel');
            $flag = true;
            session::getInstance()->setFirstCall(veterinarioTableClass::getNameField(veterinarioTableClass::TEL, true), true);
        }
        if (empty($direccion)) {
            session::getInstance()->setError('vacio el campo direc');
            $flag = true;
            session::getInstance()->setFirstCall(veterinarioTableClass::getNameField(veterinarioTableClass::DIRECCION, true), true);
        }
        if (empty($nombre_completo) or ! isset($nombre_completo) or $nombre_completo == '') {
            session::getInstance()->setError('No puede ser vacio');
            $flag = true;
            session::getInstance()->setFlash(veterinarioTableClass::getNameField(veterinarioTableClass::NOMBRE, true), true);
        } else if (strlen($nombre_completo) < 2) {
            session::getInstance()->setError('Minimo dos caracteres');
            $flag = true;
            session::getInstance()->setFlash(veterinarioTableClass::getNameField(veterinarioTableClass::NOMBRE, true), true);
        } else if (!ereg($patron, $nombre_completo)) {
            session::getInstance()->setError('No se permiten caracteres especiales');
            $flag = true;
            session::getInstance()->setFirstCall(veterinarioTableClass::getNameField(veterinarioTableClass::NOMBRE, true), true);
        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('personal', 'editVeterinario');
        }
    }

}
