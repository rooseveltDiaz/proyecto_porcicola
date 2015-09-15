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
class indexAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');


                if (isset($filter['numero']) and $filter['numero'] !== null and $filter['numero'] !== '') {
                    $where [animalTableClass::NUMERO] = $filter['numero'];
                }

                if (isset($filter['lote']) and $filter['lote'] !== null and $filter['lote'] !== '') {
                    $where [animalTableClass::LOTE_ID] = $filter['lote'];
                }

                session::getInstance()->setAttribute('animalFiltersAnimal', $where);
            } elseif (session::getInstance()->hasAttribute('animalFiltersAnimal')) {
                $where = session::getInstance()->getAttribute('animalFiltersAnimal');
            }


            $fieldsGestacion = array(gestacionTableClass::ID, gestacionTableClass::ANIMAL, gestacionTableClass::FECHA);
            $objGestacion = gestacionTableClass::getAll($fieldsGestacion, false);

            foreach ($objGestacion as $key) {
                $segundos = strtotime($key->fecha) - strtotime('now');
                $diferencia_dias = intval($segundos / 60 / 60 / 24);
                $diferencia_dias = $diferencia_dias * -1;
                if ($diferencia_dias > 116) {
                    session::getInstance()->setWarning("La cerda ".$key->animal ." no se le realizo el registro de parto");
                }
            }

//            print_r($objGestacion);
//            exit();
            $fields = array(
                animalTableClass::ID,
                animalTableClass::NUMERO,
            );

            $fieldsLote = array(
                loteTableClass::ID,
                loteTableClass::NOMBRE
            );



            $fields3 = array(
                loteTableClass::NOMBRE
            );
            $fieldsHojaVida = array(
                hojaVidaTableClass::ID,
                hojaVidaTableClass::ANIMAL
            );
            $fieldsGenero = array(
                generoTableClass::ID,
                generoTableClass::NOMBRE
            );
            $fieldsRaza = array(
                razaTableClass::ID,
                razaTableClass::NOMBRE_RAZA
            );

            $fJoin1 = animalTableClass::LOTE_ID;
            $fJoin2 = loteTableClass::ID;


            $orderBy = array(
                animalTableClass::NUMERO
            );



            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                animalTableClass::ID
            );

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

            $lines = config::getRowGrid();
            $this->cntPages = animalTableClass::getAllCount($f, true, $lines, $where);
            // $this->page = request::getInstance()->getGet('page');
            $this->objGenero = generoTableClass::getAll($fieldsGenero, false);
            $this->objRaza = razaTableClass::getAll($fieldsRaza, true);
            $this->objLote = loteTableClass::getAll($fieldsLote, true);
            $this->objFilterAnimal = animalTableClass::getAll($fields, true);
            $this->objAnimal = animalTableClass::getAllJoin($fields, $fields3, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
//     $this->objAnimal = animalTableClass::getAllJoin($fields, $fields3, $fieldsHojaVida, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->objHojaVida = hojaVidaTableClass::getAll($fieldsHojaVida, true);
            $this->defineView('index', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
