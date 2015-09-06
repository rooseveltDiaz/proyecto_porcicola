<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;

/**
 * Description of insertActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insertActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fields = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION
            );
            $this->objTipoInsumo = tipoInsumoTableClass::getAll($fields, true);
            $this->defineView('insert', 'insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
