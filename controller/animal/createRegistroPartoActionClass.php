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
 * Description of createRegistroPartoActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $fecha = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::FECHA_NACIMIENTO, true));
                $hembras = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS, true));
                $machos = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::MACHOS_NACIDOS_VIVOS, true));
                $muertos = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::NACIDOS_MUERTOS, true));
//                $raza = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::RAZA_ID, true));
                $animal_id = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::ANIMAL_ID, true));

//                $caracteres = validator::getInstance()->validatorCharactersSpecial($nombre);
//
//                if ($caracteres == true) {
//                    throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
//                }
//                loteTableClass::validatCreate($nombre);

                $fieldsAnimal = array(
                    animalTableClass::ID,
                    animalTableClass::PARTO,
                    animalTableClass::GENERO_ID,
                    animalTableClass::NUMERO
                );
                $whereAnimal = array(
                    animalTableClass::ID => $animal_id,
                );

                $objAnimal = animalTableClass::getAll($fieldsAnimal, true, null, null, null, null, $whereAnimal);
                $flag = false;


                if ($objAnimal[0]->numero_parto > 5) {
                    session::getInstance()->setError("El cerdo ha exedido los partos");
                    $flag = true;
                    session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, true), true);
                }
                if ($flag == true) {
                    request::getInstance()->setMethod('GET');
                    routing::getInstance()->forward('animal', 'insertRegistroParto');
                }
                               
                $partosAnimal = $objAnimal[0]->numero_parto + 1;
                $idAnimalInventario = array(animalTableClass::ID => $animal_id);
                $dataAnimal = array(animalTableClass::PARTO => $partosAnimal);
                animalTableClass::update($idAnimalInventario, $dataAnimal);

                $data = array(
                    registroPartoTableClass::FECHA_NACIMIENTO => $fecha,
                    registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS => $hembras,
                    registroPartoTableClass::MACHOS_NACIDOS_VIVOS => $machos,
                    registroPartoTableClass::NACIDOS_MUERTOS => $muertos,
//                    registroPartoTableClass::RAZA_ID => $raza,
                    registroPartoTableClass::ANIMAL_ID => $animal_id,
                );

                registroPartoTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'parto'));
                log::register(i18n::__('create'), registroPartoTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexRegistroParto');
            } else {
                log::register(i18n::__('create'), registroPartoTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate'));
                routing::getInstance()->redirect('animal', 'indexRegistroParto');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
