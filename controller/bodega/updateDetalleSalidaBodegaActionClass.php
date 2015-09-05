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
 * Description of updateDetalleSalidaBodegaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateDetalleSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID, true));
                $id_registro = request::getInstance()->getPost(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_SALIDA, true));
                $tipo_insumo = request::getInstance()->getPost(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::TIPO_INSUMO, true));
                $insumo = request::getInstance()->getPost(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_INSUMO, true));
                $cantidad = request::getInstance()->getPost(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::CANDITDAD, true));
                $PATH_INFO = request::getInstance()->getPost('PATH_INFO');

                detalleSalidaBodegaTableClass::validateUpdate($tipo_insumo, $insumo, $cantidad);
                
                $ids = array(
                detalleSalidaBodegaTableClass::ID => $id
                );

//                detalleSalidaBodegaTableClass::validateUpdate($tipo_insumo, $insumo, $cantidad);
                $data = array(
                detalleSalidaBodegaTableClass::TIPO_INSUMO => $tipo_insumo,
                detalleSalidaBodegaTableClass::ID_INSUMO => $insumo,
                detalleSalidaBodegaTableClass::CANDITDAD => $cantidad
                );

                detalleSalidaBodegaTableClass::update($ids, $data);
//              
                log::register(i18n::__('update'), detalleSalidaBodegaTableClass::getNameTable());
             
              }//close if

            $dir = config::getUrlBase() . config::getIndexFile() . $PATH_INFO . '?' . 'id' . '=' . $id_registro;
            header('location: ' . $dir);
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
