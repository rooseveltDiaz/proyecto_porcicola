<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

class insertRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
//            $fieldsAnimal= array (
//            animalTableClass::ID,
//            animalTableClass::NUMERO
//            );
//  $this->objAnimal = animalTableClass::getAll($fieldsAnimal);
            $idAnimalSeleccionado = request::getInstance()->getGet(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL, true));
            $fieldsGestacion = array(
                gestacionTableClass::FECHA,
                gestacionTableClass::ID
            );
            $whereGestacion = array(
                gestacionTableClass::ANIMAL => $idAnimalSeleccionado
            );

            $objGestacion = gestacionTableClass::getAll($fieldsGestacion, false, null, null, null, null, $whereGestacion);
//            print_r($objGestacion);
//             echo   strtotime($objGestacion[0]->fecha);
//                echo time(); 

            $segundos = strtotime($objGestacion[0]->fecha) - strtotime('now');
            $diferencia_dias = intval($segundos / 60 / 60 / 24);
            $diferencia_dias = $diferencia_dias * -1;
            
            
            $flag = false;


            if ($objGestacion[0] == false) {
                session::getInstance()->setError("No existe ningun registro de gestacion para este cerdo");
                $flag = true;
                session::getInstance()->setFlash(gestacionTableClass::getNameField(gestacionTableClass::FECHA_MONTA, true), true);
            }
            if ($diferencia_dias >= 116) {
                session::getInstance()->setError("El cerdo se ha excedido de la gestacion");
                $flag = true;
                session::getInstance()->setFlash(gestacionTableClass::getNameField(gestacionTableClass::FECHA_MONTA, true), true);
            }
            if ($flag == true) {
                request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('animal', 'indexRegistroParto');
            }
//            exit();
            $this->idAnimalSeleccionado = $idAnimalSeleccionado;
            $this->defineView('insert', 'registroParto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
