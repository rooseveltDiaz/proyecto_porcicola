<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;

/**
 * Description of indexLoteActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexLoteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                loteTableClass::ID,
                loteTableClass::NOMBRE
            );
            $orderBy = array(
                loteTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                loteTableClass::ID
            );

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

            $lines = config::getRowGrid();
            $this->cntPages = loteTableClass::getAllCount($f, true, $lines);
            //$this->page = request::getInstance()->getGet('page');
            $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page);
            $this->defineView('index', 'lote', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
