<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of consultarActionClass
 *
 * @author Roosevelt Diaz Tapias <rdiaz02@misena.edu.co>
 */
class consultarActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $flag = false;
//            if (request::getInstance()->hasRequest(usuarioTableClass::USER)) {
            $user = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
            $pregunta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true));
            $respuesta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true));

            $where = array(
                usuarioTableClass::USER => $user
            );
            $fields = array(
                usuarioTableClass::ID,
                usuarioTableClass::USER,
                usuarioTableClass::RESTAURAR_ID,
                usuarioTableClass::RESPUESTA_SECRETA
            );
            $objUsuario = usuarioTableClass::getAll($fields, true, null, null, null, null, $where);
            $preguntaUser = $objUsuario[0]->recuperar_id;
            $respuestaUser = $objUsuario[0]->respuesta_secreta;
//            $usuario = $objUsuario[0]->user_name;
//           if (empty($objUsuario) or ! isset($objUsuario) or $objUsuario == ''){
//                session::getInstance()->setError('El Usuario esta vacio');
//                $flag = true;
//            }
//            print_r($objUsuario);
//            exit();
            if(Empty($objUsuario) and empty($pregunta) and empty($respuesta) ){
                         session::getInstance()->setError('El formulario no se puede enviar vacio');
                $flag = true;
            }else
            if (Empty($objUsuario)) {
                session::getInstance()->setError('Usuario incorrecto');
                $flag = true;
            }
//           if (empty($pregunta) or ! isset($pregunta) or $pregunta == ''){
//                session::getInstance()->setError('No ha seleccionado la pregunta');
//                $flag = true;
//            }
            if ($pregunta != $preguntaUser) {
                session::getInstance()->setError('Pregunta incorrecta');
                $flag = true;
            }
//           if (empty($respuesta) or ! isset($respuesta) or $respuesta == ''){
//                session::getInstance()->setError('No ha ingresado la respuesta');
//                $flag = true;
//            }
            if ($respuesta != $respuestaUser) {
                session::getInstance()->setError('la respuesta esta  incorrecta');
                $flag = true;
            }
            if ($flag == true) {
                request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('recuperar', 'index');
            }

            $id = $objUsuario[0]->id;
            $fieldsUsuario = array(
                usuarioTableClass::ID,
                usuarioTableClass::USER,
                usuarioTableClass::PASSWORD
            );
            $whereUsuario = array(
                usuarioTableClass::ID => $id
            );

            $fieldsRecuperar = array(
                recuperarTableClass::ID,
                recuperarTableClass::PREGUNTA_SECRETA
            );



            $this->objRecuperar = recuperarTableClass::getAll($fieldsRecuperar, false);
            $this->objUsuario = usuarioTableClass::getAll($fieldsUsuario, true, null, null, null, null, $whereUsuario);
            $this->defineView('select', 'recuperar', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
