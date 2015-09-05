<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

/**
 * Description of insertRegistroPartoActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insertRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fieldsRaza = array(
                razaTableClass::ID,
                razaTableClass::NOMBRE_RAZA
            );

            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO
            );
                $whereAnimal = array(
                    animalTableClass::GENERO_ID => 1
                );
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true, null,null,null,null,$whereAnimal);
            $this->objRaza = razaTableClass::getAll($fieldsRaza, true);
            $this->defineView('insert', 'registroParto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
