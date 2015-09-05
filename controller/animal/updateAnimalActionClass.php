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
 * Description of updateAnimalActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {


                $id = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID, true));
                $lote = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::LOTE_ID, true));
               


                $ids = array(
                    animalTableClass::ID => $id
                );
                $data = array(
            
                    animalTableClass::LOTE_ID => $lote
             
                );
                animalTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'animal'));
                log::register(i18n::__('update'), usuarioTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexAnimal');
            } else {
                log::register(i18n::__('update'), usuarioTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate', null, 'animal'));
                routing::getInstance()->redirect('animal', 'indexAnimal');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
