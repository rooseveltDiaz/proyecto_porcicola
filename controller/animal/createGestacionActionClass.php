<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of createGestacionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createGestacionActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        // DATOS DE ANIMAL
        $fecha = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::FECHA, true));
        $empleado = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::EMPLEADO, true));
        $animal = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::ANIMAL, true));
        $fecha_monta = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::FECHA_MONTA, true));
        $fecha_parto = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::FECHA_PROBABLE_PARTO, true));
        $fecundador = request::getInstance()->getPost(gestacionTableClass::getNameField(gestacionTableClass::ANIMAL_FECUNDADOR, true));
        //validar si los campos estan vacios
        $datos = array(
          $fecha,
          $empleado,
          $animal,
          $fecha_monta,
          $fecha_parto,
          $fecundador
          
        );
        gestacionTableClass::validate($fecha, $fecha_monta, $fecha_parto);

   
        //Insertar la informacion del usuario
        $data = array(
          gestacionTableClass::FECHA => $fecha,
          gestacionTableClass::EMPLEADO => $empleado,
          gestacionTableClass::ANIMAL => $animal,
          gestacionTableClass::FECHA_MONTA => $fecha_monta,
          gestacionTableClass::FECHA_PROBABLE_PARTO => $fecha_parto,
          gestacionTableClass::ANIMAL_FECUNDADOR => $fecundador
        );
        gestacionTableClass::insert($data);
        session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'gestacion'));
        log::register(i18n::__('create'), animalTableClass::getNameTable());
        routing::getInstance()->redirect('animal', 'indexGestacion', array(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL) => $animal));
      } else {
        log::register(i18n::__('create'), animalTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
        session::getInstance()->setError(i18n::__('errorCreate', null, 'animal'));
        routing::getInstance()->redirect('animal', 'indexGestacion');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
