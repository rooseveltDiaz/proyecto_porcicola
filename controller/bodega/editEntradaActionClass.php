<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of editVacunacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editEntradaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(entradaBodegaTableClass::ID)) {


                $fieldsEntrada = array(
                    entradaBodegaTableClass::ID,
                    entradaBodegaTableClass::FECHA,
                    entradaBodegaTableClass::EMPLEADO,
                );
                $where = array(
                    entradaBodegaTableClass::ID => request::getInstance()->getGet(entradaBodegaTableClass::ID)
                );

                $fieldsEmpleado2 = array(
                    empleadoTableClass::NOMBRE,
                    empleadoTableClass::ID
                );

                $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado2, false);
  $this->objEntradaBodega = entradaBodegaTableClass::getAll($fieldsEntrada, true, null, null, null, null, $where);
                $this->defineView('edit', 'entradaBodega', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('bodega', 'indexEntrada');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
