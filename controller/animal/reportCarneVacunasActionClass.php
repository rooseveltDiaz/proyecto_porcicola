<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\validatorFields\validatorFieldsClass as validator;
/**
 * Description of reportInsumoActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportCarneVacunasActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
$where= null;
    if (request::getInstance()->hasRequest('filter')) {
                $report = request::getInstance()->getPost('filter');

                if (isset($report['numero']) and $report['numero'] !== null and $report['numero'] !== '') {
                    $where[carneVacunasTableClass::getNameTable() . '.' . carneVacunasTableClass::ANIMAL] = $report['numero'];
                }//close if

             
            }//close if
            $fields = array(
            carneVacunasTableClass::ID,
            carneVacunasTableClass::ACCION,
            carneVacunasTableClass::DOSIS,
            carneVacunasTableClass::FECHA_VACUNACION
            );

            $fields2 = array(
            animalTableClass::NUMERO
            );
                 $fields3 = array (
            veterinarioTableClass::NOMBRE
            );
            $fields4 = array (
            vacunaTableClass::NOMBRE_VACUNA  
            );
       

            $fJoin1 = carneVacunasTableClass::ANIMAL;
            $fJoin2 = animalTableClass::ID;
            $fJoin3 = carneVacunasTableClass::VACUNA;
            $fJoin4 = vacunaTableClass::ID;
            $fJoin5 = carneVacunasTableClass::VETERINARIO;
            $fJoin6 = veterinarioTableClass::ID;

            $orderBy = array(
            carneVacunasTableClass::FECHA_VACUNACION
            );

            $this->objCarne = carneVacunasTableClass::getAllJoin($fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, false, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Carnet de Vacunas del Cerdo';
          
            log::register(i18n::__('reporte'), carneVacunasTableClass::getNameTable());
            $this->defineView('indexVacunacion', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
