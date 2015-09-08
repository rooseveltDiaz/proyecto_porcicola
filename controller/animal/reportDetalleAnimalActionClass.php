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
 * Description of reportDetalleAnimalActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportDetalleAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
//            $idAnimal = request::getInstance()->getRequest(animalTableClass::ID);
            if (request::getInstance()->hasRequest('filter')) {
                $report = request::getInstance()->getPost('filter');

                if (isset($report['numero']) and $report['numero'] !== null and $report['numero'] !== '') {
                    $where[animalTableClass::getNameTable() . '.' . animalTableClass::ID] = $report['numero'];
                }//close if

                if (isset($report['lote']) and $report['lote'] !== null and $report['lote'] !== '') {
                    $where[animalTableClass::getNameTable() . '.' . animalTableClass::LOTE_ID] = $report['lote'];
                }//close if
            }//close if



            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO,
                animalTableClass::LOTE_ID
            );

            $fieldsLote = array(
                loteTableClass::NOMBRE
            );

            $fJoin1 = animalTableClass::LOTE_ID;
            $fJoin2 = loteTableClass::ID;

//            print_r($where); 
//echo 12;
//        exit();
            $this->objAnimal = animalTableClass::getAllJoin($fieldsAnimal, $fieldsLote, null, null, $fJoin1, $fJoin2, null, null, null, null, true, null, null, null, null, $where);
       
            $this->mensajeDetalle = "Inventario de Cerdos por Lote";
            log::register(i18n::__('reporte'), animalTableClass::getNameTable());
            $this->defineView('reportDetalle', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
