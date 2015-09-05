<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of salidaBodegaTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class salidaBodegaTableClass extends salidaBodegaBaseTableClass {

    public static function validateCreate($fecha, $empleado) {
        $flag = false;
        $dateNow = date("Y-m-d", strtotime("now"));

        if (empty($fecha) or ! isset($fecha) or $fecha == '') {

            session::getInstance()->setError(i18n::__(10055, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true), true);
        }
        if ($fecha > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true), true);
        }
        if (empty($empleado) or ! isset($empleado) or $empleado == '') {

            session::getInstance()->setError(i18n::__(10099, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO, true), true);
        }
        if (!is_numeric($empleado)) {
            session::getInstance()->setError(i18n::__(10100, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO, true), true);
        }
        if ($empleado < 0) {
            session::getInstance()->setError(i18n::__(10101, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO, true), true);
        }

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('bodega', 'insertSalida');
        }
    }
    
     public static function validateUpdate($fecha, $empleado) {
        $flag = false;
        $dateNow = date("Y-m-d", strtotime("now"));

        if (empty($fecha) or ! isset($fecha) or $fecha == '') {

            session::getInstance()->setError(i18n::__(10055, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true), true);
        }
        if ($fecha > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true), true);
        }
        if (empty($empleado) or ! isset($empleado) or $empleado == '') {

            session::getInstance()->setError(i18n::__(10099, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO, true), true);
        }
        if (!is_numeric($empleado)) {
            session::getInstance()->setError(i18n::__(10100, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO, true), true);
        }
        if ($empleado < 0) {
            session::getInstance()->setError(i18n::__(10101, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO, true), true);
        }

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('bodega', 'updateSalida');
        }
    }

}
