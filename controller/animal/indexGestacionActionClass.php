<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;

/**
 * Description of indexGestacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexGestacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
      if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['fecha']) and $filter['fecha'] !== null and $filter['fecha'] !== '') {
                    $where[gestacionTableClass::getNameTable() . '.' . gestacionTableClass::FECHA] = $filter['fecha'];
                }//close if

                if (isset($filter['numero']) and $filter['numero'] !== null and $filter['numero'] !== '') {
                      $where[gestacionTableClass::ANIMAL] = $filter['numero'];
                }//close if
                if (isset($filter['fechaMonta']) and $filter['fechaMonta'] !== null and $filter['fechaMonta'] !== '') {
                    $where[gestacionTableClass::getNameTable() . '.' . gestacionTableClass::FECHA_MONTA] = $filter['fechaMonta'];
                }//close if
                if (isset($filter['fechaParto']) and $filter['fechaParto'] !== null and $filter['fechaParto'] !== '') {
                    $where[gestacionTableClass::getNameTable() . '.' . gestacionTableClass::FECHA_PROBABLE_PARTO] = $filter['fechaParto'];
                }//close if
                if (isset($filter['macho']) and $filter['macho'] !== null and $filter['macho'] !== '') {
                      $where[gestacionTableClass::ANIMAL_FECUNDADOR] = $filter['macho'];
                }//close if
                if (isset($filter['empleado']) and $filter['empleado'] !== null and $filter['empleado'] !== '') {
                    $where[gestacionTableClass::getNameTable() . '.' . gestacionTableClass::EMPLEADO] = $filter['empleado'];
                }//close if
              
                session::getInstance()->setAttribute('animalFiltersGestacion', $where);
            } elseif (session::getInstance()->hasAttribute('animalFiltersGestacion')) {
                $where = session::getInstance()->getAttribute('animalFiltersGestacion');
            }

            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );
            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO
            );
            $fields = array(
                gestacionTableClass::ID,
                gestacionTableClass::FECHA,
//                gestacionTableClass::EMPLEADO,
//                gestacionTableClass::ANIMAL,
                gestacionTableClass::FECHA_MONTA,
                gestacionTableClass::FECHA_PROBABLE_PARTO,
//                gestacionTableClass::ANIMAL_FECUNDADOR
            );
            $fields2 = array(
                animalTableClass::NUMERO
            );
            $fields3 = array(
                empleadoTableClass::NOMBRE
            );
            $fJoin1 = gestacionTableClass::ANIMAL;
            $fJoin2 = animalTableClass::ID;
            $fJoin3 = gestacionTableClass::EMPLEADO;
            $fJoin4 = empleadoTableClass::ID;


            $orderBy = array(
                gestacionTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                gestacionTableClass::ID
            );

            $lines = config::getRowGrid();
            $this->cntPages = gestacionTableClass::getAllCount($f, false, $lines);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

            $this->objGestacion = gestacionTableClass::getAllJoin($fields, $fields2, $fields3, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, false, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
//$this->page = request::getInstance()->getGet('page');
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, false);
            $this->defineView('index', 'gestacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
