<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;
use mvc\validatorFields\validatorFieldsClass as validate;

/**
 * Description of indexAnimalActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexHojaVidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(animalTableClass::ID)) {
                $idAnimal = request::getInstance()->getRequest(animalTableClass::ID);
            }
            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO
            );

            $fieldsGenero = array(
                generoTableClass::ID,
                generoTableClass::NOMBRE
            );
            $fieldsRaza = array(
                razaTableClass::ID,
                razaTableClass::NOMBRE_RAZA
            );
            $fields = array(
                hojaVidaTableClass::ID,
                hojaVidaTableClass::ANIMAL,
                hojaVidaTableClass::FECHA_NACIMIENTO,
                hojaVidaTableClass::GENERO_ID,
                hojaVidaTableClass::PESO,
                hojaVidaTableClass::RAZA,
                hojaVidaTableClass::PARTO
            );


            $fields1 = array(
                animalTableClass::NUMERO
            );
            $fields2 = array(
                generoTableClass::NOMBRE
            );

            $fields3 = array(
                razaTableClass::NOMBRE_RAZA
            );

            $fJoin1 = hojaVidaTableClass::ANIMAL;
            $fJoin2 = animalTableClass::ID;
            $fJoin3 = hojaVidaTableClass::GENERO_ID;
            $fJoin4 = generoTableClass::ID;
            $fJoin5 = hojaVidaTableClass::RAZA;
            $fJoin6 = razaTableClass::ID;

//            $whereDetalle = array(
//                hojaVidaTableClass::ANIMAL => $idAnimal
//            );
            $orderBy = array(
                hojaVidaTableClass::FECHA_NACIMIENTO
            );



            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                hojaVidaTableClass::ID
            );

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

            $lines = config::getRowGrid();
            $this->cntPages = animalTableClass::getAllCount($f, true, $lines);
            // $this->page = request::getInstance()->getGet('page');
            $this->objHojaVida = hojaVidaTableClass::getAllJoin($fields, $fields1, $fields2, $fields3, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, $orderBy, 'ASC', null, null);
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
            $this->objGenero = generoTableClass::getAll($fieldsGenero, false);
            $this->objRaza = razaTableClass::getAll($fieldsRaza, false);

            $this->defineView('hojadevida', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}