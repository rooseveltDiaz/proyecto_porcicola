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
 * Description of updateGestacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                // DATOS DE ANIMAL
                $id = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::ID, true));
                $animal = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::ANIMAL, true));
                $veterinario = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::VETERINARIO, true));
                $vacuna = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true));
                $fecha = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::FECHA_VACUNACION, true));
                $dosis = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true));
                $accion = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::ACCION, true));
//                          gestacionTableClass::validate($fecha, $fecha_monta, $fecha_parto);

                //Insertar la informacion del usuario
                $ids = array(
                carneVacunasTableClass::ID => $id
                );

                $data = array(
                carneVacunasTableClass::ID => $id,
                carneVacunasTableClass::ANIMAL => $animal,
                carneVacunasTableClass::VETERINARIO => $veterinario,
                carneVacunasTableClass::VACUNA => $vacuna,
                carneVacunasTableClass::FECHA_VACUNACION => $fecha,
                carneVacunasTableClass::DOSIS => $dosis,
                carneVacunasTableClass::ACCION => $accion
                );
                carneVacunasTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'vacunacion'));
                log::register(i18n::__('update'), carneVacunasTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexVacunacion');
            } else {
                log::register(i18n::__('update'), carneVacunasTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate', null, 'animal'));
                routing::getInstance()->redirect('animal', 'indexVacunacion');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
