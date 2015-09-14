<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of vacunacionTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class carneVacunasTableClass extends carneVacunasBaseTableClass {

    public static function validateCrear($veterinario, $fecha_vacunacion, $id_vacuna, $dosis, $accion) {

        $flag = false;
        $dateNow = date("Y-m-d H:m", strtotime("now"));
        
        if (empty($veterinario) or ! isset($veterinario) or $veterinario == '') {
            session::getInstance()->setError(i18n::__(10092, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VETERINARIO, true), true);
        }
        if (!is_numeric($veterinario)) {
            session::getInstance()->setError(i18n::__(10056, null, 'errors', array('%veterinario%' => $veterinario)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VETERINARIO, true), true);
        }
        if ($veterinario < 0) {
            session::getInstance()->setError(i18n::__(10094, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VETERINARIO, true), true);
        }
        if (empty($fecha_vacunacion) or ! isset($fecha_vacunacion) or $fecha_vacunacion == '') {

            session::getInstance()->setError(i18n::__(10058, null, 'errors', array('%campo%' => $fecha_vacunacion)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::FECHA_VACUNACION, true), true);
        }

        if ($fecha_vacunacion > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha_vacunacion)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::FECHA_VACUNACION, true), true);
        }
        if (empty($id_vacuna) or ! isset($id_vacuna) or $id_vacuna == '') {

            session::getInstance()->setError(i18n::__(10096, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true), true);
        }
        if (!is_numeric($id_vacuna)) {
            session::getInstance()->setError(i18n::__(10060, null, 'errors', array('%id_vacuna%' => $id_vacuna)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true), true);
        }
        if ($id_vacuna < 0) {
            session::getInstance()->setError(i18n::__(10097, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true), true);
        }
        if (empty($dosis) or ! isset($dosis) or $dosis == '') {

            session::getInstance()->setError(i18n::__(10064, null, 'errors', array('%campo%' => $dosis)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true), true);
        }
        if (!is_numeric($dosis)) {
            session::getInstance()->setError(i18n::__(10066, null, 'errors', array('%campo%' => $dosis)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true), true);
        }
        if ($dosis < 0) {
            session::getInstance()->setError(i18n::__(10098, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true), true);
        }
        if (strlen($dosis) > 10) {
            session::getInstance()->setError(i18n::__(10062, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true), true);
        }
        if (empty($accion) or ! isset($accion) or $accion == '') {

            session::getInstance()->setError(i18n::__(10065, null, 'errors', array('%campo%' => $accion)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::ACCION, true), true);
        }
        if (strlen($accion) > 50) {
            session::getInstance()->setError(i18n::__(10063, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::ACCION, true), true);
        }  



        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('animal', 'insertVacunacion');
        }
    }

    public static function validateModificar($veterinario, $vacuna, $fecha, $dosis, $accion) {

        $flag = false;
        $dateNow = date("Y-m-d H:m", strtotime("now"));
        if (empty($veterinario) or ! isset($veterinario) or $veterinario == '') {
            session::getInstance()->setError(i18n::__(10092, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VETERINARIO, true), true);
        }
        if (!is_numeric($veterinario)) {
            session::getInstance()->setError(i18n::__(10056, null, 'errors', array('%veterinario%' => $veterinario)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VETERINARIO, true), true);
        }
        if ($veterinario < 0) {
            session::getInstance()->setError(i18n::__(10094, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VETERINARIO, true), true);
        }
        if (empty($fecha) or ! isset($fecha) or $fecha == '') {

            session::getInstance()->setError(i18n::__(10058, null, 'errors', array('%campo%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::FECHA_VACUNACION, true), true);
        }

        if ($fecha > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::FECHA_VACUNACION, true), true);
        }
        if (empty($vacuna) or ! isset($vacuna) or $vacuna == '') {

            session::getInstance()->setError(i18n::__(10096, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true), true);
        }
        if (!is_numeric($vacuna)) {
            session::getInstance()->setError(i18n::__(10060, null, 'errors', array('%id_vacuna%' => $vacuna)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true), true);
        }
        if ($vacuna < 0) {
            session::getInstance()->setError(i18n::__(10097, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true), true);
        }
        if (empty($dosis) or ! isset($dosis) or $dosis == '') {

            session::getInstance()->setError(i18n::__(10064, null, 'errors', array('%campo%' => $dosis)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true), true);
        }
        if (!is_numeric($dosis)) {
            session::getInstance()->setError(i18n::__(10066, null, 'errors', array('%campo%' => $dosis)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true), true);
        }
        if ($dosis < 0) {
            session::getInstance()->setError(i18n::__(10098, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true), true);
        }
        if (strlen($dosis) > 10) {
            session::getInstance()->setError(i18n::__(10062, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true), true);
        }
        if (empty($accion) or ! isset($accion) or $accion == '') {

            session::getInstance()->setError(i18n::__(10065, null, 'errors', array('%campo%' => $accion)));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::ACCION, true), true);
        }
        if (strlen($accion) > 50) {
            session::getInstance()->setError(i18n::__(10063, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasTableClass::getNameField(carneVacunasTableClass::ACCION, true), true);
        } 
      

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('animal', 'editVacunacion');
        }
    }
    public static function validateInventario($dataBD, $dataActual) {
        $flag = false;
        if ($dataBD < $dataActual) {
            session::getInstance()->setError(i18n::__(20000, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(carneVacunasBaseTableClass::getNameField(carneVacunasBaseTableClass::DOSIS, true), true);
        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('animal', 'indexVacunacion');
        }
    }
}
