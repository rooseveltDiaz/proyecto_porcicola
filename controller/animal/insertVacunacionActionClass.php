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
class insertVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO
            );
            $fieldsVeterinario = array(
            veterinarioTableClass::ID,
            veterinarioTableClass::NOMBRE
            );
            $fieldsVacuna = array (
            vacunaTableClass::ID,
            vacunaTableClass::NOMBRE_VACUNA
            ) ;
         
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
            $this->objVeterinario = veterinarioTableClass::getAll($fieldsVeterinario, true);
            $this->objVacuna = vacunaTableClass::getAll($fieldsVacuna, true);
            $this->defineView('insertVacunacion', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
