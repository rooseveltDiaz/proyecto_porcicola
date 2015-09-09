<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = datosUsuarioTableClass::ID ?>
<?php $nombre = datosUsuarioTableClass::NOMBRE ?>
<?php $apellidos = datosUsuarioTableClass::APELLIDOS ?>
<?php $tipoDocumento = tipoDocumentoUsuarioTableClass::DESCRIPCION ?>
<?php $numeroDocumento = datosUsuarioTableClass::NUMERO_DOCUMENTO ?>
<?php $direccion = datosUsuarioTableClass::DIRECCION ?>
<?php $telefono = datosUsuarioTableClass::TELEFONO ?>
<?php $user = usuarioTableClass::USER ?>
<?php $nom_ciudad = ciudadTableClass::NOMBRE ?>
<?php $correo = datosUsuarioTableClass::CORREO ?> 
<!--<?php $countDetale = 1 ?>-->
<main class="mdl-layout__content mdl-color--blue-100">
  <div class="mdl-grid demo-content">
    <div class="container container-fluid">
        <div class="row">
            <div class="col-xs-4-offset-4 text-center">
                <h2>
                    <?php echo i18n::__('read', NULL, 'datos') ?>
                </h2>
            </div>
        </div>
        <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('dataUser', 'deleteSelect') ?>" method="POST">
            <div class="row">
                <div class="col-xs-4-offset-4 nuevo">
    <!--                <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('dataUser', 'insert') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="new">
                    <?php echo i18n::__('registrar', null, 'ayuda') ?>
                    </div>
                    <a id="deleteMasa" href="#" class="btn btn-default btn-sm fa fa-trash-o" onclick="borrarSeleccion()"></a>
                     <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
                    <?php echo i18n::__('eliminarMasa', null, 'ayuda') ?>
                    </div>-->
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="success">
                        <th><?php echo i18n::__('aliasUsuario') ?></th>
                        <?php foreach ($objDatos as $key): ?>
                        <th><?php echo $key->$user ?></th>
                        </tr>
                        <?php endforeach; ?>
                   
                        <tr> 
                        <th><?php echo i18n::__('name', null, 'veterinario') ?></th>
                         <?php foreach ($objDatos as $key): ?>
                        <th><?php echo $key->$nombre ?></th>
                        </tr>
                        <?php endforeach; ?>
                        <tr>  
                        <th><?php echo i18n::__('lastName', null, 'datos') ?></th>
                        <?php foreach ($objDatos as $key): ?>
                        <th><?php echo $key->$apellidos ?></th>
                        </tr>
                        <?php endforeach; ?>
                        <tr>  
                        <th><?php echo i18n::__('tipoDoc', null, 'datos') ?></th>
                         <?php foreach ($objDatos as $key): ?>
                        <th><?php echo $key->$tipoDocumento ?></th>
                        </tr>
                        <?php endforeach; ?>
                        <tr>   
                        <th><?php echo i18n::__('numberDoc', null, 'datos') ?></th>
                        <?php foreach ($objDatos as $key): ?>
                        <th><?php echo $key->$numeroDocumento ?></th>
                        </tr>
                        <?php endforeach; ?>
                        <tr>  
                        <th><?php echo i18n::__('tel', null, 'datos') ?></th>
                         <?php foreach ($objDatos as $key): ?>
                        <th><?php echo $key->$telefono ?></th>
                        </tr>
                        <?php endforeach; ?>
                        <tr>  
                        <th><?php echo i18n::__('correo', null, 'user') ?></th>
                         <?php foreach ($objDatos as $key): ?>
                        <th><?php echo $key->$correo ?></th>
                        </tr>
                        <?php endforeach; ?>
                        <tr> 
                        <th><?php echo i18n::__('dir', null, 'datos') ?></th>
                         <?php foreach ($objDatos as $key): ?>
                        <th><?php echo $key->$direccion ?></th>
                        </tr>
                        <?php endforeach; ?>
                        <tr>   
                        <th><?php echo i18n::__('city') ?></th>
                         <?php foreach ($objDatos as $key): ?>
                        <th><?php echo $key->$nom_ciudad ?></th>
                        </tr>
                        <?php endforeach; ?>
                        </thead>
                     <!--                        <td>
                                    <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('dataUser', 'edit', array(datosUsuarioBaseTableClass::ID => $key->$id)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored"><i class="material-icons">edit</i></a>
                                    <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                                <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                          </div> 
                                    <a id="eliminar<?php echo $countDetale ?>" href="#" onclick="confirmarEliminar(<?php echo $key->$id ?>)" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored"><i class="material-icons">delete</i></a>
                                     <div class="mdl-tooltip mdl-tooltip--large" for="eliminar<?php echo $countDetale ?>">
                                <?php echo i18n::__('eliminar', null, 'ayuda') ?>
                                          </div> 
                                </td>-->
                        
                           
                   
                  
                </table>
            </div>
        </form>
        <!--    paginado-->
        <!--     <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
        <?php $count = 0 ?>
        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                                <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('dataUser', 'index') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
            <?php $count ++ ?>        
        <?php endfor; ?>
         <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('dataUser', 'index') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div>-->

        <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('dataUser', 'delete') ?>" method="POST">
            <input type="hidden" id="idDelete" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::ID, true) ?>">
        </form>

    </div>

  </div>
         <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexUsuario') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
</main>