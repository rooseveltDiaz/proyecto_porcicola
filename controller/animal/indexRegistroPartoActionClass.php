<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;

/**
 * Description of indexRegistroPartoActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */

class indexRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
           
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                
                            
                if (isset($filter['fecha_inicial']) and isset($filter['fecha_fin']) and $filter['fecha_inicial'] !== null and $filter['fecha_inicial'] !== '' and $filter['fecha_fin'] !== null and $filter['fecha_fin'] !== '') {

                    $where[registroPartoTableClass::FECHA_NACIMIENTO] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_inicial'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_fin'] . ' 23.59.59'))
                    );
                }
                session::getInstance()->setAttribute('partoFiltersParto', $where);
            }
             $fieldsAnimal= array(
                 animalTableClass::ID,
                 animalTableClass::NUMERO
            );
//            $fieldsRaza= array(
//            razaTableClass::ID,
//            razaTableClass::NOMBRE_RAZA
//            );
            
            $fields = array(
            registroPartoTableClass::ID,
//            registroPartoTableClass::ANIMAL_ID,
            registroPartoTableClass::FECHA_NACIMIENTO,
            registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS,
            registroPartoTableClass::MACHOS_NACIDOS_VIVOS,
            registroPartoTableClass::NACIDOS_MUERTOS,
//            registroPartoTableClass::RAZA_ID
            );
             $fields2 = array (
                 animalTableClass::NUMERO
            );
            
//            $fields3 = array (         
//                razaTableClass::NOMBRE_RAZA
//            );
             
            $fJoin1 = registroPartoTableClass::ANIMAL_ID;
            $fJoin2 = animalTableClass::ID;
//            $fJoin3 = registroPartoTableClass::RAZA_ID;
//            $fJoin4 = razaTableClass::ID;
            
            $orderBy = array(
                registroPartoTableClass::ID
            );

             $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                registroPartoTableClass::ID
            );

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

           
            $lines = config::getRowGrid();

            $this->cntPages = registroPartoTableClass::getAllCount($f, false, $lines);
           // $this->page = request::getInstance()->getGet('page');
             $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
//            $this->objRaza = razaTableClass::getAll($fieldsRaza, false);
            $this->objParto = registroPartoTableClass::getAllJoin($fields,$fields2,null,null,$fJoin1,$fJoin2,null,null,null,null,false, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'registroParto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}