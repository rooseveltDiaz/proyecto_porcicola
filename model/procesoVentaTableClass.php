<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of procesoVentaTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class procesoVentaTableClass extends procesoVentaBaseTableClass {

    public static function validateCreate($fecha, $empleado, $cliente, $animal, $peso, $valor) {

        $flag = false;

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/";

        $dateNow = date("Y-m-d H:m", strtotime("now"));
        if (empty($fecha) or ! isset($fecha) or $fecha == '') {

            session::getInstance()->setError(i18n::__(10055, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::FECHA_HORA_VENTA, true), true);
        }
        if ($fecha > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaBaseTableClass::getNameField(procesoVentaBaseTableClass::FECHA_HORA_VENTA, true), true);
        }

        if (ereg($pattern, $fecha)) {
            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaBaseTableClass::getNameField(procesoVentaBaseTableClass::FECHA_HORA_VENTA, true), true);
        }

        if (empty($empleado) or ! isset($empleado) or $empleado == '') {

            session::getInstance()->setError(i18n::__(10099, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::EMPLEADO_ID, true), true);
        }
        if (!is_numeric($empleado)) {
            session::getInstance()->setError(i18n::__(10100, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::EMPLEADO_ID, true), true);
        }
        if ($empleado < 0) {
            session::getInstance()->setError(i18n::__(10101, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::EMPLEADO_ID, true), true);
        }

        if (empty($cliente) or ! isset($cliente) or $cliente == '') {

            session::getInstance()->setError(i18n::__(10113, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::CLIENTE_ID, true), true);
        }
        if (!is_numeric($cliente)) {
            session::getInstance()->setError(i18n::__(10114, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::CLIENTE_ID, true), true);
        }
        if ($cliente < 0) {
            session::getInstance()->setError(i18n::__(10115, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::CLIENTE_ID, true), true);
        }
        if (empty($animal) or ! isset($animal) or $animal == '') {

            session::getInstance()->setError(i18n::__(10093, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClassgetNameField(procesoVentaTableClass::ANIMAL, true), true);
        }
        if (!is_numeric($animal)) {
            session::getInstance()->setError(i18n::__(10057, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::ANIMAL, true), true);
        }
        if ($animal < 0) {
            session::getInstance()->setError(i18n::__(10095, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::ANIMAL, true), true);
        }
        if ($valor < 0) {
            session::getInstance()->setError(i18n::__(10116, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::VALOR, true), true);
        }

        if (empty($valor) or ! isset($valor) or $valor == '') {

            session::getInstance()->setError(i18n::__(10117, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::VALOR, true), true);
        }
        if (!is_numeric($valor)) {
            session::getInstance()->setError(i18n::__(10118, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::VALOR, true), true);
        }
        if ($peso < 0) {
            session::getInstance()->setError(i18n::__(10136, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::PESO, true), true);
        }

        if (empty($peso) or ! isset($peso) or $peso == '') {

            session::getInstance()->setError(i18n::__(10134, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::PESO, true), true);
        }
        if (!is_numeric($peso)) {
            session::getInstance()->setError(i18n::__(10135, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(procesoVentaTableClass::getNameField(procesoVentaTableClass::PESO, true), true);
        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('factura', 'insertFacturaVenta');
        }
    }
  
    public function validateInventario($objAnimal)
            {
        $flag= false;
        
    }
}

