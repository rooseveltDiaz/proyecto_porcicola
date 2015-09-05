<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of createEntradaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createEntradaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fecha = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, true));
            $empleado = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO, true));

            entradaBodegaTableClass::validateCreate($fecha, $empleado);

            $data = array(
                entradaBodegaTableClass::EMPLEADO => $empleado,
                entradaBodegaTableClass::FECHA => $fecha,
                entradaBodegaTableClass::ESTADO => true
            );
            entradaBodegaTableClass::insert($data);
            session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'bodega'));
            log::register(i18n::__('create'), entradaBodegaTableClass::getNameTable());
            routing::getInstance()->redirect('bodega', 'indexEntrada');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
