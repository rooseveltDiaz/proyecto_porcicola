<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of updateVacunaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateInsertRegistroPesoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::ID, true));
                $cantidad = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true));

//                vacunaTableClass::validateUpdateInsert($cantidad);
                
                $fieldsVacuna = array(registroPesoTableClass::KILO);
                $where = array(registroPesoTableClass::ID => $id);
                $vacuna = registroPesoTableClass::getAll($fieldsVacuna, true, null, null, null, null, $where);

                $vacunaTotal = $cantidad + $vacuna[0]->valor_kilo;

                $ids = array(
                registroPesoTableClass::ID => $id
                );

                $data = array(
                registroPesoTableClass::KILO => $vacunaTotal
                );

                registroPesoTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('qil', null, 'animal'));
                log::register(i18n::__('update'), registroPesoTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexRegistroPeso');
//                $data = array(
//                    razaTableClass::NOMBRE_RAZA => $nombre
//                );
//
//                razaTableClass::update($ids, $data); 
                //      session::getInstance()->setSuccess(i18n::__('succesUpdate'));
                //      log::register(i18n::__('update'), razaTableClass::getNameTable());
            } else {
                log::register(i18n::__('update'), registroPesoTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate'));
                routing::getInstance()->redirect('animal', 'indexRegistroPeso');
            }//close if
//       log::register(i18n::__('update'), razaTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
            //          session::getInstance()->setError(i18n::__('errorUpdate'));
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
