<?php

use mvc\model\modelClass as model;
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of detalleVacunacionTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detalleVacunacionTableClass extends detalleVacunacionBaseTableClass {

    public static function validate($fecha_vacunacion, $dosis_vacuna, $accion, $id_vacuna) {

        $flag = false;
        $dateNow = date("Y-m-d H:m", strtotime("now"));


        if (empty($fecha_vacunacion) or ! isset($fecha_vacunacion) or $fecha_vacunacion == '') {

            session::getInstance()->setError(i18n::__(10058, null, 'errors', array('%campo%' => $fecha_vacunacion)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true), true);
        }

        if ($fecha_vacunacion > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha_vacunacion)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true), true);
        }
        if (empty($id_vacuna) or ! isset($id_vacuna) or $id_vacuna == '') {

            session::getInstance()->setError(i18n::__(10096, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true), true);
        }
        if (!is_numeric($id_vacuna)) {
            session::getInstance()->setError(i18n::__(10060, null, 'errors', array('%id_vacuna%' => $id_vacuna)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true), true);
        }
        if ($id_vacuna < 0) {
            session::getInstance()->setError(i18n::__(10097, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true), true);
        }
        if (empty($dosis_vacuna) or ! isset($dosis_vacuna) or $dosis_vacuna == '') {

            session::getInstance()->setError(i18n::__(10064, null, 'errors', array('%campo%' => $dosis_vacuna)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
        }
        if (!is_numeric($dosis_vacuna)) {
            session::getInstance()->setError(i18n::__(10066, null, 'errors', array('%id_vacuna%' => $dosis_vacuna)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
        }
        if ($dosis_vacuna < 0) {
            session::getInstance()->setError(i18n::__(10098, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
        }
        if (strlen($dosis_vacuna) > 10) {
            session::getInstance()->setError(i18n::__(10062, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
        }
        if (empty($accion) or ! isset($accion) or $accion == '') {

            session::getInstance()->setError(i18n::__(10065, null, 'errors', array('%campo%' => $accion)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true), true);
        }
        if (strlen($accion) > 50) {
            session::getInstance()->setError(i18n::__(10063, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true), true);
        }
//    $fieldsVacuna = array(
//    vacunaTableClass::ID
//    );
//        
// $objVacuna = vacunaTableClass::getAll($fieldsVacuna);
// 
//     foreach ($objVacuna as $key => $value) {
//      foreach ($value as $key) {
//        if ($key != $id_vacuna) {
//          session::getInstance()->setError(i18n::__(10061, null, 'errors'));
//          $flag = true;
//        }
//      }
//    }
//    $fieldsRegistro = array(
//    vacunacionTableClass::ID
//    );
//        
// $objRegistro = detalleVacunacionTableClass::getAll($fieldsRegistro);
// 
//     foreach ($objRegistro as $key => $value) {
//      foreach ($value as $key) {
//        if ($key != $id_registro) {
//          session::getInstance()->setError(i18n::__(10070, null, 'errors'));
//          $flag = true;
//        }
//      }
//    }
//if (ereg($patternC, $dosis_vacuna) == false) {
//            session::getInstance()->setError(i18n::__(10067, null, 'errors', array('%campo%' => $dosis_vacuna)));
//            $flag = true;
//            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
//        }
//        
//if (ereg($patternC, $accion) == false) {
//            session::getInstance()->setError(i18n::__(10068, null, 'errors', array('%campo%' => $accion)));
//            $flag = true;
//            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true), true);
//        }



        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('vacunacion', 'indexVacunacion');
        }
    }

    public static function validateUpdate($fecha_vacunacion, $id_vacuna, $dosis_vacuna) {

        $flag = false;
        $dateNow = date("Y-m-d H:m", strtotime("now"));
//        $patternC = "^[a-zA-Z0-9]{3,20}$";


        if (empty($fecha_vacunacion) or ! isset($fecha_vacunacion) or $fecha_vacunacion == '') {

            session::getInstance()->setError(i18n::__(10058, null, 'errors', array('%campo%' => $fecha_vacunacion)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true), true);
        }
        if ($fecha_vacunacion > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha_vacunacion)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true), true);
        }
        if (empty($id_vacuna) or ! isset($id_vacuna) or $id_vacuna == '') {

            session::getInstance()->setError(i18n::__(10096, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true), true);
        }
        if (!is_numeric($id_vacuna)) {
            session::getInstance()->setError(i18n::__(10060, null, 'errors', array('%id_vacuna%' => $id_vacuna)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true), true);
        }
        if ($id_vacuna < 0) {
            session::getInstance()->setError(i18n::__(10097, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true), true);
        }
        if (empty($dosis_vacuna) or ! isset($dosis_vacuna) or $dosis_vacuna == '') {

            session::getInstance()->setError(i18n::__(10064, null, 'errors', array('%campo%' => $dosis_vacuna)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
        }
        if (!is_numeric($dosis_vacuna)) {
            session::getInstance()->setError(i18n::__(10066, null, 'errors', array('%id_vacuna%' => $dosis_vacuna)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
        }
        if ($dosis_vacuna < 0) {
            session::getInstance()->setError(i18n::__(10098, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
        }
        if (strlen($dosis_vacuna) > 10) {
            session::getInstance()->setError(i18n::__(10015, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
        }
//    $fieldsVacuna = array(
//    vacunaTableClass::ID
//    );
//        
// $objVacuna = vacunaTableClass::getAll($fieldsVacuna);
// 
//     foreach ($objVacuna as $key => $value) {
//      foreach ($value as $key) {
//        if ($key != $id_vacuna) {
//          session::getInstance()->setError(i18n::__(10061, null, 'errors'));
//          $flag = true;
//        }
//      }
//    }
//    
//    $fieldsDetalle = array(
//    detalleVacunacionTableClass::ID
//    );
//        
// $objDetalle = detalleVacunacionTableClass::getAll($fieldsDetalle);
// 
//     foreach ($objDetalle as $key => $value) {
//      foreach ($value as $key) {
//        if ($key != $id_detalle) {
//          session::getInstance()->setError(i18n::__(10069, null, 'errors'));
//          $flag = true;
//        }
//      }
//    }
//    $fieldsRegistro = array(
//    vacunacionTableClass::ID
//    );
//        
// $objRegistro = detalleVacunacionTableClass::getAll($fieldsRegistro);
// 
//     foreach ($objRegistro as $key => $value) {
//      foreach ($value as $key) {
//        if ($key != $id_registro) {
//          session::getInstance()->setError(i18n::__(10070, null, 'errors'));
//          $flag = true;
//        }
//      }
//    }
//if (ereg($patternC, $dosis_vacuna) == false) {
//            session::getInstance()->setError(i18n::__(10067, null, 'errors', array('%campo%' => $dosis_vacuna)));
//            $flag = true;
//            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
//        }

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('vacunacion', 'indexVacunacion');
        }
    }

    public static function validateInventario($dataBD, $dataActual) {
        $flag = false;
        if ($dataBD < $dataActual) {
            session::getInstance()->setError(i18n::__(20000, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('vacunacion', 'indexVacunacion');
        }
    }

}
