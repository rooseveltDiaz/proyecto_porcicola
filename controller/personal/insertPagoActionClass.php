<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

/**
 * Description of insertPagoActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insertPagoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NUMERO_DOC,
            );
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true);
            $this->defineView('insert', 'pago', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
