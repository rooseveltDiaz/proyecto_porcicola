<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>

<?php $id = hojaVidaTableClass::ID ?>
<?php $idAnimal = hojaVidaTableClass::ID ?>
<?php $fecha = hojaVidaTableClass::FECHA_NACIMIENTO ?>
<?php $genero = generoTableClass::NOMBRE ?>
<?php $raza_id = razaTableClass::NOMBRE_RAZA ?>
<?php $parto = hojaVidaTableClass::PARTO ?>
<?php $peso = hojaVidaTableClass::PESO ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 text-center">
                    <h2>

<?php echo i18n::__('hv', NULL, 'animal') ?>
                    </h2>

                </div>
            </div>
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelectAnimal') ?>" method="POST">
                <div class="row">
                    <div class="col-xs-12 text-center">

                        <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
<?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
                       <a id="reporte" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportHojaVida') ?>" class="btn btn-primary active btn-sm fa fa-download" ></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
                        <?php echo i18n::__('reporte', null, 'ayuda') ?>
                    </div>
                    </div>
                </div>
                <br/>
                <br/>
                <?php view::includeHandlerMessage() ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="success">
                                <td>  <?php echo i18n::__('identificacion') ?>:</td></tr>
                            <tr>    <td>  <?php echo i18n::__('date_birth', NULL, 'animal') ?>:</td></tr>
                            <tr>     <td>  <?php echo i18n::__('genero', null, 'animal') ?>:</td></tr>
                            <tr>   <td>  <?php echo i18n::__('parto', NULL, 'animal') ?>:
                                </td>  
                            </tr>
                            <tr>   <td>  <?php echo i18n::__('raza') ?>:</td></tr>
                            <tr>      <td> <?php echo i18n::__('peso', NULL, 'animal') ?>:</td></tr>
                            <tr>   <td>  <?php echo i18n::__('lote', NULL, 'animal') ?>:
                                </td>  
                            </tr>
                            <tr><td>
                                    <div class="col-xs-12 text-center">
                                        <a id="gestacion<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexGestacion') ?>" class="btn btn-lg glyphicon glyphicon-calendar " > </a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="gestacion<?php echo $countDetale ?>">
<?php echo i18n::__('gestacion', null, 'dpVenta') ?>
                                        </div> 
                                        <a id="parto<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroParto') ?>" class="btn btn-lg glyphicon glyphicon-list-alt" > </a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="parto<?php echo $countDetale ?>">
<?php echo i18n::__('parto', null, 'dpVenta') ?>
                                        </div> 
                                        <a id="peso<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroPeso') ?>" class="btn btn-lg glyphicon glyphicon-file" > </a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="peso<?php echo $countDetale ?>">
<?php echo i18n::__('repeso', null, 'dpVenta') ?>
                                        </div> 
                                        <a id="vacunacion<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'viewVacunacion') ?>" class="btn btn-lg fa fa-medkit" > </a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="vacunacion<?php echo $countDetale ?>">
<?php echo i18n::__('vacu', null, 'dpVenta') ?>
                                        </div> 
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
<?php foreach ($objHojaVida as $key): ?>
                        <td>
                        <td><?php echo $key->$idAnimal ?></td>
                        <td>  <?php echo $key->$fecha ?></td>
                        <td>  <?php echo $key->$genero ?></td>
                        <td>  <?php echo $key->$raza ?></td>
                        <td> <?php echo $key->$peso ?></td>
                        <td> <?php echo $key->$parto ?></td>

<?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                        <td>
                            <a id="editarDetalle<?php echo $countDetale ?>" href="#detailFormEdit<?php echo $key->id ?>" class="btn btn-default active btn-sm fa fa-edit" ></a>
                            <div class="mdl-tooltip mdl-tooltip--large" for="editarDetalle<?php echo $countDetale ?>">
<?php echo i18n::__('editDetalle', null, 'ayuda') ?>
                            </div>  
                        </td>
<?php endif; ?>

                        <tr>
                            <th>
                            </th>
                        </tr>
                           <?php $countDetale++ ?>
                    <?php endforeach//close foreach   ?>

                        </tbody>
                    </table>

                </div>
            </form>
        </div>
    </div>
</main>

