<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

/**
 * Description of insumoTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insumoTableClass extends insumoBaseTableClass {

    public static function validateCreate($nombre, $fabricacion, $vencimiento, $tipo_insumo, $valor, $cantidad, $stock) {
        $flag = false;

        $dateNow = date("Y-m-d", strtotime("now"));
        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $patternC = "^[a-zA-Z0-9]{3,20}$";
       $patternCs = "^[a-zA-Z0-9[:space:]]*$";

        if ($cantidad < 0) {
            session::getInstance()->setError(i18n::__(10081, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::CANTIDAD, true), true);
        }

        if (ereg($patternC, $valor) == false) {
            session::getInstance()->setError(i18n::__(10053, null, 'errors', array('%campo%' => $valor)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }

//        if (ereg($patternC, $cantidad) == false) {
//            session::getInstance()->setError(i18n::__(10089, null, 'errors', array('%campo%' => $cantidad)));
//            $flag = true;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::CANTIDAD, true), true);
//        }
//        
//          if (ereg($patternC, $stock) == false) {
//            session::getInstance()->setError(i18n::__(10090, null, 'errors', array('%campo%' => $stock)));
//            $flag = true;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::STOCK_MINIMO, true), true);
//        }

        if (ereg($patternCs, $nombre) == false) {
            session::getInstance()->setError(i18n::__(10048, null, 'errors', array('%campo%' => $nombre)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }

        if ($valor < 0) {
            session::getInstance()->setError(i18n::__(10080, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }

        if (empty($valor) or ! isset($valor) or $valor == '') {

            session::getInstance()->setError(i18n::__(10050, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }

        if (empty($cantidad) or ! isset($cantidad) or $cantidad == '') {

            session::getInstance()->setError(i18n::__(10087, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::CANTIDAD, true), true);
        }

        if (empty($stock) or ! isset($stock) or $stock == '') {

            session::getInstance()->setError(i18n::__(10088, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::STOCK_MINIMO, true), true);
        }

        if ($stock < 0) {
            session::getInstance()->setError(i18n::__(10082, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::STOCK_MINIMO, true), true);
        }

        if (!is_numeric($valor)) {
            session::getInstance()->setError(i18n::__(10051, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }
        if (!is_numeric($cantidad)) {
            session::getInstance()->setError(i18n::__(10083, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::CANTIDAD, true), true);
        }
        if (!is_numeric($stock)) {
            session::getInstance()->setError(i18n::__(10084, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::STOCK_MINIMO, true), true);
        }

//        $fieldsTipoInsumo = array(
//            tipoInsumoTableClass::ID
//        );
//        $objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo);
//        foreach ($objTipoInsumo as $key => $value) {
//            foreach ($value as $key) {
//                if ($key != $tipo_insumo) {
//                    session::getInstance()->setError(i18n::__(10054, null, 'errors'));
//                    $flag = true;
//                }
//            }
//        }


        if (empty($tipo_insumo) or ! isset($tipo_insumo) or $tipo_insumo == '') {
            session::getInstance()->setError(i18n::__(10044, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }

        if ($tipo_insumo < 0) {
            session::getInstance()->setError(i18n::__(10086, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }

        if (!is_numeric($tipo_insumo)) {
            session::getInstance()->setError(i18n::__(10085, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }

        if (empty($nombre) or ! isset($nombre) or $nombre == '') {
            session::getInstance()->setError(i18n::__(10047, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }
        if (strlen($nombre) > 50) {
            session::getInstance()->setError(i18n::__(10049, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }
        if (preg_match($pattern, $vencimiento) == false) {
            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $vencimiento)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
        }
        if (preg_match($pattern, $fabricacion) == false) {
            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fabricacion)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
        }

        if ($fabricacion > $dateNow) {
            session::getInstance()->setError(i18n::__(10021, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true), true);
        }
        if ($vencimiento < $dateNow) {
            session::getInstance()->setError(i18n::__(10020, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
        }

        if (empty($fabricacion) or ! isset($fabricacion) or $fabricacion == '') {

            session::getInstance()->setError(i18n::__(10041, null, 'errors', array('%campo%' => $fabricacion)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true), true);
        }

        if (empty($vencimiento) or ! isset($vencimiento) or $vencimiento == '') {

            session::getInstance()->setError(i18n::__(10042, null, 'errors', array('%campo%' => $vencimiento)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
        }

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('insumo', 'insert');
        }
    }

    public static function validateEdit($tipo_insumo, $nombre, $fabricacion, $vencimiento, $valor) {
        $flag = false;

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $dateNow = date("Y-m-d", strtotime("now"));
        $patternC = "^[a-zA-Z0-9]{3,20}$";
        $patternCs = "^[a-zA-Z0-9[:space:]]*$";

        if (empty($tipo_insumo) or ! isset($tipo_insumo) or $tipo_insumo == '') {
            session::getInstance()->setError(i18n::__(10044, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }

        if ($tipo_insumo < 0) {
            session::getInstance()->setError(i18n::__(10086, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }

        if (!is_numeric($tipo_insumo)) {
            session::getInstance()->setError(i18n::__(10085, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }

        if (empty($nombre) or ! isset($nombre) or $nombre == '') {

            session::getInstance()->setError(i18n::__(10047, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }
        if (strlen($nombre) > 50) {
            session::getInstance()->setError(i18n::__(10049, null, 'errors', array('%campo%' => $nombre)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }

        if (ereg($patternCs, $nombre) == false) {
            session::getInstance()->setError(i18n::__(10048, null, 'errors', array('%campo%' => $nombre)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }

        if (empty($fabricacion) or ! isset($fabricacion) or $fabricacion == '') {

            session::getInstance()->setError(i18n::__(10041, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true), true);
        }

        if (empty($vencimiento) or ! isset($vencimiento) or $vencimiento == '') {

            session::getInstance()->setError(i18n::__(10042, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
        }

        if ($vencimiento < $dateNow) {
            session::getInstance()->setError(i18n::__(10020, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
        }
        if ($fabricacion > $dateNow) {
            session::getInstance()->setError(i18n::__(10021, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true), true);
        }
        if (preg_match($pattern, $fabricacion) == false) {
            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fabricacion)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true), true);
        }
        if (preg_match($pattern, $vencimiento) == false) {
            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $vencimiento)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
        }

        if (empty($valor) or ! isset($valor) or $valor == '') {

            session::getInstance()->setError(i18n::__(10050, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }

        if (!is_numeric($valor)) {
            session::getInstance()->setError(i18n::__(10051, null, 'errors', array('%campo%' => $valor)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoBaseTableClass::VALOR, true), true);
        }

        if ($valor < 0) {
            session::getInstance()->setError(i18n::__(10080, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }

        if (ereg($patternC, $valor) == false) {
            session::getInstance()->setError(i18n::__(10053, null, 'errors', array('%campo%' => $valor)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }

//        $fieldsTipoInsumo = array(
//            tipoInsumoTableClass::ID
//        );
//
//        $objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo);
//
//        foreach ($objTipoInsumo as $key => $value) {
//            foreach ($value as $key) {
//                if ($key != $id_tipo_insumo) {
//                    session::getInstance()->setError(i18n::__(10054, null, 'errors'));
//                    $flag = true;
//                }
//            }
//        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
//           request::getInstance()->addParamGet(array('id' => $id));
            routing::getInstance()->forward('insumo', 'edit');
        }
    }

}
