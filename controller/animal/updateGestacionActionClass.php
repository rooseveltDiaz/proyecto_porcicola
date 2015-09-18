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
class updateGestacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                // DATOS DE ANIMAL
                $id = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::ID, true));
                $fecha = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::FECHA, true));
                $empleado = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::EMPLEADO, true));
                $animal = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::ANIMAL, true));
                $fecha_monta = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::FECHA_MONTA, true));
//                $fecha_parto = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::FECHA_PROBABLE_PARTO, true));
                $fecundador = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::ANIMAL_FECUNDADOR, true));

                gestacionTableClass::validate($fecha, $fecha_monta);

                //Insertar la informacion del usuario
                $ids = array(
                    gestacionTableClass::ID => $id
                );

                $data = array(
                    gestacionTableClass::FECHA => $fecha,
                    gestacionTableClass::EMPLEADO => $empleado,
                    gestacionTableClass::ANIMAL => $animal,
                    gestacionTableClass::FECHA_MONTA => $fecha_monta,
//                    gestacionTableClass::FECHA_PROBABLE_PARTO => $fecha_parto,
                    gestacionTableClass::ANIMAL_FECUNDADOR => $fecundador
                );
                gestacionTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'gestacion'));
                log::register(i18n::__('update'), gestacionTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexGestacion');
            } else {
                log::register(i18n::__('update'), gestacionTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate', null, 'animal'));
                routing::getInstance()->redirect('animal', 'indexGestacion');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
