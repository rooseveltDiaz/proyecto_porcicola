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

    public static function validateCrear($id_veterinario, $fecha_registro, $id_animal) {

        $flag = false;

//        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/";
//$p = "/^( (19[20] ? [0-9]{2}) [\/|-] (0?(1-9) | [1][012]) [\/|-] (0?(1-9) | [12](0-9) | 3(01))  )";
        /*
         *
         */
        $dateNow = date("Y-m-d H:m", strtotime("now"));

        /**
         * @ 
         */
        if ($fecha_registro > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha_registro)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true), true);
        }

        if (empty($fecha_registro) or ! isset($fecha_registro) or $fecha_registro == '') {

            session::getInstance()->setError(i18n::__(10055, null, 'errors', array('%campo%' => $fecha_registro)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true), true);
        }
        if (preg_match($pattern, $fecha_registro)) {
            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fecha_registro)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true), true);
        }

        if (!is_numeric($id_veterinario)) {
            session::getInstance()->setError(i18n::__(10056, null, 'errors', array('%id_veterinario%' => $id_veterinario)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true), true);
        }
        if (!is_numeric($id_animal)) {
            session::getInstance()->setError(i18n::__(10057, null, 'errors', array('%id_animal%' => $id_animal)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true), true);
        }
        if (empty($id_veterinario) or ! isset($id_veterinario) or $id_veterinario == '') {

            session::getInstance()->setError(i18n::__(10092, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true), true);
        }
        if (empty($id_animal) or ! isset($id_animal) or $id_animal == '') {

            session::getInstance()->setError(i18n::__(10093, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true), true);
        }

        if ($id_veterinario < 0) {
            session::getInstance()->setError(i18n::__(10094, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true), true);
        }
        if ($id_animal < 0) {
            session::getInstance()->setError(i18n::__(10095, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true), true);
        }


//        $fieldsAnimal = array(
//            animalTableClass::ID
//        );
//    $fieldsVeterinario = array(
//      veterinarioTableClass::ID
//    );
//        $objAnimal = animalTableClass::getAll($fieldsAnimal);
//    $objVeterinario = veterinarioTableClass::getAll($fieldsVeterinario);
//        foreach ($objAnimal as $key => $value) {
//            foreach ($value as $key) {
//                if ($key != $id_animal) {
//                    session::getInstance()->setError(i18n::__(10030, null, 'errors'));
//                    $flag = true;
//                }
//            }
//        }
//    foreach ($objVeterinario as $key => $value) {
//      foreach ($value as $key) {
//        if ($key != $id_veterinario) {
//          session::getInstance()->setError(i18n::__(10031, null, 'errors'));
//          $flag = true;
//        }
//      }
//    }


        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('animal', 'insertVacunacion');
        }
    }

    public static function validateModificar($id_animal, $id_veterinario, $fecha_registro) {

        $flag = false;

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

        $dateNow = date("Y-m-d H:m", strtotime("now"));
//    if (preg_match($pattern, $fecha_registro) == false) {
//      session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fecha_registro)));
//      $flag = true;
//      session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true), true);
//    }
//
//    if ($fecha_registro > $dateNow) {
//      session::getInstance()->setError(i18n::__(10010, null, 'errors'));
//      $flag = true;
//      session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true), true);
//    }
//    if (!is_numeric($id_veterinario)) {
//      session::getInstance()->setError(i18n::__(10056, null, 'errors', array('%id_veterinario%' => $id_veterinario)));
//      $flag = true;
//      session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true), true);
//    }
//    if (!is_numeric($id_animal)) {
//      session::getInstance()->setError(i18n::__(10057, null, 'errors', array('%id_animal%' => $id_animal)));
//      $flag = true;
//      session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true), true);
//    }
        if ($fecha_registro > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha_registro)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true), true);
        }

        if (preg_match($pattern, $fecha_registro)) {
            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fecha_registro)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true), true);
        }

        if (empty($fecha_registro) or ! isset($fecha_registro) or $fecha_registro == '') {

            session::getInstance()->setError(i18n::__(10055, null, 'errors', array('%campo%' => $fecha_registro)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true), true);
        }

        if (!is_numeric($id_veterinario)) {
            session::getInstance()->setError(i18n::__(10056, null, 'errors', array('%id_veterinario%' => $id_veterinario)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true), true);
        }
        if (!is_numeric($id_animal)) {
            session::getInstance()->setError(i18n::__(10057, null, 'errors', array('%id_animal%' => $id_animal)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true), true);
        }
        if (empty($id_veterinario) or ! isset($id_veterinario) or $id_veterinario == '') {

            session::getInstance()->setError(i18n::__(10092, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true), true);
        }
        if (empty($id_animal) or ! isset($id_animal) or $id_animal == '') {

            session::getInstance()->setError(i18n::__(10093, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true), true);
        }

        if ($id_veterinario < 0) {
            session::getInstance()->setError(i18n::__(10094, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true), true);
        }
        if ($id_animal < 0) {
            session::getInstance()->setError(i18n::__(10095, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true), true);
        }


//      $fieldsVeterinario = array(
//      veterinarioTableClass::ID
//    );
//            
//     $objVeterinario = veterinarioTableClass::getAll($fieldsVeterinario);
//     
//       foreach ($objVeterinario as $key => $value) {
//      foreach ($value as $key) {
//        if ($key != $id_veterinario) {
//          session::getInstance()->setError(i18n::__(10031, null, 'errors'));
//          $flag = true;
//        }
//      }
//    }

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('animal', 'updateVacunacion');
        }
    }

}
