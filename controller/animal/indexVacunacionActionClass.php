<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;

/**
 * Description of indexVacunacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
      if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['fecha_inicio']) and $filter['fecha_inicio'] !== null and $filter['fecha_inicio'] !== '' and isset($filter['fecha_fin']) and $filter ['fecha_fin'] !== null and $filter['fecha_fin'] !== '') {

                    $where [carneVacunasTableClass::getNameTable() . '.' . carneVacunasTableClass::FECHA_VACUNACION] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_inicio'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_fin'] . ' 23.59.59'))
                    );
                }//close if

                if (isset($filter['veterinario']) and $filter['veterinario'] !== null and $filter['veterinario'] !== '') {
                    $where[carneVacunasTableClass::getNameTable() . '.' . carneVacunasTableClass::VETERINARIO] = $filter['veterinario'];
                }//close if
                if (isset($filter['vacuna']) and $filter['vacuna'] !== null and $filter['vacuna'] !== '') {
                    $where[carneVacunasTableClass::getNameTable() . '.' . carneVacunasTableClass::VACUNA] = $filter['vacuna'];
                }//close if
                if (isset($filter['dosis']) and $filter['dosis'] !== null and $filter['dosis'] !== '') {
                      $where[carneVacunasTableClass::DOSIS] = $filter['dosis'];
                }//close if
                if (isset($filter['accion']) and $filter['accion'] !== null and $filter['accion'] !== '') {
                    $where[carneVacunasTableClass::getNameTable() . '.' . carneVacunasTableClass::ACCION] = $filter['accion'];
                }//close if
              
                session::getInstance()->setAttribute('animalFiltersVacunacion', $where);
            } elseif (session::getInstance()->hasAttribute('animalFiltersVacunacion')) {
                $where = session::getInstance()->getAttribute('animalFiltersVacunacion');
            }

            $fieldsVeterinario = array(
            veterinarioTableClass::ID,
            veterinarioTableClass::NOMBRE
            );
            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO
            );
            $fieldsVacuna = array (
            vacunaTableClass::ID,
            vacunaTableClass::NOMBRE_VACUNA
            );
            $fields = array(
            carneVacunasTableClass::ACCION,
            carneVacunasTableClass::DOSIS,

            carneVacunasTableClass::FECHA_VACUNACION,
            carneVacunasTableClass::ID
            );
            $fields2 = array(
                animalTableClass::NUMERO
            );
            $fields3 = array(
            veterinarioTableClass::NOMBRE
            );
            $fields4 = array (
            vacunaTableClass::NOMBRE_VACUNA  
            );
            $fJoin1 = carneVacunasTableClass::ANIMAL;
            $fJoin2 = animalTableClass::ID;
            $fJoin3 = carneVacunasTableClass::VETERINARIO;
            $fJoin4 = veterinarioTableClass::ID;
            $fJoin5 = carneVacunasTableClass::VACUNA;
            $fJoin6 = vacunaTableClass::ID;


            $orderBy = array(
            carneVacunasTableClass::FECHA_VACUNACION
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
            carneVacunasTableClass::ID
            );

            $lines = config::getRowGrid();
            $this->cntPages = carneVacunasTableClass::getAllCount($f, true, $lines);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

            $this->objCarne = carneVacunasTableClass::getAllJoin($fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
//$this->page = request::getInstance()->getGet('page');
            $this->objVeterinario = veterinarioTableClass::getAll($fieldsVeterinario, true);
            $this->objVacuna = vacunaTableClass::getAll($fieldsVacuna, true);
            $this->idAnimalHojaVida = request::getInstance()->getGet(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL, true));
            $this->defineView('indexVacunacion', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
