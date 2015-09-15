<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;

class insertRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
//            $fieldsAnimal= array (
//            animalTableClass::ID,
//            animalTableClass::NUMERO
//            );
//  $this->objAnimal = animalTableClass::getAll($fieldsAnimal);
            $this->idAnimalSeleccionado = request::getInstance()->getGet(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL, true));
            $this->defineView('insert', 'registroParto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
