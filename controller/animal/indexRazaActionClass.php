<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;

/**
 * Description of indexRazaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexRazaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                razaBaseTableClass::ID,
                razaBaseTableClass::NOMBRE_RAZA
            );

            $orderBy = array(
                razaTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                razaTableClass::ID
            );

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

            $lines = config::getRowGrid();

            $this->cntPages = razaTableClass::getAllCount($f, false, $lines);
            // $this->page = request::getInstance()->getGet('page');
            $this->objRaza = razaBaseTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page);
            $this->defineView('index', 'raza', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
