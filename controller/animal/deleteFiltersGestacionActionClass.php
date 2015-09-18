<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;

/**
 * Description of deleteFiltersGestacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */

class deleteFiltersGestacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (session::getInstance()->hasAttribute('animalFiltersGestacion')) {
                session::getInstance()->deleteAttribute('animalFiltersGestacion');
            }

            routing::getInstance()->redirect('animal', 'indexGestacion');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
