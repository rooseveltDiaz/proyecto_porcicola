<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\config\configClass as config ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $id = usuarioCredencialTableClass::ID ?>
<?php //$usuario_id = usuarioCredencialTableClass::USUARIO_ID  ?>
<?php //$credencial = usuarioCredencialTableClass::CREDENCIAL_ID  ?>
<?php $usuario_id = usuarioTableClass::USER ?>
<?php $credencial = credencialTableClass::NOMBRE ?>
<?php $countDetale = 1 ?>
<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 text-center">
                    <h2>
<?php echo i18n::__('read', NULL, 'userCredencial') ?>
                    </h2>
                </div>
            </div>
            <form id="frmDeleteAll" action="<?php // echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'deleteSelect')  ?>" method="POST">
                <div class="row">
                    <div class="col-xs-4-offset-4 text-center">
                        <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'insertUsuCredencial') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="new">
<?php echo i18n::__('registrar', null, 'ayuda') ?>
                        </div>


                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="success">
                       
                                <th><?php echo i18n::__('aliasUsuario') ?></th>
                                <th><?php echo i18n::__('credencial', null, 'credencial') ?></th>
                                <th><?php echo i18n::__('action') ?> </th>
                            </tr>
                        </thead>
                        <tbody>
<?php foreach ($objUsuCrede as $key): ?>
                                <tr>
                               
                                    <td><?php echo $key->$usuario_id ?></td>
                                    <td><?php echo $key->$credencial ?></td>
                                    <td>
                                        <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'editUsuCredencial', array(usuarioCredencialTableClass::ID => usuarioCredencialTableClass::ID)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">edit</i></a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                                <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                        </div> 

                                    </td>
                                </tr>
    <?php $countDetale++ ?>
<?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </form>
            <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'deleteUsuCredencial') ?>" method="POST">
                <input type="hidden" id="idDelete" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>">
            </form>
            <!--    paginado-->
            <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
                        <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexUsuCredencial') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                        <?php $count = 0 ?>
<?php for ($x = 1; $x <= $cntPages; $x++): ?>
                            <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexUsuCredencial') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
    <?php $count ++ ?>        
<?php endfor ?>
                        <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexUsuCredencial') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>

