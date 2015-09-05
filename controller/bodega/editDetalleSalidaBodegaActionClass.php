<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of editDetalleSalidaBodegaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editDetalleSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(detalleSalidaBodegaTableClass::ID)) {
                $fields = array(
                detalleSalidaBodegaTableClass::ID,
                detalleSalidaBodegaTableClass::ID_SALIDA,
                detalleSalidaBodegaTableClass::TIPO_INSUMO,
                detalleSalidaBodegaTableClass::ID_INSUMO,
                detalleSalidaBodegaTableClass::CANDITDAD
                );
                $where = array(
                    detalleSalidaBodegaTableClass::ID => request::getInstance()->getRequest(detalleSalidaBodegaTableClass::ID)
                );


                $fieldsTipo = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION
                );
                $fieldsInsumo =array (
                insumoTableClass::ID,
                insumoTableClass::NOMBRE
                );
                
                $fieldsSalida = array(
                salidaBodegaTableClass::ID
                );


                $this->objTipo = tipoInsumoTableClass::getAll($fieldsTipo, true);
                $this->objSalida = salidaBodegaTableClass::getAll($fieldsSalida, true);
                $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true);
                $this->objDetalleSalida = detalleSalidaBodegaTableClass::getAll($fields, true, null, null, null, null, $where);

                $this->defineView('edit', 'detalleSalidaBodega', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('bodega', 'indexDetalleSalida');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
