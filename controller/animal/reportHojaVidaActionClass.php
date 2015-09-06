<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of reportProveedorActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportHojaVidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (request::getInstance()->hasRequest('reportHojaVida')) {
                $report = request::getInstance()->getPost('reportHojaVida');
            }
            $fields = array(
            hojaVidaTableClass::ANIMAL,
            hojaVidaTableClass::FECHA_NACIMIENTO,
            hojaVidaTableClass::GENERO_ID,
            hojaVidaTableClass::ID,
            hojaVidaTableClass::NUMERO,
            hojaVidaTableClass::PARTO,
            hojaVidaTableClass::PESO,
            hojaVidaTableClass::RAZA
            );
            $fields1 = array (
            animalTableClass::NUMERO
            );
            $fields2 = array(
            generoTableClass::NOMBRE
            );
            $fields3 = array(
            razaTableClass::NOMBRE_RAZA
            );

            $fJoin1 = hojaVidaTableClass::ANIMAL;
            $fJoin2 = animalTableClass::ID;
            $fJoin3 = hojaVidaTableClass::GENERO_ID;
            $fJoin4 = generoTableClass::ID;
            $fJoin5 = hojaVidaTableClass::RAZA;
            $fJoin6 = razaTableClass::ID;


            $orderBy = array(
            hojaVidaTableClass::ID
            );

            $this->objHojaVida = hojaVidaTableClass::getAllJoin($fields, $fields1, $fields2, $fields3, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, $orderBy, 'ASC', $where);
            $this->mensaje = 'HOJA DE VIDA DEL CERDO';
            $this->defineView('hojadevida', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
