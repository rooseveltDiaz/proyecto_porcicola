<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

/**
 * Description of registroPesoTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class registroPesoTableClass extends registroPesoBaseTableClass {
     public static function validateCreate($fecha, $empleado, $animal, $valor_kilo, $valor_total, $peso) {
        $flag = false;
         if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('animal', 'insertRegistroPeso');
        }
    }
}
