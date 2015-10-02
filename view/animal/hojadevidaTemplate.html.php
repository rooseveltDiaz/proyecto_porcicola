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
<?php $idAnimal = animalTableClass::ID ?>
<?php $fecha = hojaVidaTableClass::FECHA_NACIMIENTO ?>
<?php $genero = generoTableClass::NOMBRE ?>
<?php $raza_id = razaTableClass::NOMBRE_RAZA ?>
<?php $raza = razaTableClass::NOMBRE_RAZA ?>
<?php $parto = hojaVidaTableClass::PARTO ?>
<?php $peso = hojaVidaTableClass::PESO ?>
<?php $numero = hojaVidaTableClass::NUMERO ?>
<?php $lote = loteTableClass::NOMBRE ?>
<?php $idAnimalHojaVida = hojaVidaTableClass::ANIMAL ?>
<?php $countDetale = 1 ?>-

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

<!--                        <a id="informe" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportHojaVida') ?>" class="btn btn-primary active btn-sm fa fa-download" ></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="informe">
                            <?php echo i18n::__('reporteHV', null, 'dpVenta') ?>
                        </div>-->
                                  <a href="#myModalReport" data-toggle="modal" id="informe" class="btn btn-primary active btn-sm glyphicon glyphicon-piggy-bank"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="informe">
                        <?php echo i18n::__('buscarReporteDetHoja', null, 'ayuda') ?>
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
                                <td>  <?php echo i18n::__('identificacion') ?>:</td>

                                <?php foreach ($objHojaVida as $key): ?>
                                    <td><?php echo $key->$numero ?></td>
                                </tr>       
                            <?php endforeach; ?>
                                <tr>   
                                <td>  <?php echo i18n::__('date_birth', NULL, 'animal') ?>:</td>
                                 <?php foreach ($objHojaVida as $key): ?>
                                <td>  <?php echo $key->$fecha ?></td>
                            </tr>
                              <?php endforeach; ?>
                            <tr>    
                                <td>  <?php echo i18n::__('genero', null, 'animal') ?>:</td>
                                     <?php foreach ($objHojaVida as $key): ?>
                                <td>  <?php echo $key->$genero ?></td>
                            </tr>
                              <?php endforeach; ?>
                               <?php foreach ($objHojaVida as $key): ?>
                            <?php if ($key->genero_id == 1): ?>
                                <tr>  
                                    <td>  <?php echo i18n::__('parto', NULL, 'animal') ?>:
                                          
                                    </td>  
                                    <td>  <?php echo $key->$parto ?></td>
                                </tr>
                             
                            <?php endif; ?>
                                   <?php endforeach; ?>
                                <tr>
                                <td>  <?php echo i18n::__('raza') ?>:</td>
                                     <?php foreach ($objHojaVida as $key): ?>
                                <td>  <?php echo $key->$raza ?></td>
                            </tr>
                              <?php endforeach; ?>
                            <tr>    
                                <td> <?php echo i18n::__('peso', NULL, 'animal') ?>:</td>
                                 <?php foreach ($objHojaVida as $key): ?>
                                <td>  <?php echo $key->$peso ?> <?php echo i18n::__('k', NULL, 'animal') ?> </td>
                            </tr>
                               <?php endforeach; ?>
                        </thead>
                        <tr><td colspan="2">
                                <div class=" text-center">
                                           <?php foreach ($objHojaVida as $key): ?>
                                    <?php if ($key->genero_id == 1): ?>
                                     
                                    <a id="gestacion<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexGestacion', array(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL)  => $key->$idAnimalHojaVida )) ?>" class="btn btn-lg glyphicon glyphicon-calendar " > </a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="gestacion<?php echo $countDetale ?>">
                                            <?php echo i18n::__('gestacion', null, 'dpVenta') ?>
                                        </div> 
                                        <a id="parto<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroParto', array(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL) => $key->$idAnimalHojaVida)) ?>" class="btn btn-lg glyphicon glyphicon-list-alt" > </a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="parto<?php echo $countDetale ?>">
                                            <?php echo i18n::__('parto', null, 'dpVenta') ?>
                                        </div> 
                                    <?php endif; ?>
                                    
                                    <a id="peso<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroPeso', array(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL) => $key->$idAnimalHojaVida)) ?>" class="btn btn-lg glyphicon glyphicon-file" > </a>
                                    <div class="mdl-tooltip mdl-tooltip--large" for="peso<?php echo $countDetale ?>">
                                        <?php echo i18n::__('repeso', null, 'dpVenta') ?>
                                    </div> 
<!--                                    <a id="vacunacion<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexVacunacion',array(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL) => $key->$idAnimalHojaVida)) ?>" class="btn btn-lg fa fa-medkit" > </a>
                                    <div class="mdl-tooltip mdl-tooltip--large" for="vacunacion<?php echo $countDetale ?>">
                                        <?php echo i18n::__('vacu', null, 'dpVenta') ?>
                                    </div> -->
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- WINDOWS MODAL REPORT -->
<div class="modalmask" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modalbox rotate">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
        </div>
        <a href="#close" title="Close" class="close">X</a>
        <div class="modal-body">
            <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportHojaVida') ?>">

                <table class="table table-bordered">

                    <tr>
                        <th><?php echo i18n::__('identification', null, 'animal') ?></th>
                        <th>
                            <select name="filter[numero]">
                                <option value="">
                                    ...
                                </option>
                                <?php foreach ($objAnimal as $key): ?>
                                    <option value="<?php echo $key->numero_identificacion ?>">
                                        <?php echo $key->numero_identificacion ?>
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