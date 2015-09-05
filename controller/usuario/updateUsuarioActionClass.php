<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\config\configClass;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateUsuarioActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $ruta = configClass::getUrlBase() . 'objeto';
                $foto = $_FILES[datosUsuarioTableClass::getNameField(datosUsuarioTableClass::FOTO, true)]['tmp_name'];
                $nombreArchivo = $_FILES[datosUsuarioTableClass::getNameField(datosUsuarioTableClass::FOTO, true)]['name'];
                move_uploaded_file($foto, $ruta . "/" . $nombreArchivo);
                $ruta = $ruta . "/" . $nombreArchivo;

                $dataImg = file_get_contents($foto);

                $img = pg_escape_bytea($dataImg);
//              echo $dataImg;
//              exit();
                //usuario
                $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
                $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
                $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
                $recuperar = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true));
                $respuesta_secreta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true));



                $idUser = array(
                    usuarioTableClass::ID => $id
                );
                $data = array(
                    usuarioTableClass::USER => $usuario,
                    usuarioTableClass::PASSWORD => md5($password),
                    usuarioTableClass::RESTAURAR_ID => $recuperar,
                    usuarioTableClass::RESPUESTA_SECRETA => $respuesta_secreta
                );
                usuarioTableClass::update($idUser, $data);


                $dataUser = array(
                    usuarioTableClass::USER => $usuario,
                    usuarioTableClass::PASSWORD => md5($password),
                    usuarioTableClass::RESTAURAR_ID => $recuperar,
                    usuarioTableClass::RESPUESTA_SECRETA => $respuesta_secreta
                );



                //datos usuario
                $nombre = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NOMBRE, true));
                $apellidos = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::APELLIDOS, true));
                $tipoDocumento = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TIPO_DOC, true));
                $numeroDocumento = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NUMERO_DOCUMENTO, true));
                $direccion = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::DIRECCION, true));
                $idCiudad = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CIUDAD_ID, true));
                $telefono = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TELEFONO, true));
                $correo = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CORREO, true));

                $datosUsuario = array(
                    datosUsuarioTableClass::NOMBRE => $nombre,
                    datosUsuarioTableClass::APELLIDOS => $apellidos,
                    datosUsuarioTableClass::TIPO_DOC => $tipoDocumento,
                    datosUsuarioTableClass::NUMERO_DOCUMENTO => $numeroDocumento,
                    datosUsuarioTableClass::DIRECCION => $direccion,
                    datosUsuarioTableClass::CIUDAD_ID => $idCiudad,
                    datosUsuarioTableClass::TELEFONO => $telefono,
                    datosUsuarioTableClass::CORREO => $correo
//                    datosUsuarioTableClass::FOTO => $dataImg
                );
                $idData = array(
                    datosUsuarioTableClass::USUARIO_ID => $id
                );

//                usuarioTableClass::validatUpdate($usuario, $password);


                datosUsuarioTableClass::update($idData, $datosUsuario);
                usuarioTableClass::update($idUser, $dataUser);

                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'default'));
                log::register(i18n::__('update'), usuarioTableClass::getNameTable());
                routing::getInstance()->redirect('usuario', 'indexUsuario');
            } else {
                log::register(i18n::__('update'), usuarioTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate', null, 'default'));
                routing::getInstance()->redirect('usuario', 'indexUsuario');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}