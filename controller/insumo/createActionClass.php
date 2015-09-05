<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;

/**
 * Description of createActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nombre = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true));
                $fabricacion = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true));
                $vencimiento = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true));
                $tipo_insumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true));
                $valor = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::VALOR, true));
                $cantidad = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::CANTIDAD, true));
                $stock = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::STOCK_MINIMO, true));

                insumoTableClass::validateCreate($nombre, $fabricacion, $vencimiento, $tipo_insumo, $valor, $cantidad, $stock);

                $data = array(
                    insumoTableClass::NOMBRE => $nombre,
                    insumoTableClass::FECHA_FABRICACION => $fabricacion,
                    insumoTableClass::FECHA_VENCIMIENTO => $vencimiento,
                    insumoTableClass::TIPO_INSUMO => $tipo_insumo,
                    insumoTableClass::VALOR => $valor,
                    insumoTableClass::CANTIDAD => $cantidad,
                    insumoTableClass::STOCK_MINIMO => $stock
                );

                insumoTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'insumo'));
                log::register(i18n::__('create'), insumoTableClass::getNameTable());
                routing::getInstance()->redirect('insumo', 'index');
            }//close if
            else {
                log::register(i18n::__('create'), insumoTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate'));
                routing::getInstance()->redirect('insumo', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
