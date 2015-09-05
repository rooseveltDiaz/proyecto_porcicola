<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

/**
 * Description of registroPartoTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class registroPartoTableClass extends registroPartoBaseTableClass {
    
        public static function validate($fecha) {
        $flag = false;

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $dateNow = date("Y-m-d", strtotime("now"));
        $patternC = "^[a-zA-Z0-9]{3,20}$";
    if ($fecha > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPartoTableClass::getNameField(registroPartoTableClass::FECHA_NACIMIENTO, true), true);
           if ($flag == true) {
            request::getInstance()->setMethod('GET');
            request::getInstance()->addParamGet(array('id' => $id));
            routing::getInstance()->forward('animal', 'editRegistroParto');
           }
    }
        }
    
  
}