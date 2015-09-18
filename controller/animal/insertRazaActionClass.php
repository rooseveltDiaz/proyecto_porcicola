<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

/**
 * Description of insertRazaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insertRazaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $this->defineView('insert', 'raza', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
