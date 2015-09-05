<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\view\viewClass as view ?>

<?php $idAnimal = animalTableClass::ID ?>
<?php $numeroIdenficacion = animalTableClass::NUMERO ?>
<?php $lote = loteTableClass::NOMBRE ?>


<?php $countDetale = 1 ?>
<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 text-center">
                    <h2>
                        <?php echo i18n::__('read', NULL, 'animal') ?>
                    </h2>
                </div>
            </div>
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelectAnimal') ?>" method="POST">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                            <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertAnimal') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                            <div class="mdl-tooltip mdl-tooltip--large" for="new">
                                <?php echo i18n::__('registrar', null, 'ayuda') ?>
                            </div>
                            <!--            <a id="deleteMasa" href="#myModalEliminarMasivo" class="btn btn-default btn-sm fa fa-trash-o" onclick="borrarSeleccion()"></a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
                            <?php echo i18n::__('eliminarMasa', null, 'ayuda') ?>
                                        </div>-->
                        <?php endif; ?>
                        <a id="filter" href="#myModalFilter" class="btn btn-sm btn-info active fa fa-search"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                            <?php echo i18n::__('buscar', null, 'ayuda') ?>
                        </div>
                 <!--<a href="#" data-target="#myModalReport" data-toggle="modal" class="btn btn-success btn-xs lead"><?php echo i18n::__('report') ?></a>-->
                        <a id="deleteFilter" class="btn btn-sm btn-primary fa fa-reply" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteFiltersAnimal') ?>"></a>  
                        <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                        </div> 

                        <a href="#myModalReport" data-toggle="modal" id="buscarReporteDetalle" class="btn btn-primary active btn-sm fa fa-newspaper-o"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="buscarReporteDetalle">
                            <?php echo i18n::__('buscarReporteDet', null, 'ayuda') ?>
                        </div>

                    </div>
                </div>
                <?php view::includeHandlerMessage() ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="success">

                                <th><?php echo i18n::__('identification', null, 'animal') ?></th>


                                <th><?php echo i18n::__('lote', null, 'animal') ?></th>


                                <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                    <th><?php echo i18n::__('action') ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>   
                        <tbody>
                            <?php foreach ($objAnimal as $key): ?>
                                <tr>

                                    <td><?php echo $key->$numeroIdenficacion ?></td>

                                    <td><?php echo $key->$lote ?></td>


                                    <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                        <td>
                                            <a href="#myModalDetail<?php echo $key->id ?>"  id="insertDetalle<?php echo $countDetale ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">add</i></a>
                                            <div class="mdl-tooltip mdl-tooltip--large" for="insertDetalle<?php echo $countDetale ?>">
                                                <?php echo i18n::__('insert', null, 'ayuda') ?>
                                            </div> 

                                            <a id="verDetalle<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexHojaVida', array(animalTableClass::ID => $key->id)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">watch</i> </a>
                                            <div class="mdl-tooltip mdl-tooltip--large" for="verDetalle<?php echo $countDetale ?>">
                                                <?php echo i18n::__('watch', null, 'ayuda') ?>
                                            </div> 

                                        </td>
                                    <?php endif; ?>
                                </tr>

                                <!-- WINDOWS MODAL DELETE  -->

                            <div id="myModalDelete<?php echo $key->$idAnimal ?>" class="modalmask">
                                <div class="modalbox rotate ">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('confirmDelete') ?></h4>
                                    </div>
                                    <a href="#close" title="Close" class="close">X</a>

                                    <div class="modal-body">
                                        <?php echo i18n::__('eliminarIndividual') ?>
                                    </div>

                                    <div class="modal-footer responsive">
                                        <a href="#close2" title="Close" class="btn btn-default fa fa-times-circle-o close2"><?php echo i18n::__('cancel') ?></a>
                                        <button type="button" class="btn btn-primary fa fa-eraser" onclick="eliminar(<?php echo $key->$idAnimal ?>, '<?php echo animalTableClass::getNameField(animalTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteAnimal') ?>')"><?php echo i18n::__('delete') ?></button>
                                    </div>

                                </div>
                            </div>
                            <tr>
                                <th>

                                    <?php $countDetale++ ?>
                                <?php endforeach ?>
                                </tbody>
                    </table>
                </div>
            </form>
            <!----PAGINADOR---->
            <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
                        <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                        <?php $count = 0 ?>
                        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                            <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                            <?php $count++ ?>        
                        <?php endfor; ?>
                        <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- WINDOWS MODAL DELETE MASIVE -->
        <!--    <div class="modalmask" id="myModalEliminarMasivo" >
              <div class="modalbox rotate">
              
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('deleteMasive') ?></h4>
                  </div>
                        <a href="#close" title="Close" class="close">X</a>
                  <div class="modal-body">
        <?php echo i18n::__('confirmDeleteMasive') ?>
                  </div>
                  <div class="modal-footer">
                      <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2"><?php echo i18n::__('cerrar') ?></a>
                    <button type="button" class="btn btn-primary fa fa-eraser" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirm') ?></button>
                  </div>
                
              </div>
            </div>-->

        <!-- WINDOWS MODAL FILTERS -->

        <div id="myModalFilter" class="modalmask">
            <div class="modalbox rotate">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                </div>
                <a href="#close" title="Close" class="close">X</a>
                <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>">

                    <table class="table table-responsive">  
                        <tr>
                            <th>
                                <?php echo i18n::__('identificacion') ?>:
                            </th>
                            <th>
                                <select name="filter[numero]">
                                    <option value="">...</option>
                                    <?php foreach ($objAnimal as $key): ?>
                                        <option value="<?php echo $key->numero_identificacion ?>">
                                            <?php echo $key->numero_identificacion ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                        </tr>

                        <tr>
                            <th>
                                <?php echo i18n::__('lote', null, 'animal') ?>:
                            </th>
                            <th>
                                <select name="filter[lote]">
                                    <option value="">...</option>
                                    <?php foreach ($objLote as $key): ?>
                                        <option value="<?php echo $key->id ?>">
                                            <?php echo $key->nombre_lote ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                        </tr>
                    </table>

                </form>
                <div class="modal-footer">
                    <a href="#close2" title="Close" class="close2 btn btn-default fa fa-times-circle-o close2"><?php echo i18n::__('cerrar') ?></a>
                    <button type="button" class="btn btn-info fa fa-search" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
                </div>
            </div>
        </div>




    </div>
</main>

<!-- WINDOWS MODAL INSERT ANIMAL -->
<div class="modalmask" id="myModalDetail<?php echo $key->id ?>">
    <div class="modalbox rotate">
        <form id="detailForm" name="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'createHojaVida') ?>">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('create') ?>:</h4>
            </div>
            <a href="#close" title="Close" class="close">X</a>
            <div class="modal-body">


                <input type="hidden" value="<?php echo $key->id ?>" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID, true) ?>" id="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID, true) ?>">
                <?php echo i18n::__('date_birth', null, 'animal') ?>
                <input type="datetime-local" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true) ?>">    
                <br/>
                <br/>
                <?php echo i18n::__('genero', null, 'animal') ?>
                <select name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO_ID, true) ?>">
                    <option value="">...</option>
                    <?php foreach ($objGenero as $key): ?> 

                        <option value="<?php echo $key->id ?>"><?php echo $key->nombre_genero ?></option>
                    <?php endforeach; //close foreach   ?>
                </select>
                <br/>
                <br/>
                <?php echo i18n::__('raza', null, 'animal') ?>
                <select name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA, true) ?>">
                    <option value="">...</option>
                    <?php foreach ($objRaza as $key): ?> 

                        <option value="<?php echo $key->id ?>"><?php echo $key->nombre_raza ?></option>
                    <?php endforeach; //close foreach   ?>
                </select>
              <br/>
                <br/>
                <?php echo i18n::__('parto', null, 'animal') ?>
              <input type="number" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::PARTO, true) ?>">
               <br/>
                <br/>
                <?php echo i18n::__('kg', null, 'animal') ?>
                <input type="number" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::PESO, true) ?>">
              
            </div>
            <div class="modal-footer">
                <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></a>
                <button type="submit" class="btn btn-info active fa fa-plus-square" ><?php echo i18n::__('insert', null, 'dpVenta') ?></button>

            </div>
        </form>
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
            <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportDetalleAnimal') ?>">

                <table class="table table-bordered">

                    <tr>
                        <th><?php echo i18n::__('identificacion') ?></th>
                        <th>
                            <select name="filter[numero]">
                                <option value="">
                                    ...
                                </option>
                                <?php foreach ($objFilterAnimal as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->numero_identificacion ?>
                                    </option>
                                <?php endforeach; //close foreach   ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th><?php echo i18n::__('lote') ?></th>
                        <th>
                            <select name="filter[lote]">
                                <option value="">
                                    ...
                                </option>
                                <?php foreach ($objLote as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->nombre_lote ?>
                                    </option>
                                <?php endforeach; //close foreach   ?>
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