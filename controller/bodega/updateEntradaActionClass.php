<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;

//use mvc\request\requestClass as request;

/**
 * Description of updateEntradaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateEntradaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID, true));

                $fecha = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, true));
                $empleado = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO, true));

                entradaBodegaTableClass::validateUpdate($fecha, $empleado);

                $ids = array(
                    entradaBodegaTableClass::ID => $id
                );

                $data = array(
                    entradaBodegaTableClass::FECHA => $fecha,
                    entradaBodegaTableClass::EMPLEADO => $empleado
                );
                entradaBodegaTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'bodega'));
                log::register('update', entradaBodegaTableClass::getNameTable());
                routing::getInstance()->redirect('bodega', 'indexEntrada');
            } else {
                log::register(i18n::__('update'), entradaBodegaTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate'));
                routing::getInstance()->redirect('bodega', 'indexEntrada');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
