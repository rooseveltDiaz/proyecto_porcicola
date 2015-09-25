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
                $id_vacuna = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true));
                $dosis = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true));
                $accion = request::getInstance()->getPost(carneVacunasTableClass::getNameField(carneVacunasTableClass::ACCION, true));
             
                carneVacunasTableClass::validateCrear($veterinario, $fecha_vacunacion, $animal, $id_vacuna, $dosis, $accion);

                $data = array(
                    carneVacunasTableClass::ACCION => $accion,
                    carneVacunasTableClass::ANIMAL => $animal,
                    carneVacunasTableClass::DOSIS => $dosis,
                    carneVacunasTableClass::FECHA_VACUNACION => $fecha_vacunacion,
                    carneVacunasTableClass::VACUNA => $id_vacuna,
                    carneVacunasTableClass::VETERINARIO => $veterinario
                );

                $datos = array(
                    $veterinario,
                    $animal,
                    $fecha_vacunacion,
                    $id_vacuna,
                    $dosis,
                    $accion
                );
 //Manejo de inventario
                $fieldsVacuna = array(
                    vacunaTableClass::CANTIDAD
                );
                $whereVacuna = array(
                    vacunaTableClass::ID => $id_vacuna
                );
                $objVacuna = vacunaTableClass::getAll($fieldsVacuna, true, null, null, null, null, $whereVacuna);

                carneVacunasTableClass::validateInventario($objVacuna[0]->cantidad, 1);

                $vacunaInventario = ($objVacuna[0]->cantidad) - 1;
                $idsVacuna = array(
                    vacunaTableClass::ID => $id_vacuna
                );
                $dataVacuna = array(
                    vacunaTableClass::CANTIDAD => $vacunaInventario
                );
                vacunaTableClass::update($idsVacuna, $dataVacuna);

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
