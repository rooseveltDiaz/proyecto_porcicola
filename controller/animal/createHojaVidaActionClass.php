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
 * Description of createHojaVidaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createHojaVidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                // DATOS DE ANIMAL
                $fecha_nacimiento = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true));
                $genero = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO_ID, true));
                $raza = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA, true));
//                $parto = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::PARTO, true));
                $peso = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::PESO, true));
//validar si los campos estan vacios
                $datos = array(
                    $fecha_nacimiento,
                    $genero,
//                    $parto,
                    $raza,
                    $peso
                );
         

                //Validar el formato de fecha
//                $validacionFecha = validator::getInstance()->validateDate($fecha);
//                if ($validacionFecha == true) {
//                    throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
//                }
                //Validar campos numericos
      

//                $validacionNumericos = validator::getInstance()->validateCharactersNumber($edad);
//                if ($validacionNumericos == true) {
//                    throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
//                }
                //Insertar la informacion del usuario
                $data = array(
                hojaVidaTableClass::FECHA_NACIMIENTO => $fecha_nacimiento,
                hojaVidaTableClass::GENERO_ID => $genero,
//                hojaVidaTableClass::PARTO => $parto,
                hojaVidaTableClass::PESO => $peso,
                hojaVidaTableClass::RAZA => $raza
                  
                );
                hojaVidaTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'animal'));
                log::register(i18n::__('create'), hojaVidaTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexHojaVida');
            } else {
                log::register(i18n::__('create'), hojaVidaTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate', null, 'animal'));
                routing::getInstance()->redirect('animal', 'indexHojaVida');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
