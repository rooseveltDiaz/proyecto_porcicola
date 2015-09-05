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
class updateInsertVacunaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::ID, true));
                $cantidad = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::CANTIDAD, true));

//                vacunaTableClass::validateUpdateInsert($cantidad);
                
                $fieldsVacuna = array(vacunaTableClass::CANTIDAD);
                $where = array(vacunaTableClass::ID => $id);
                $vacuna = vacunaTableClass::getAll($fieldsVacuna, true, null, null, null, null, $where);

                $vacunaTotal = $cantidad + $vacuna[0]->cantidad;

                $ids = array(
                    vacunaTableClass::ID => $id
                );

                $data = array(
                    vacunaTableClass::CANTIDAD => $vacunaTotal
                );

                vacunaTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('successUpdate', null, 'vacuna'));
                log::register(i18n::__('update'), vacunaTableClass::getNameTable());
                routing::getInstance()->redirect('vacunacion', 'indexVacuna');
//                $data = array(
//                    razaTableClass::NOMBRE_RAZA => $nombre
//                );
//
//                razaTableClass::update($ids, $data); 
                //      session::getInstance()->setSuccess(i18n::__('succesUpdate'));
                //      log::register(i18n::__('update'), razaTableClass::getNameTable());
            } else {
                log::register(i18n::__('update'), vacunaTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate'));
                routing::getInstance()->redirect('vacunacion', 'indexVacuna');
            }//close if
//       log::register(i18n::__('update'), razaTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
            //          session::getInstance()->setError(i18n::__('errorUpdate'));
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
