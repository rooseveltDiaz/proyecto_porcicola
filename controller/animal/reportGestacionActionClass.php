<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validate;

/**
 * Description of reportGestacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportGestacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
           $where = null;
    if (request::getInstance()->hasRequest('filter')) {
                $report = request::getInstance()->getPost('filter');

                if (isset($report['numero']) and $report['numero'] !== null and $report['numero'] !== '') {
                    $where[gestacionTableClass::getNameTable() . '.' . gestacionTableClass::ANIMAL] = $report['numero'];
                }//close if

             
            }//close if

            $fields = array(
                gestacionTableClass::ID,
                gestacionTableClass::FECHA,
//                gestacionTableClass::ANIMAL,
//                gestacionTableClass::EMPLEADO,
                gestacionTableClass::FECHA_MONTA,
//                gestacionTableClass::FECHA_PROBABLE_PARTO,
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
//            $this->objEmpleado = empleadoTableClass::getAll($fields2, false);
            $this->objGestacion = gestacionTableClass::getAllJoin($fields, $fields2, $fields3, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, false, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Registro de Gestacion de la Cerda';
      
            $this->defineView('index', 'gestacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
