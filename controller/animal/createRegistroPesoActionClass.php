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
class createRegistroPesoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        // DATOS DE ANIMAL
        $fecha = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::FECHA, true));
        $empleado = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::EMPLEADO, true));
        $animal = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::ANIMAL, true));
//        $valor_kilo = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true));
//        $valor_total = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::VALOR, true));
        $peso = request::getInstance()->getPost(registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true));
//       $valor_total = $peso * $valor_kilo;
         
       registroPesoTableClass::validateCreate($fecha, $empleado,  $peso);
       
       $datos = array(
          $fecha,
          $empleado,
          $animal,
//          $valor_kilo,
//         $valor_total,
          $peso
          
        );
      

   
        $data = array(
            registroPesoTableClass::FECHA => $fecha,
            registroPesoTableClass::EMPLEADO => $empleado,
            registroPesoTableClass::ANIMAL => $animal,
            registroPesoTableClass::KILO => 3000,
//           registroPesoTableClass::VALOR => $valor_total,
            registroPesoTableClass::PESO => $peso
        );
        registroPesoTableClass::insert($data);
        
        $fields = array(
        hojaVidaTableClass::ANIMAL,
        hojaVidaTableClass::FECHA_NACIMIENTO,
        hojaVidaTableClass::GENERO_ID,
        hojaVidaTableClass::NUMERO,
        hojaVidaTableClass::PARTO,
        hojaVidaTableClass::PESO,
        hojaVidaTableClass::RAZA
        );
        $where = array(
        hojaVidaTableClass::ID => $animal
        );
        
        $daticos = hojaVidaTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
        // se pasa los datos del ID animal para Actualizar la hoja de vida
        $data = array(
//        hojaVidaTableClass::FECHA_NACIMIENTO => $daticos[hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO,true)],
//        hojaVidaTableClass::GENERO_ID => $daticos[hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO_ID,true)],
//        hojaVidaTableClass::NUMERO => $daticos[hojaVidaTableClass::getNameField(hojaVidaTableClass::NUMERO, true)],
//        hojaVidaTableClass::PARTO => $daticos[hojaVidaTableClass::getNameField(hojaVidaTableClass::PARTO,true)],
//        hojaVidaTableClass::RAZA => $daticos[hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA, true)],
        hojaVidaTableClass::PESO=> $peso
        );
        $ids = array(
        hojaVidaTableClass::ID =>$animal
        );
        hojaVidaTableClass::update($ids, $data);
        //FIN 
        
        session::getInstance()->setSuccess(i18n::__('succesCreate1', null, 'dpVenta'));
        log::register(i18n::__('create'), registroPesoTableClass::getNameTable());
        routing::getInstance()->redirect('animal', 'indexRegistroPeso', array(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL) => $animal));
      } else {
        log::register(i18n::__('create'), registroPesoTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
        session::getInstance()->setError(i18n::__('errorCreate1', null, 'dpVenta'));
        routing::getInstance()->redirect('animal', 'indexRegistroPeso');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
