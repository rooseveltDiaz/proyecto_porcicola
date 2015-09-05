<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of editSalidaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editSalidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(salidaBodegaTableClass::ID)) {


                $fieldsSalida = array(
                    salidaBodegaTableClass::ID,
                    salidaBodegaTableClass::FECHA,
                    salidaBodegaTableClass::EMPLEADO,
                );
                $where = array(
                    salidaBodegaTableClass::ID => request::getInstance()->hasRequest(salidaBodegaTableClass::ID)
                );

                $fieldsEmpleado2 = array(
                    empleadoTableClass::NOMBRE,
                    empleadoTableClass::ID
                );

                $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado2, false);
                $this->objSalidaBodega = salidaBodegaTableClass::getAll($fieldsSalida, true, null, null, null, null, $where);
                $this->defineView('edit', 'salidaBodega', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('bodega', 'indexSalida');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
