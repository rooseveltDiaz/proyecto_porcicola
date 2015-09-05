<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of reportVacunacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                vacunacionTableClass::ID,
                vacunacionTableClass::FECHA,
                vacunacionTableClass::VETERINARIO,
                vacunacionTableClass::ANIMAL,
            );



            $fieldsVeterinario = array(
                veterinarioTableClass::NOMBRE
            );

            $fieldsAnimal = array(
                animalTableClass::NUMERO
            );
            $fJoin1 = vacunacionTableClass::VETERINARIO;
            $fJoin2 = veterinarioTableClass::ID;
            $fJoin3 = vacunacionTableClass::ANIMAL;
            $fJoin4 = animalTableClass::ID;


            $orderBy = array(
                vacunacionTableClass::FECHA
            );

            $this->mensaje = "Informe del Control de Vacunacion";
            $this->objVacunacion = vacunacionTableClass::getAllJoin($fields, $fieldsVeterinario, $fieldsAnimal, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC', null);

            log::register(i18n::__('reporte'), vacunacionTableClass::getNameTable());
            $this->defineView('report', 'vacunacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
