<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;

/**
 * Description of indexRegistroPesoActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexRegistroPesoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['fecha']) and $filter['fecha'] !== null and $filter['fecha'] !== '' and isset($filter['fin']) and $filter ['fin'] !== null and $filter['fin'] !== '') {

                    $where [registroPesoTableClass::getNameTable() . '.' . registroPesoTableClass::FECHA] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fecha'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fin'] . ' 23.59.59'))
                    );
                }
                if (isset($filter['empleado']) and $filter['empleado'] !== null and $filter['empleado'] !== '') {
                    $where[registroPesoTableClass::getNameTable() . '.' . registroPesoTableClass::EMPLEADO] = $filter['empleado'];
                }//close if
                if (isset($filter['kilo']) and $filter['kilo'] !== null and $filter['kilo'] !== '') {
                    $where[registroPesoTableClass::KILO] = $filter['kilo'];
                }//close if
                if (isset($filter['total']) and $filter['total'] !== null and $filter['total'] !== '') {
                    $where[registroPesoTableClass::getNameTable() . '.' . registroPesoTableClass::VALOR] = $filter['total'];
                }//close if
                if (isset($filter['peso']) and $filter['peso'] !== null and $filter['peso'] !== '') {
                    $where[registroPesoTableClass::getNameTable() . '.' . registroPesoTableClass::PESO] = $filter['peso'];
                }//close if

                session::getInstance()->setAttribute('animalFiltersRegistroPeso', $where);
            } elseif (session::getInstance()->hasAttribute('animalFiltersRegistroPeso')) {
                $where = session::getInstance()->getAttribute('animalFiltersRegistroPeso');
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
                registroPesoTableClass::ID,
                registroPesoTableClass::FECHA,
                registroPesoTableClass::KILO,
                registroPesoTableClass::PESO,
                registroPesoTableClass::VALOR
            );
            $fields2 = array(
                empleadoTableClass::NOMBRE
            );
            $fields3 = array(
                animalTableClass::NUMERO
            );
            $fJoin1 = registroPesoTableClass::ANIMAL;
            $fJoin2 = animalTableClass::ID;
            $fJoin3 = registroPesoTableClass::EMPLEADO;
            $fJoin4 = empleadoTableClass::ID;


            $orderBy = array(
                registroPesoTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                registroPesoTableClass::ID
            );

            $lines = config::getRowGrid();
            $this->cntPages = registroPesoTableClass::getAllCount($f, false, $lines);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }



            $this->objRegistroPeso = registroPesoTableClass::getAllJoin($fields, $fields2, $fields3, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, false, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
            //$this->page = request::getInstance()->getGet('page');
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true);
            $this->defineView('indexRegistroPeso', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
