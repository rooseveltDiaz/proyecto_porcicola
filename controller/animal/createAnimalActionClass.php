<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of createAnimalActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                // DATOS DE ANIMAL
               $numeroIdentificacion = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NUMERO, true));
                //validar si los campos estan vacios
                $datos = array(
                    $numeroIdentificacion
                );
                $validatorEmpty = validator::getInstance()->validateFieldsEmpty($datos);
                if ($validatorEmpty == false) {
                    throw new PDOException(i18n::__(10006, null, 'errors', null, 10006));
                }
           
            //Validar el formato de fecha
//                $validacionFecha = validator::getInstance()->validateDate($fecha);
//                if ($validacionFecha == true) {
//                    throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
//                }
            //Validar campos numericos
//            $validacionNumericos = validator::getInstance()->validateCharactersNumber($peso);
//            if ($validacionNumericos == true) {
//                throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
//            }

//                $validacionNumericos = validator::getInstance()->validateCharactersNumber($edad);
//                if ($validacionNumericos == true) {
//                    throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
//                }
            //Insertar la informacion del usuario
            $data = array(
               
                animalTableClass::LOTE_ID => 8,
                animalTableClass::NUMERO => $numeroIdentificacion
            );
            animalTableClass::insert($data);
            session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'animal'));
            log::register(i18n::__('create'), animalTableClass::getNameTable());
            routing::getInstance()->redirect('animal', 'indexAnimal');
            } else {
                log::register(i18n::__('create'), animalTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate', null, 'animal'));
                routing::getInstance()->redirect('animal', 'indexAnimal');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
