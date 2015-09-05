<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of detalleProcesoVentaTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detalleProcesoVentaTableClass extends detalleProcesoVentaBaseTableClass {

    public static function validateCreate($animal, $valor) {
        $flag = false;

 
        if (empty($animal) or ! isset($animal) or $animal == '') {

            session::getInstance()->setError(i18n::__(10093, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoVentaTableClassgetNameField(detalleProcesoVentaTableClass::ANIMAL, true), true);
        }
        if (!is_numeric($animal)) {
            session::getInstance()->setError(i18n::__(10057, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::ANIMAL, true), true);
        }
        if ($animal < 0) {
            session::getInstance()->setError(i18n::__(10095, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::ANIMAL, true), true);
        }
        if ($valor < 0) {
            session::getInstance()->setError(i18n::__(10116, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::VALOR, true), true);
        }

        if (empty($valor) or ! isset($valor) or $valor == '') {

            session::getInstance()->setError(i18n::__(10117, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::VALOR, true), true);
        }
        if (!is_numeric($valor)) {
            session::getInstance()->setError(i18n::__(10118, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::VALOR, true), true);
        }

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('factura', 'indexFacturaVenta');
        }
    }

}
