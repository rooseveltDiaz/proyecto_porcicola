<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of procesoCompraTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class procesoCompraTableClass extends procesoCompraBaseTableClass {

    public static function validateCreate($fecha, $empleado, $proveedor, $numero) {

        $flag = false;

//        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/";

        $dateNow = date("Y-m-d H:m", strtotime("now"));
        if (empty($fecha) or ! isset($fecha) or $fecha == '') {

            session::getInstance()->setError(i18n::__(10055, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::FECHA_HORA_COMPRA, true), true);
        }
        if ($fecha > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraBaseTableClass::getNameField(procesoCompraBaseTableClass::FECHA_HORA_COMPRA, true), true);
        }
                if (empty($numero) or ! isset($numero) or $numero == '') {

            session::getInstance()->setError(i18n::__(10119, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::NUMERO, true), true);
        }
                if (!is_numeric($numero)) {
            session::getInstance()->setError(i18n::__(10120, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::NUMERO, true), true);
        }
        if ($numero < 0) {
            session::getInstance()->setError(i18n::__(10121, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::NUMERO, true), true);
        }

//        if (ereg($pattern, $fecha)) {
//            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fecha)));
//            $flag = true;
//            session::getInstance()->setFlash(procesoCompraBaseTableClass::getNameField(procesoCompraBaseTableClass::FECHA_HORA_COMPRA, true), true);
//        }

        if (empty($empleado) or ! isset($empleado) or $empleado == '') {

            session::getInstance()->setError(i18n::__(10099, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true), true);
        }
        if (!is_numeric($empleado)) {
            session::getInstance()->setError(i18n::__(10100, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true), true);
        }
        if ($empleado < 0) {
            session::getInstance()->setError(i18n::__(10101, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true), true);
        }

        if (empty($proveedor) or ! isset($proveedor) or $proveedor == '') {

            session::getInstance()->setError(i18n::__(10110, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true), true);
        }
        if (!is_numeric($proveedor)) {
            session::getInstance()->setError(i18n::__(10111, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true), true);
        }
        if ($proveedor < 0) {
            session::getInstance()->setError(i18n::__(10112, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true), true);
        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('factura', 'insertFacturaCompra');
        }
    }

//    public static function validateUpdate($fecha, $empleado, $proveedor) {
//
//        $flag = false;
//
//        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/";
//
//        $dateNow = date("Y-m-d H:m", strtotime("now"));
//        if (empty($fecha) or ! isset($fecha) or $fecha == '') {
//
//            session::getInstance()->setError(i18n::__(10055, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::FECHA_HORA_COMPRA, true), true);
//        }
//        if ($fecha > $dateNow) {
//            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha)));
//            $flag = true;
//            session::getInstance()->setFlash(procesoCompraBaseTableClass::getNameField(procesoCompraBaseTableClass::FECHA_HORA_COMPRA, true), true);
//        }
//
//        if (ereg($pattern, $fecha)) {
//            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fecha)));
//            $flag = true;
//            session::getInstance()->setFlash(procesoCompraBaseTableClass::getNameField(procesoCompraBaseTableClass::FECHA_HORA_COMPRA, true), true);
//        }
//
//        if (empty($empleado) or ! isset($empleado) or $empleado == '') {
//
//            session::getInstance()->setError(i18n::__(10099, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true), true);
//        }
//        if (!is_numeric($empleado)) {
//            session::getInstance()->setError(i18n::__(10100, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true), true);
//        }
//        if ($empleado < 0) {
//            session::getInstance()->setError(i18n::__(10101, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true), true);
//        }
//
//        if (empty($proveedor) or ! isset($proveedor) or $proveedor == '') {
//
//            session::getInstance()->setError(i18n::__(10110, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true), true);
//        }
//        if (!is_numeric($proveedor)) {
//            session::getInstance()->setError(i18n::__(10111, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true), true);
//        }
//        if ($proveedor < 0) {
//            session::getInstance()->setError(i18n::__(10112, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true), true);
//        }
//        if ($flag == true) {
//            request::getInstance()->setMethod('GET');
//            routing::getInstance()->forward('factura', 'updateFacturaCompra');
//        }
//    }

}
