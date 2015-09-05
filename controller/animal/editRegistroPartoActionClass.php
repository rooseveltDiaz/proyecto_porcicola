<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

/**
 * Description of editRegistroPartoActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(registroPartoTableClass::ID)) {
                $fields = array(
                    registroPartoTableClass::ID,
                    registroPartoTableClass::FECHA_NACIMIENTO,
                    registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS,
                    registroPartoTableClass::MACHOS_NACIDOS_VIVOS,
                    registroPartoTableClass::NACIDOS_MUERTOS,
                    registroPartoTableClass::ANIMAL_ID
//                    registroPartoTableClass::RAZA_ID
                );

//                $fieldsRaza = array(
//                    razaTableClass::ID,
//                    razaTableClass::NOMBRE_RAZA
//                );
                $fieldsAnimal = array(
                    animalTableClass::ID,
                    animalTableClass::NUMERO
                );
                $raza_id = 2;
                $whereAnimal = array(
                    animalTableClass::GENERO_ID => $raza_id
                );

                $where = array(
                    registroPartoTableClass::ID => request::getInstance()->getRequest(registroPartoTableClass::ID)
                );

                $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true, null, null, null, null, $whereAnimal);
//                $this->objRaza = razaTableClass::getAll($fieldsRaza, true);
                $this->objParto = registroPartoTableClass::getAll($fields, false, null, null, null, null, $where);
                $this->defineView('edit', 'registroParto', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('animal', 'indexRegistroParto');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
