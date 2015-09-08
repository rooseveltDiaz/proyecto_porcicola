<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of editGestacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fieldsVacunacion = array(
            carneVacunasTableClass::ACCION,
            carneVacunasTableClass::ANIMAL,
            carneVacunasTableClass::DOSIS,
            carneVacunasTableClass::FECHA_VACUNACION,
            carneVacunasTableClass::ID,
            carneVacunasTableClass::VACUNA,
            carneVacunasTableClass::VETERINARIO
            );

            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO
            );
            $fieldsVacuna = array (
            vacunaTableClass::ID,
            vacunaTableClass::NOMBRE_VACUNA
            );

            $fieldsVeterinario = array(
            veterinarioTableClass::ID,
            veterinarioTableClass::NOMBRE
            );
            $where = array(
            carneVacunasTableClass::ID => request::getInstance()->getRequest(carneVacunasTableClass::ID, true)
            );

            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
            $this->objVacuna = vacunaTableClass::getAll($fieldsVacuna, true);
            $this->objVeterinario = veterinarioTableClass::getAll($fieldsVeterinario, true);
            $this->objCarne = carneVacunasTableClass::getAll($fieldsVacunacion, true, null, null, null, null, $where);
            $this->defineView('editVacunacion', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
