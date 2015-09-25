<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;

/**
 * Description of createFacturaVentaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createFacturaVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fecha = request::getInstance()->getPost(procesoVentaTableClass::getNameField(procesoVentaTableClass::FECHA_HORA_VENTA, true));
            $empleado = request::getInstance()->getPost(procesoVentaTableClass::getNameField(procesoVentaTableClass::EMPLEADO_ID, true));
            $cliente = request::getInstance()->getPost(procesoVentaTableClass::getNameField(procesoVentaTableClass::CLIENTE_ID, true));
            $animal = request::getInstance()->getPost(procesoVentaTableClass::getNameField(procesoVentaTableClass::ANIMAL, true));
            $peso = request::getInstance()->getPost(procesoVentaTableClass::getNameField(procesoVentaTableClass::PESO, true));
            $valor = request::getInstance()->getPost(procesoVentaTableClass::getNameField(procesoVentaTableClass::VALOR, true));
            $subtotal = $peso * $valor;
            procesoVentaTableClass::validateCreate($fecha, $empleado, $cliente, $animal, $peso, $valor);
            
            $data = array(
                procesoVentaTableClass::CLIENTE_ID => $cliente,
                procesoVentaTableClass::EMPLEADO_ID => $empleado,
                procesoVentaTableClass::FECHA_HORA_VENTA => $fecha,
                procesoVentaTableClass::ANIMAL => $animal,
                procesoVentaTableClass::PESO => $peso,
                procesoVentaTableClass::VALOR => $valor,
                procesoVentaTableClass::SUBTOTAL => $subtotal
            );

            //Manejo de inventario
                $fieldsAnimal = array(
                    animalTableClass::NUMERO,
                    animalTableClass::ID
                );
                $whereInventario = array(
                    animalTableClass::ID => $animal
                );
                $objAnimal = animalTableClass::getAll($fieldsAnimal, true, null, null, null, null, $whereInventario);
           
        procesoVentaTableClass::validateInventario($objAnimal[0]->id);

                $fieldsAnimalDelete = array(
                    animalTableClass::ID => $objAnimal[0]->id
                );
                animalTableClass::delete($fieldsAnimalDelete, true);

            procesoVentaTableClass::insert($data);
            session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'facturaVenta'));
            log::register(i18n::__('create'), procesoVentaTableClass::getNameTable());
            routing::getInstance()->redirect('factura', 'indexFacturaVenta');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
