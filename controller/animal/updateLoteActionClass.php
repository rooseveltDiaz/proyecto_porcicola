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
 * Description of updateLoteActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateLoteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true));
                $nombre = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::NOMBRE, true));
//
//                $caracteres = validator::getInstance()->validatorCharactersSpecial($nombre);
//
//                if ($caracteres == true) {
//                    throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
//                }

                loteTableClass::validatCreate($nombre);


                $ids = array(
                    loteTableClass::ID => $id
                );

                $data = array(
                    loteTableClass::NOMBRE => $nombre
                );

                loteTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'lote'));
                log::register(i18n::__('update'), loteTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexLote');
            } else {
                log::register(i18n::__('update'), loteTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate'));
                routing::getInstance()->redirect('animal', 'indexLote');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
