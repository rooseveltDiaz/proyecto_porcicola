<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $idUsuario = usuarioBaseTableClass::ID ?>
<?php $password = usuarioBaseTableClass::PASSWORD ?>
<?php $usuario = usuarioBaseTableClass::USER ?>
<?php $idPregunta = recuperarTableClass::ID ?>
<?php $pregunta = recuperarTableClass::PREGUNTA_SECRETA ?>
<?php $id = datosUsuarioTableClass::ID ?>
<?php $nombre = datosUsuarioTableClass::NOMBRE ?>
<?php $apellidos = datosUsuarioTableClass::APELLIDOS ?>
<?php $numeroDocumento = datosUsuarioTableClass::NUMERO_DOCUMENTO ?>
<?php $tipoDocumento = datosUsuarioTableClass::TIPO_DOC ?>
<?php $direccion = datosUsuarioTableClass::DIRECCION ?>
<?php $telefono = datosUsuarioTableClass::TELEFONO ?>
<?php $user = usuarioTableClass::USER ?>
<?php $nom_ciudad = ciudadTableClass::NOMBRE ?>
<?php $descripcionTipoDoc = tipoDocumentoUsuarioTableClass::DESCRIPCION ?>
<?php $idTipoDoc = tipoDocumentoUsuarioTableClass::ID ?>
<?php $correo = datosUsuarioTableClass::CORREO ?> 
<form enctype="multipart/form-data" method="post" action="<?php echo routing::getInstance()->getUrlWeb('usuario', ((isset($objUsuario) == TRUE) ? 'updateUsuario' : 'createUsuario')) ?>">
    <?php if (isset($objUsuario)): ?>
        <input type="hidden" name="<?php echo usuarioTableClass::getNameField(usuarioBaseTableClass::ID, TRUE) ?>" value="<?php echo $objUsuario[0]->$idUsuario ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">
                <div class="table-responsive">
                <table class="table">    
                    <tr>
                        <th>  <?php echo i18n::__('aliasUsuario') ?>:</th>
                        <th> <input   placeholder="<?php echo ((isset($objUsuario) == FALSE) ? i18n::__('aliasUsuario') : $objUsuario[0]->user_name = ucwords($objUsuario[0]->user_name)) ?>" type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" ></th>   
                    </tr>

                    <tr>
                        <th>
                            <?php echo i18n::__(((isset($objUsuario) == FALSE) ? 'pass' : 'oldPass'), NULL, 'user') ?>:</th>
                        <th><input  maxlength="20" min="3" type="password" placeholder="<?php echo i18n::__(((isset($objUsuario) == TRUE) ? 'oldPass' : 'pass'), NULL, 'user') ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>"></th>
                    </tr>
                    <?php if (isset($objRecuperar)): ?>
                        <tr>
                            <th>
                                <?php echo i18n::__('rePass', null, 'user') ?>
                            </th>
                            <th>
                                <input  maxlength="20" min="3"type="password" placeholder="<?php echo i18n::__('rePass', NULL, 'user') ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::SECOND_PASSWORD, true) ?>">              
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('quest', null, 'user') ?>
                            </th>
                            <th>
                                <select name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true) ?>">
                                    <option value="">...</option>                 
                                    <?php foreach ($objRecuperar as $key): ?>

                                        <option value="<?php echo $key->$idPregunta ?>">
                                            <?php echo $key->$pregunta ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('answer', null, 'user') ?>
                            </th>
                            <th>
                                <input  pattern="^[A-Za-z0-9]{1,20}$" maxlength="20"  title="No se puede usar caracteres especiales" type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true) ?>" placeholder="<?php echo i18n::__('answer', null, 'user') ?>">   
                            </th>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th>
                            <?php echo i18n::__('tipoDoc', null, 'datos') ?>:
                        </th>
                        <th>
                            <select name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TIPO_DOC, true) ?>">
                                <option value="">...</option>
                                <?php foreach ($objTipoDoc as $key): ?>

                                    <option value="<?php echo $key->$idTipoDoc ?>">
                                        <?php echo $key->$descripcionTipoDoc ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('numberDoc', null, 'datos') ?>:
                        </th>
                        <th>
                            <input placeholder="<?php echo i18n::__('numberDoc', null, 'datos') ?>" type="number"  min="0" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NUMERO_DOCUMENTO, true) ?>"> 
                        </th>
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('name', NULL, 'datos') ?>:</th>
                        <th> <input  pattern="^[A-Za-z0-9]{1,20}$" maxlength="20"  title="No se puede usar caracteres especiales" type="text" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NOMBRE, true) ?>" placeholder="<?php echo i18n::__('name', null, 'datos') ?>">
                        </th>   
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('lastName', null, 'datos') ?>:
                        </th>
                        <th>
                            <input  pattern="^[A-Za-z0-9]{1,20}$" maxlength="20"  title="No se puede usar caracteres especiales" type="text" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::APELLIDOS, true) ?>"placeholder="<?php echo i18n::__('lastName', null, 'datos') ?>">
                        </th>                        
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('tel', null, 'datos') ?>:
                        </th>
                        <th>
                            <input placeholder="<?php echo i18n::__('tel', null, 'datos') ?>" type="number"  min="0" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TELEFONO, true) ?>"> 
                        </th>                        
                    </tr>

                    <tr>
                        <th>
                            <?php echo i18n::__('dir', null, 'datos') ?>:
                        </th>
                        <th>
                            <input placeholder="<?php echo ((isset($objDatos) == false) ? i18n::__('dir', null, 'datos') : $objDatos[0]->$direccion = ucwords($objDatos[0]->$direccion)) ?>" type="text" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::DIRECCION, true) ?>">
                        </th>                        
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('city', null, 'city') ?>:
                        </th>
                        <th>
                            <select name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CIUDAD_ID, true) ?>">
                                <option value="">...</option>
                                <?php foreach ($objCiudad as $key): ?>

                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->$nom_ciudad ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('correo', null, 'user') ?>:
                        </th>
                        <th>
                            <input placeholder="<?php echo i18n::__('correo', null, 'user') ?>" type="text"  min="0" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CORREO, true) ?>"> 
                        </th>                        
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('foto', null, 'user') ?>: 
                        </th>
                        <th>
                            <input type="file" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::FOTO, true) ?>">
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="text-center">
                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objUsuario) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
             <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexUsuario') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
</form>
</div>
</main>