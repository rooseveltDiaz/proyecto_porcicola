<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of editGestacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editGestacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fieldsGestacion = array(
                gestacionTableClass::ID,
                gestacionTableClass::FECHA,
                gestacionBaseTableClass::FECHA_MONTA,
//                gestacionTableClass::FECHA_PROBABLE_PARTO,
                gestacionTableClass::EMPLEADO,
                gestacionTableClass::ANIMAL,
                gestacionTableClass::ANIMAL_FECUNDADOR
            );

            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO
            );

            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );
            $where = array(
                gestacionTableClass::ID => request::getInstance()->getRequest(gestacionTableClass::ID, true)
            );

            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true);
            $this->objGestacion = gestacionTableClass::getAll($fieldsGestacion, false, null, null, null, null, $where);
            $this->defineView('edit', 'gestacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
