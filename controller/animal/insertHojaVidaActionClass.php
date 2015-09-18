<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of insertAnimalActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insertHojaVidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {


            $fieldsGenero = array(
                generoTableClass::ID,
                generoTableClass::NOMBRE
            );
            $fieldsRaza = array(
                razaTableClass::ID,
                razaTableClass::NOMBRE_RAZA
            );


            $this->objGenero = generoTableClass::getAll($fieldsGenero);
            $this->objRaza = razaTableClass::getAll($fieldsRaza);
            $this->defineView('index', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
