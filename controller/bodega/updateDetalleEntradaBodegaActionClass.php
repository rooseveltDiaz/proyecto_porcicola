<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of updateDetalleEntradaBodegaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateDetalleEntradaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID, true));
                $id_registro = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_ENTRADA, true));
                $tipo_insumo = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::TIPO_INSUMO, true));
                $insumo = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_INSUMO, true));
                $cantidad = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::CANDITDAD, true));
                $PATH_INFO = request::getInstance()->getPost('PATH_INFO');

                detalleEntradaBodegaTableClass::validateUpdate($tipo_insumo, $insumo, $cantidad);
                
                $ids = array(
                detalleEntradaBodegaTableClass::ID => $id
                );

                detalleEntradaBodegaTableClass::validateUpdate($tipo_insumo, $insumo, $cantidad);
                $data = array(
                detalleEntradaBodegaTableClass::TIPO_INSUMO => $tipo_insumo,
                detalleEntradaBodegaTableClass::ID_INSUMO => $insumo,
                detalleEntradaBodegaTableClass::CANDITDAD => $cantidad
                );

                detalleEntradaBodegaTableClass::update($ids, $data);
//                session::getInstance()->setSuccess(i18n::__('succesUpdate',null,'detalleVacunacion'));
                log::register(i18n::__('update'), detalleEntradaBodegaTableClass::getNameTable());
//                routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion', array('id' => $id_registro));
            }//close if

            $dir = config::getUrlBase() . config::getIndexFile() . $PATH_INFO . '?' . 'id' . '=' . $id_registro;
            header('location: ' . $dir);
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
