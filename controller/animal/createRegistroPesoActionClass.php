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
 * Description of createGestacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createRegistroPesoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                // DATOS DE ANIMAL
                $fecha = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::FECHA, true));
                $empleado = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::EMPLEADO, true));
                $animal = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::ANIMAL, true));
                $valor_kilo = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true));
//        $valor_total = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::VALOR, true));
                $peso = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true));
                $valor_total = $peso * $valor_kilo;

                registroPesoTableClass::validateCreate($fecha, $empleado, $peso, $valor_kilo);

//                $datos = array(
//                    $fecha,
//                    $empleado,
//                    $animal,
//                    $valor_kilo,
//                    $valor_total,
//                    $peso
//                );

                $dataPeso = array(
                    registroPesoTableClass::FECHA => $fecha,
                    registroPesoTableClass::EMPLEADO => $empleado,
                    registroPesoTableClass::ANIMAL => $animal,
                    registroPesoTableClass::KILO => $valor_kilo,
                    registroPesoTableClass::VALOR => $valor_total,
                    registroPesoTableClass::PESO => $peso
                );
                registroPesoTableClass::insert($dataPeso);

                $fieldsAnimal = array(
                    hojaVidaTableClass::NUMERO,
                    hojaVidaTableClass::PESO,
                );
                $whereAnimal = array(
                    hojaVidaTableClass::ANIMAL => $animal
                );

                $objAnimalHojaDeVida = hojaVidaTableClass::getAll($fieldsAnimal, FALSE, NULL, NULL, NULL, NULL, $whereAnimal);

                $peso = $peso + $objAnimalHojaDeVida[0]->peso_animal;
//                exit();
                // se pasa los datos del ID animal para Actualizar la hoja de vida
                $data = array(
                    hojaVidaTableClass::PESO => $peso
                );
                $ids = array(
                    hojaVidaTableClass::ANIMAL => $animal
                );
                hojaVidaTableClass::update($ids, $data);
                //FIN 

                session::getInstance()->setSuccess(i18n::__('succesCreate1', null, 'dpVenta'));
                log::register(i18n::__('create'), registroPesoTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexRegistroPeso', array(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL) => $animal));
            } else {
                log::register(i18n::__('create'), registroPesoTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate1', null, 'dpVenta'));
                routing::getInstance()->redirect('animal', 'indexRegistroPeso');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
