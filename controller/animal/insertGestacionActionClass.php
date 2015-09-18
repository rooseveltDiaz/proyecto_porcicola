<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of insertGestacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insertGestacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
     

            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO
            );
            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );
         
            $where = array(
            hojaVidaTableClass::GENERO_ID => 2
            );
            
         
            $this->objAnimal = hojaVidaTableClass::getAll($fieldsAnimal, true, null, null, null,null, $where);
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true);
            $this->idAnimalHojaVida = request::getInstance()->getGet(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL, true));
            $this->defineView('insert', 'gestacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
