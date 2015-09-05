<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of editDetalleEntradaBodegaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editDetalleEntradaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(detalleEntradaBodegaTableClass::ID)) {
                $fields = array(
                detalleEntradaBodegaTableClass::ID,
                detalleEntradaBodegaTableClass::ID_ENTRADA,
                detalleEntradaBodegaTableClass::TIPO_INSUMO,
                detalleEntradaBodegaTableClass::ID_INSUMO,
                detalleEntradaBodegaTableClass::CANDITDAD
                );
                $where = array(
                    detalleEntradaBodegaTableClass::ID => request::getInstance()->getRequest(detalleEntradaBodegaTableClass::ID)
                );


                $fieldsTipo = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION
                );
                $fieldsInsumo =array (
                insumoTableClass::ID,
                insumoTableClass::NOMBRE
                );
                
                $fieldsEntrada = array(
                entradaBodegaTableClass::ID
                );


                $this->objTipo = tipoInsumoTableClass::getAll($fieldsTipo, true);
                $this->objEntrada = entradaBodegaTableClass::getAll($fieldsEntrada, true);
                $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true);
                $this->objDetalleEntrada = detalleEntradaBodegaTableClass::getAll($fields, true, null, null, null, null, $where);

                $this->defineView('edit', 'detalleEntradaBodega', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('bodega', 'indexDetalleEntrada');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
