<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of reportRegistroPartoActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
//           

            $fields = array(
                registroPartoTableClass::ID,
                registroPartoTableClass::FECHA_NACIMIENTO,
                registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS,
                registroPartoTableClass::MACHOS_NACIDOS_VIVOS,
                registroPartoTableClass::NACIDOS_MUERTOS,
//                registroPartoTableClass::RAZA_ID,
//                registroPartoTableClass::ANIMAL_ID
            );

             $fields2 = array (          
                 animalTableClass::NUMERO
           );
//            $fields3 = array (          
//                razaTableClass::NOMBRE_RAZA
//           );
            $fJoin1 = registroPartoTableClass::ANIMAL_ID;
            $fJoin2 = animalTableClass::ID;
//            $fJoin3 = registroPartoTableClass::RAZA_ID;
//            $fJoin4 = razaTableClass::ID;
           
           

            $orderBy = array(
                registroPartoTableClass::ID
            );
//            $this->objEmpleado = empleadoTableClass::getAll($fields2, false);
            $this->objParto = registroPartoTableClass::getAllJoin($fields, $fields2, null,null, $fJoin1, $fJoin2, null, null, null, null, false, $orderBy, 'ASC', null,null,$where);
            $this->mensaje = 'Informe Registros Parto en Nuestro Sistema';         
            $this->defineView('index', 'registroParto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}