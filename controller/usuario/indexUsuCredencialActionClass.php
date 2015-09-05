
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class indexUsuCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;

            $fields = array(
                usuarioCredencialTableClass::ID
            );
            $fields2 = array(
                usuarioTableClass::USER
            );
            $fields3 = array(
                credencialTableClass::NOMBRE
            );
            $fJoin1 = usuarioCredencialTableClass::USUARIO_ID;
            $fJoin2 = usuarioTableClass::ID;
            $fJoin3 = usuarioCredencialTableClass::CREDENCIAL_ID;
            $fJoin4 = credencialTableClass::ID;

            $orderBy = array(
                usuarioCredencialTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                usuarioCredencialTableClass::ID
            );

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }
            $lines = config::getRowGrid();
            $this->cntPages = usuarioCredencialTableClass::getAllCount($f, true, $lines, $where);
            $this->objUsuCrede = usuarioCredencialTableClass::getAllJoin($fields, $fields2, $fields3, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, false, $orderBy, 'ASC', config::getRowGrid(), $page, $where);

            $this->defineView('index', 'usuarioCredencial', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
