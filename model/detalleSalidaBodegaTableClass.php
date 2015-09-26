<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of detalleSalidaBodegaTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detalleSalidaBodegaTableClass extends detalleSalidaBodegaBaseTableClass {

    public static function validateCreate( $tipo_insumo, $id_insumo, $cantidad, $lote) {
        $flag = false;

 
        if (empty($tipo_insumo) or ! isset($tipo_insumo) or $tipo_insumo == '') {

            session::getInstance()->setError(i18n::__(10044, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleEntradaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::TIPO_INSUMO, true), true);
        }
        if (!is_numeric($tipo_insumo)) {
            session::getInstance()->setError(i18n::__(10085, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::TIPO_INSUMO, true), true);
        }
        if ($tipo_insumo < 0) {
            session::getInstance()->setError(i18n::__(10086, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::TIPO_INSUMO, true), true);
        }
        if (empty($lote) or ! isset($lote) or $lote == '') {

            session::getInstance()->setError(i18n::__(10138, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleEntradaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::LOTE, true), true);
        }
        if (!is_numeric($lote)) {
            session::getInstance()->setError(i18n::__(10139, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::LOTE, true), true);
        }
        if ($lote < 0) {
            session::getInstance()->setError(i18n::__(10140, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::LOTE, true), true);
        }
        if (empty($id_insumo) or ! isset($id_insumo) or $id_insumo == '') {

            session::getInstance()->setError(i18n::__(10047, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_INSUMO, true), true);
        }
        if (!is_numeric($id_insumo)) {
            session::getInstance()->setError(i18n::__(10102, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_INSUMO, true), true);
        }
        if ($id_insumo < 0) {
            session::getInstance()->setError(i18n::__(10103, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_INSUMO, true), true);
        }
        if (empty($cantidad) or ! isset($cantidad) or $cantidad == '') {

            session::getInstance()->setError(i18n::__(10104, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::CANDITDAD, true), true);
        }
        if (!is_numeric($cantidad)) {
            session::getInstance()->setError(i18n::__(10105, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::CANDITDAD, true), true);
        }
        if ($cantidad < 0) {
            session::getInstance()->setError(i18n::__(10106, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::CANDITDAD, true), true);
        }

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('bodega', 'indexSalida');
        }
    }
    public static function validateUpdate($tipo_insumo, $insumo, $cantidad) {
        $flag = false;

       
        if (empty($tipo_insumo) or ! isset($tipo_insumo) or $tipo_insumo == '') {

            session::getInstance()->setError(i18n::__(10044, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleEntradaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::TIPO_INSUMO, true), true);
        }
        if (!is_numeric($tipo_insumo)) {
            session::getInstance()->setError(i18n::__(10085, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::TIPO_INSUMO, true), true);
        }
        if ($tipo_insumo < 0) {
            session::getInstance()->setError(i18n::__(10086, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::TIPO_INSUMO, true), true);
        }
        if (empty($insumo) or ! isset($insumo) or $insumo == '') {

            session::getInstance()->setError(i18n::__(10047, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_INSUMO, true), true);
        }
        if (!is_numeric($insumo)) {
            session::getInstance()->setError(i18n::__(10102, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_INSUMO, true), true);
        }
        if ($insumo < 0) {
            session::getInstance()->setError(i18n::__(10103, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_INSUMO, true), true);
        }
        if (empty($cantidad) or ! isset($cantidad) or $cantidad == '') {

            session::getInstance()->setError(i18n::__(10104, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::CANDITDAD, true), true);
        }
        if (!is_numeric($cantidad)) {
            session::getInstance()->setError(i18n::__(10105, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::CANDITDAD, true), true);
        }
        if ($cantidad < 0) {
            session::getInstance()->setError(i18n::__(10106, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::CANDITDAD, true), true);
        }

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('bodega', 'indexSalida');
        }
    }
}
