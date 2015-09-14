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
 * Description of reportEntradaBodegaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportRegistroPesoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {


            $fields = array(
            registroPesoTableClass::FECHA,
            registroPesoTableClass::ID,
            registroPesoTableClass::KILO,
            registroPesoTableClass::PESO,
            registroPesoTableClass::VALOR
            );
            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );
            $fieldsAnimal = array (
            animalTableClass::ID,
            animalTableClass::NUMERO
            );


            $fJoin1 = registroPesoTableClass::EMPLEADO;
            $fJoin2 = empleadoTableClass::ID;
            $fJoin3 = registroPesoTableClass::ANIMAL;
            $fJoin4 = animalTableClass::ID;

            $orderBy = array(
            registroPesoTableClass::FECHA
            );
            $this->mensaje = "Informe de Registros de Peso Diario del Cerdo";
            $this->numero = animalTableClass::NUMERO;
            $this->objRegistroPeso = registroPesoTableClass::getAllJoin($fields, $fieldsEmpleado, $fieldsAnimal, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4,  null, null, true, $orderBy, 'ASC');
            log::register(i18n::__('reporte'), registroPesoTableClass::getNameTable());
            $this->defineView('indexRegistroPeso', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
