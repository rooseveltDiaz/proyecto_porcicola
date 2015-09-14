<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

/**
 * Description of registroPesoTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class registroPesoTableClass extends registroPesoBaseTableClass {
     public static function validateCreate($fecha, $empleado, $valor_kilo, $valor_total, $peso) {
       
         $flag = false;
         $dateNow = date("Y-m-d H:m", strtotime("now"));      
        
         if (empty($fecha) or ! isset($fecha) or $fecha == '') {

            session::getInstance()->setError(i18n::__(10055, null, 'errors', array('%campo%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::FECHA, true), true);
        }

        if ($fecha > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::FECHA, true), true);
        }
        if (empty($empleado) or ! isset($empleado) or $empleado == '') {
            session::getInstance()->setError(i18n::__(10099, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::EMPLEADO, true), true);
        }
        if (!is_numeric($empleado)) {
            session::getInstance()->setError(i18n::__(10100, null, 'errors', array('%campo%' => $empleado)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::EMPLEADO, true), true);
        }
        if ($empleado < 0) {
            session::getInstance()->setError(i18n::__(10101, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::EMPLEADO, true), true);
        }
        if (empty($valor_kilo) or ! isset($valor_kilo) or $valor_kilo == '') {

            session::getInstance()->setError(i18n::__(10126, null, 'errors', array('%campo%' => $valor_kilo)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true), true);
        }
        if (!is_numeric($valor_kilo)) {
            session::getInstance()->setError(i18n::__(10127, null, 'errors', array('%campo%' => $valor_kilo)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true), true);
        }
        if ($valor_kilo < 0) {
            session::getInstance()->setError(i18n::__(10128, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true), true);
        }
        if (strlen($valor_kilo) > 6) {
            session::getInstance()->setError(i18n::__(10129, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true), true);
        } 
        if (empty($valor_total) or ! isset($valor_total) or $valor_total == '') {

            session::getInstance()->setError(i18n::__(10130, null, 'errors', array('%campo%' => $valor_total)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::VALOR, true), true);
        }
        if (!is_numeric($valor_total)) {
            session::getInstance()->setError(i18n::__(10131, null, 'errors', array('%campo%' => $valor_total)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::VALOR, true), true);
        }
        if ($valor_total < 0) {
            session::getInstance()->setError(i18n::__(10132, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::VALOR, true), true);
        }
        if (strlen($valor_total) > 10) {
            session::getInstance()->setError(i18n::__(10133, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::VALOR, true), true);
        } 
        if (empty($peso) or ! isset($peso) or $peso == '') {

            session::getInstance()->setError(i18n::__(10134, null, 'errors', array('%campo%' => $peso)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true), true);
        }
        if (!is_numeric($peso)) {
            session::getInstance()->setError(i18n::__(10135, null, 'errors', array('%campo%' => $peso)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true), true);
        }
        if ($peso < 0) {
            session::getInstance()->setError(i18n::__(10136, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true), true);
        }
        if (strlen($peso) > 4) {
            session::getInstance()->setError(i18n::__(10137, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true), true);
        } 
        
         if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('animal', 'insertRegistroPeso');
        }
    }

     public static function validateModificar($fecha, $empleado, $valor_kilo, $valor_total, $peso) {
       
         $flag = false;
         $dateNow = date("Y-m-d H:m", strtotime("now"));      
        
         if (empty($fecha) or ! isset($fecha) or $fecha == '') {

            session::getInstance()->setError(i18n::__(10055, null, 'errors', array('%campo%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::FECHA, true), true);
        }

        if ($fecha > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::FECHA, true), true);
        }
        if (empty($empleado) or ! isset($empleado) or $empleado == '') {
            session::getInstance()->setError(i18n::__(10099, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::EMPLEADO, true), true);
        }
        if (!is_numeric($empleado)) {
            session::getInstance()->setError(i18n::__(10100, null, 'errors', array('%campo%' => $empleado)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::EMPLEADO, true), true);
        }
        if ($empleado < 0) {
            session::getInstance()->setError(i18n::__(10101, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::EMPLEADO, true), true);
        }
        if (empty($valor_kilo) or ! isset($valor_kilo) or $valor_kilo == '') {

            session::getInstance()->setError(i18n::__(10126, null, 'errors', array('%campo%' => $valor_kilo)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true), true);
        }
        if (!is_numeric($valor_kilo)) {
            session::getInstance()->setError(i18n::__(10127, null, 'errors', array('%campo%' => $valor_kilo)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true), true);
        }
        if ($valor_kilo < 0) {
            session::getInstance()->setError(i18n::__(10128, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true), true);
        }
        if (strlen($valor_kilo) > 6) {
            session::getInstance()->setError(i18n::__(10129, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true), true);
        } 
        if (empty($valor_total) or ! isset($valor_total) or $valor_total == '') {

            session::getInstance()->setError(i18n::__(10130, null, 'errors', array('%campo%' => $valor_total)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::VALOR, true), true);
        }
        if (!is_numeric($valor_total)) {
            session::getInstance()->setError(i18n::__(10131, null, 'errors', array('%campo%' => $valor_total)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::VALOR, true), true);
        }
        if ($valor_total < 0) {
            session::getInstance()->setError(i18n::__(10132, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::VALOR, true), true);
        }
        if (strlen($valor_total) > 10) {
            session::getInstance()->setError(i18n::__(10133, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::VALOR, true), true);
        } 
        if (empty($peso) or ! isset($peso) or $peso == '') {

            session::getInstance()->setError(i18n::__(10134, null, 'errors', array('%campo%' => $peso)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true), true);
        }
        if (!is_numeric($peso)) {
            session::getInstance()->setError(i18n::__(10135, null, 'errors', array('%campo%' => $peso)));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true), true);
        }
        if ($peso < 0) {
            session::getInstance()->setError(i18n::__(10136, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true), true);
        }
        if (strlen($peso) > 4) {
            session::getInstance()->setError(i18n::__(10137, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true), true);
        } 
        
         if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('animal', 'editRegistroPeso');
        }
    }
}
