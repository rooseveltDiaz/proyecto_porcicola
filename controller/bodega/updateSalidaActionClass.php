<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;

/**
 * Description of updateSalidaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateSalidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, true));

                $fecha = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true));
                $empleado = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO, true));

                salidaBodegaTableClass::validateUpdate($fecha, $empleado);

                $ids = array(
                    salidaBodegaTableClass::ID => $id
                );

                $data = array(
                    salidaBodegaTableClass::FECHA => $fecha,
                    salidaBodegaTableClass::EMPLEADO => $empleado
                );
                salidaBodegaTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('succesUpdateS', null, 'bodega'));
                log::register('update', salidaBodegaTableClass::getNameTable());
                routing::getInstance()->redirect('bodega', 'indexSalida');
            } else {
                log::register(i18n::__('update'), salidaBodegaTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate'));
                routing::getInstance()->redirect('bodega', 'indexSalida');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
