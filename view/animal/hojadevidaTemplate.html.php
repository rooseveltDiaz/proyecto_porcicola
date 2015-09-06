
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php

use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\session\sessionClass as session ?>
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

                        <a href="#myModalFilter" data-toggle="modal" id="buscarDetalle" class="btn btn-sm btn-info active fa fa-search"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="buscarDetalle">
<?php echo i18n::__('buscar', null, 'ayuda') ?>
                        </div>
                        <a class="btn btn-sm btn-primary fa fa-reply" id="eliminarBusquedaDetalle" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteFilterHojaVida') ?>"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="eliminarBusquedaDetalle">
<?php echo i18n::__('eliBusDetalle', null, 'ayuda') ?>
                        </div>
                        <a href="#myModalReport" data-toggle="modal" id="buscarReporteDetalle" class="btn btn-primary active btn-sm fa fa-newspaper-o"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="buscarReporteDetalle">
<?php echo i18n::__('buscarReporteDet', null, 'ayuda') ?>
                        </div>

<!--<a href="<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'reportDetalleVacunacion')            ?>" class="btn btn-info btn-xs" ><?php echo i18n::__('report') ?></a>-->       


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
                <!--                      <a id="eliminarDetalle<?php echo $countDetale ?>" href="#myModalDelete<?php echo $key->id ?>" class="btn btn-sm btn-default fa fa-ban" ></a>
                                    <div class="mdl-tooltip mdl-tooltip--large" for="eliminarDetalle<?php echo $countDetale ?>">
        <?php echo i18n::__('inhabilitarDetalle', null, 'ayuda') ?>
                                    </div>  -->
                                </td>
    <?php endif; ?>
                            </td>
                            <tr>
                                <th>


                                    <!-- WINDOWS MODAL UPDATE DETAIL VACCINATION -->

                            <div class="modalmask" id="detailFormEdit<?php echo $key->id ?>">
                                <div class="modalbox rotate">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('editDetailVaccination', null, 'detalleVacunacion') ?>:</h4>
                                    <form id="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'updateDetalleVacunacion') ?>">
                                        <a href="#close" title="Close" class="close">X</a>
                                        <div class="modal-body">
                                            <input type="hidden" value="<?php echo request::getInstance()->getServer('PATH_INFO') ?>" name="PATH_INFO">
                                            <input type="hidden" value="<?php echo $key->$idDetalle ?>" id="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>">
                                            <input type="hidden" id="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID, true) ?>" value="<?php echo $key->id ?>" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID, true) ?>">
    <?php echo i18n::__('fecha', null, 'detalleVacunacion') ?>
                                            <input type="datetime-local" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true) ?>">
                                            <br/>         
    <?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?>
                                            <select name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true) ?>">
                                                <option value="">...</option>
                                                <?php foreach ($objVacuna as $key): ?>
                                                    <option value="<?php echo $key->id ?>"><?php echo $key->nombre_vacuna ?></option>
    <?php endforeach; //close foreach    ?>
                                            </select>
                                            <br/>
    <?php echo i18n::__('dosis', null, 'detalleVacunacion') ?>
                                            <input type="text" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true) ?>">
                                            <br/>  
                                            <?php if (!isset($objDetalleVacunacion)): ?>
        <?php echo i18n::__('accion') ?>
                                                <select name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true) ?>">
                                                    <option>...</option>
                                                    <option><?php echo i18n::__('enfermedad') ?></option>
                                                    <option><?php echo i18n::__('gestacion') ?></option>
                                                    <option><?php echo i18n::__('parto') ?></option>
                                                    <option><?php echo i18n::__('rutina') ?></option>
                                                    <option><?php echo i18n::__('nacido') ?></option>
                                                </select>
    <?php endif; ?>
                                            <br/>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#close2" title="Close" type="button" class="btn btn-default close2" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></a>
                                            <input type="submit" class="btn btn-primary" value=<?php echo i18n::__('edit', null, 'user') ?>> 
                                        </div>

                                </div>
                            </div>

                            <!-- WINDOWS MODAL DELETE -->
                            <div class="modalmask" id="myModalDelete<?php echo $key->id ?>">
                                <div class="modalbox rotate">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete') ?></h4>
                                    </div>
                                    <a href="#close" title="Close" class="close">X</a>
                                    <div class="modal-body">
    <?php echo i18n::__('eliminarIndividual') ?>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o" ><?php echo i18n::__('cancel') ?></a>
                                        <button type="button" id="delete" name="delete" class="btn btn-primary fa fa-ban" onclick="eliminar(<?php echo $key->id ?>, '<?php echo detalleVacunacionBaseTableClass::getNameField(detalleVacunacionTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteDetalleVacunacion') ?>')"><?php echo i18n::__('delete') ?></button>
                                    </div>
                                </div>
                            </div>
                    </div>      
                    </th>
                    </tr>
                    <?php $countDetale++ ?>         
<?php endforeach//close foreach    ?>
                </tbody>
                </table>
        </div>
        </form>
    </div>
</div>
                             
</main>
<!-- WINDOWS MODAL DELETE MASIVE -->
<div class="modalmask" id="myModalEliminarMasivo">
    <div class="modalbox rotate">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('borrar seleccion') ?></h4>
        </div>
        <a href="#close" title="Close" class="close">X</a>
        <div class="modal-body">

<?php echo i18n::__('confirmDeleteMasive') ?>
        </div>
        <div class="modal-footer">
            <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('close', null, 'vacunacion') ?></a>
            <button type="button" class="btn btn-primary fa fa-ban" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
        </div>
    </div>
</div>
</div>

<a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>"></a>
<div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
<?php echo i18n::__('atras', null, 'ayuda') ?>
</div> 




<!-- WINDOWS MODAL FILTER -->
<div class="modalmask" id="myModalFilter">
    <div class="modalbox rotate">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
        </div>
        <a href="#close" title="Close" class="close">X</a>
        <div class="modal-body">
            <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexHojaVida') ?>">
                <input type="hidden" name="<?php echo hojaVidaTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(hojaVidaTableClass::ID) ?>">
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo i18n::__('fechaIni', null, 'detalleVacunacion') ?></th>
                        <th>
                            <input name="filter[fecha_inicial]" type="date">
                        </th>
                    </tr>
                    <tr>
                        <th><?php echo i18n::__('fechaFin', null, 'detalleVacunacion') ?></th>
                        <th>
                            <input name="filter[fecha_final]" type="date">
                        </th>
                    </tr>
<!--                    <tr>

                        <th><?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></th>
                        <th>
                            <select name="filter[vacuna]">
                                <option value="">
                                    ...
                                </option>
                    <?php foreach ($objVacuna as $key): ?>
                                                    <option value="<?php echo $key->id ?>">
                        <?php echo $key->nombre_vacuna ?>
                                                    </option>
<?php endforeach; //close foreach    ?>
                            </select>
                        </th>
                    </tr>-->
                    <tr>
                        <th><?php echo i18n::__('dosis', null, 'detalleVacunacion') ?></th>
                        <th>
                            <input name="filter[dosis]" type="text">
                        </th>
                    </tr>
                    <tr>
                        <th><?php echo i18n::__('accion') ?></th>
                        <th>
                            <select name="filter[accion]">
                                <option>...</option>
                                <option><?php echo i18n::__('enfermedad') ?></option>
                                <option><?php echo i18n::__('gestacion') ?></option>
                                <option><?php echo i18n::__('parto') ?></option>
                                <option><?php echo i18n::__('rutina') ?></option>
                                <option><?php echo i18n::__('nacido') ?></option>
                            </select>
                        </th>
                    </tr>
                </table>

            </form>
        </div>
        <div class="modal-footer">
            <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o close2"  ><?php echo i18n::__('close', null, 'vacunacion') ?></a>
            <button type="button" class="btn btn-info fa fa-search" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
        </div>

    </div>
</div>


<!-- WINDOWS MODAL REPORT -->
<div class="modalmask" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modalbox rotate">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
        </div>
        <a href="#close" title="Close" class="close">X</a>
        <div class="modal-body">
            <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'reportDetalleVacunacion') ?>">
                <input type="hidden" name="<?php echo hojaVidaTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(hojaVidaTableClass::ID) ?>">
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></th>
                        <th>
                            <input name="filter[fecha]" type="datetime-local">
                        </th>
                    </tr>
<!--                    <tr>

                        <th><?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></th>
                        <th>
                            <select name="filter[vacuna]">
                                <option value="">
                                    ...
                                </option>
                    <?php foreach ($objVacuna as $key): ?>
                                                    <option value="<?php echo $key->id ?>">
                        <?php echo $key->nombre_vacuna ?>
                                                    </option>
<?php endforeach; //close foreach    ?>
                            </select>
                        </th>
                    </tr>-->
                    <tr>
                        <th><?php echo i18n::__('dosis', null, 'detalleVacunacion') ?></th>
                        <th>
                            <input name="filter[dosis]" type="text">
                        </th>
                    </tr>
                    <tr>
                        <th><?php echo i18n::__('accion') ?></th>
                        <th>
                            <select name="filter[accion]">
                                <option value=''>...</option>
                                <option value=""><?php echo i18n::__('enfermedad') ?></option>
                                <option value=""><?php echo i18n::__('gestacion') ?></option>
                                <option value=""><?php echo i18n::__('parto') ?></option>
                                <option value=""><?php echo i18n::__('rutina') ?></option>
                                <option value=""><?php echo i18n::__('nacido') ?></option>
                            </select>
                        </th>
                    </tr>
                </table>

            </form>
        </div>
        <div class="modal-footer">
            <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o close2"  ><?php echo i18n::__('close', null, 'vacunacion') ?></a>
            <button type="button" class="btn btn-info fa fa-search" onclick="$('#reportForm').submit()"><?php echo i18n::__('buscar') ?></button>
        </div>

    </div>
</div>
