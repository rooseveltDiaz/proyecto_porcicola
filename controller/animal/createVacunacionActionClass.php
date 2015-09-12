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
class createVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                // DATOS DE ANIMAL
                $veterinario = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::VETERINARIO, true));
                $animal = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::ANIMAL, true));
                $fecha_vacunacion = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::FECHA_VACUNACION, true));
                $vacuna = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true));
                $dosis = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true));
                $accion = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::ACCION, true));


                $data = array(
                    carneVacunasTableClass::ACCION => $accion,
                    carneVacunasTableClass::ANIMAL => $animal,
                    carneVacunasTableClass::DOSIS => $dosis,
                    carneVacunasTableClass::FECHA_VACUNACION => $fecha_vacunacion,
                    carneVacunasTableClass::VACUNA => $vacuna,
                    carneVacunasTableClass::VETERINARIO => $veterinario
                );

                $datos = array(
//          $fecha,
                    $veterinario,
                    $animal,
                    $fecha_vacunacion,
                    $vacuna,
                    $dosis,
                    $accion
                );
//        gestacionTableClass::validate($fecha, $fecha_monta, $fecha_parto);

                carneVacunasTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate2', null, 'dpVenta'));
                log::register(i18n::__('create'), carneVacunasTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexVacunacion');
            } else {
                log::register(i18n::__('create'), carneVacunasTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate2', null, 'animal'));
                routing::getInstance()->redirect('animal', 'indexVacunacion');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
