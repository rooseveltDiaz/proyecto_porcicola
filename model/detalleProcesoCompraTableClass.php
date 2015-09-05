<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of detalleProcesoCompraTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detalleProcesoCompraTableClass extends detalleProcesoCompraBaseTableClass {

    public static function validateCreate($insumo, $cantidad, $valor, $tipo) {
        $flag = false;

        if (empty($id_registro) or ! isset($id_registro) or $id_registro == '') {

            session::getInstance()->setError(i18n::__(10107, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClassgetNameField(detalleProcesoCompraTableClass::PROCESO_COMPRA_ID, true), true);
        }
        if (!is_numeric($id_registro)) {
            session::getInstance()->setError(i18n::__(10108, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::PROCESO_COMPRA_ID, true), true);
        }
        if ($id_registro < 0) {
            session::getInstance()->setError(i18n::__(10109, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::PROCESO_COMPRA_ID, true), true);
        }
         if (empty($tipo) or ! isset($tipo) or $tipo == '') {

            session::getInstance()->setError(i18n::__(10044, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::TIPO_INSUMO, true), true);
        }
        if (!is_numeric($tipo)) {
            session::getInstance()->setError(i18n::__(10085, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::TIPO_INSUMO, true), true);
        }
        if ($tipo < 0) {
            session::getInstance()->setError(i18n::__(10086, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::TIPO_INSUMO, true), true);
        }
        if (empty($insumo) or ! isset($insumo) or $insumo == '') {

            session::getInstance()->setError(i18n::__(10047, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::INSUMO_ID, true), true);
        }
        if (!is_numeric($insumo)) {
            session::getInstance()->setError(i18n::__(10102, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::INSUMO_ID, true), true);
        }
        if ($insumo < 0) {
            session::getInstance()->setError(i18n::__(10103, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::INSUMO_ID, true), true);
        }
        if ($valor < 0) {
            session::getInstance()->setError(i18n::__(10080, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::VALOR_UNITARIO, true), true);
        }

        if (empty($valor) or ! isset($valor) or $valor == '') {

            session::getInstance()->setError(i18n::__(10050, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::VALOR_UNITARIO, true), true);
        }
        if (!is_numeric($valor)) {
            session::getInstance()->setError(i18n::__(10051, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::VALOR_UNITARIO, true), true);
        }
        if (empty($cantidad) or ! isset($cantidad) or $cantidad == '') {

            session::getInstance()->setError(i18n::__(10087, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::CANTIDAD, true), true);
        }
        if (!is_numeric($cantidad)) {
            session::getInstance()->setError(i18n::__(10083, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::CANTIDAD, true), true);
        }

        if ($cantidad < 0) {
            session::getInstance()->setError(i18n::__(10081, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::CANTIDAD, true), true);
        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('factura', 'indexFacturaCompra');
        }
    }
    
    

}
