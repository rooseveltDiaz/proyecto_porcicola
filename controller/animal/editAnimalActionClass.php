<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of editAnimalActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(animalTableClass::ID)) {

           
                $fieldsLote = array(
                    loteTableClass::ID,
                    loteTableClass::NOMBRE
                );
          
                $fieldsAnimal = array(
         
                    animalTableClass::ID,
                    animalTableClass::LOTE_ID,
                
                );
                $where = array(
                    animalTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID, true)
                );

          
                $this->objLote = loteTableClass::getAll($fieldsLote);
              
                $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true, null, null, null, null, $where);
                $this->defineView('edit', 'animal', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('animal', 'indexAnimal');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
