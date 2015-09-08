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
<?php $id = vacunacionTableClass::ID ?>
<?php $num_doc = animalTableClass::NUMERO ?>
<?php $nom_veterinario = veterinarioTableClass::NOMBRE ?>
<?php $countDetale = 1 ?>
<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-12 text-center">

                    <h2>
                        <?php echo i18n::__('registroVacunacion', null, 'animal') ?> 
                    </h2>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-4-offset-4 nuevo">
                    <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                        <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'insertVacunacion') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="new">
                            <?php echo i18n::__('registrar', null, 'ayuda') ?>
                        </div>
                        <!--            <a href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" id="deleteMasa" class="btn btn-default btn-sm fa fa-ellipsis-v"></a>
                                    <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
                        <?php echo i18n::__('inhabilitarMasa', null, 'ayuda') ?>
                                    </div>-->
                    <?php endif; ?>
          <a href="#myModalFilter" data-toggle="modal" id="filter" class="btn btn-sm btn-info active fa fa-search"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                        <?php echo i18n::__('buscar', null, 'ayuda') ?>
                    </div>
                    <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteFiltersVacunacion') ?>" id="deleteFilter" class="btn btn-sm btn-primary fa fa-reply" ></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                        <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                    </div>
                    <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'reportVacunacion') ?>" id="reporte" class="btn btn-primary active btn-sm fa fa-download" ></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
                        <?php echo i18n::__('reporte', null, 'ayuda') ?>
                    </div>
                </div>
            </div>
            <?php view::includeHandlerMessage() ?>
            <div class="table-responsive">
                <table class="table table-bordered">

                    <thead>
                        <tr class="success">
                            <!--               <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                                <th>
                                <!--<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox">
                                
                                <input class="mdl-checkbox__input " type="checkbox" id="chkAll">
                                
                                <span class="mdl-checkbox__label">Checkbox</span>
                                </label>
                              </th>
                            <?php endif; ?> -->
            <!--              <th><?php echo i18n::__('numberDoc', null, 'datos') ?> </th>-->
                            <th><?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?> </th>
                            <th><?php echo i18n::__('animal', null, 'animal') ?> </th>
                            <th><?php echo i18n::__('veterinario', null, 'veterinario') ?> </th>
                            <th><?php echo i18n::__('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objVacunacion as $key): ?>
                            <tr>
                                <!--                       <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                                    <td>
                                                      <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox2">
                                                  
                                                      <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectVacunacion') ?>" method="POST">
                                    
                                                        <input type="checkbox" class="mdl-checkbox__input" name="chk[]" value="<?php echo $key->id ?>" id="checkbox2">
                                                      
                                                      </form>
                                                      
                                                                           
                                      <span class="mdl-checkbox__label">Checkbox</span>
                                                  </label>
                                                    </td>
                                <?php endif; ?>-->
                                <!--                <td><?php echo $key->id ?></td>-->
                                <td><?php echo $key->fecha_registro ?></td>
                                <td><?php echo $key->$num_doc ?></td>
                                <td><?php echo $key->$nom_veterinario ?></td>
                                <td>          
                                    <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                        <a id="editDetalle<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'editVacunacion', array(vacunacionTableClass::ID => $key->id)) ?>" class="btn btn-default active btn-sm fa fa-edit"></a>

                                        <div class="mdl-tooltip mdl-tooltip--large" for="editDetalle<?php echo $countDetale ?>">
                                            <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                        </div>    
                    <!--                  <a id="habilitar<?php echo $countDetale ?>"  href="#changeState<?php echo $key->$id ?>" class=" btn btn-sm btn-default fa fa-ban" ></a>
                                      <div class="mdl-tooltip mdl-tooltip--large" for="habilitar<?php echo $countDetale ?>">
                                        <?php echo i18n::__('i', null, 'ayuda') ?>
                                      </div>   -->
                                        <a href="#myModalDetail<?php echo $key->id ?>"  id="insertDetalle<?php echo $countDetale ?>"   class="btn btn-sm btn-primary fa fa-bars"></a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="insertDetalle<?php echo $countDetale ?>">
                                            <?php echo i18n::__('insertDetalle', null, 'ayuda') ?>
                                        </div> 
                                    <?php endif; ?>
                                    <a id="verDetalle<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'viewVacunacion', array(vacunacionTableClass::ID => $key->id)) ?>" class="btn btn-primary active btn-sm fa fa-eye"> </a>
                                    <div class="mdl-tooltip mdl-tooltip--large" for="verDetalle<?php echo $countDetale ?>">
                                        <?php echo i18n::__('verDetalle', null, 'ayuda') ?>
                                    </div>    
                                </td>
                            </tr>
                            <tr>
                                <th>

                                    <!-- WINDOWS MODAL DETAIL VACCINATION -->
                        <div class="modalmask" id="myModalDetail<?php echo $key->id ?>">
                            <div class="modalbox rotate">
                                <form id="detailForm" name="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'createDetalleVacunacion') ?>">

                                    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('newDetailVaccination', null, 'detalleVacunacion') ?>:</h4>
                                    </div>
                                    <a href="#close" title="Close" class="close">X</a>
                                    <div class="modal-body">


                                        <input type="hidden" value="<?php echo $key->id ?>" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>" id="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>">
                                        <?php echo i18n::__('fecha', null, 'detalleVacunacion') ?>
                                        <input type="datetime-local" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true) ?>">    
                                        <br/>
                                        <?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?>
                                        <select name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true) ?>">
                                            <option value="">...</option>
                                            <?php foreach ($objVacuna as $key): ?> 

                                                <option value="<?php echo $key->id ?>"><?php echo $key->nombre_vacuna ?></option>
                                            <?php endforeach; //close foreach   ?>
                                        </select>
                                        <br/>
                                        <?php echo i18n::__('dosis', null, 'detalleVacunacion') ?>
                                        <input type="text" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true) ?>">
                                        <br/>
                                        <?php echo i18n::__('accion') ?>
                                        <select name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true) ?>">
                                            <option value="">...</option>
                                            <option><?php echo i18n::__('enfermedad') ?></option>
                                            <option><?php echo i18n::__('gestacion') ?></option>
                                            <option><?php echo i18n::__('parto') ?></option>
                                            <option><?php echo i18n::__('rutina') ?></option>
                                            <option><?php echo i18n::__('nacido') ?></option>
                                        </select>
                                        <br />
                                        <font size="2">* <?php echo i18n::__('oblig', null, 'detalleVacunacion') ?></font>

                                    </div>
                                    <div class="modal-footer">
                <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></a>
                                        <button type="submit" class="btn btn-info active fa fa-plus-square" ><?php echo i18n::__('insert', null, 'dpVenta') ?></button>

                                    </div>
                                </form>
                            </div>
                        </div>
                        </th>
                        </tr>
                        <?php $countDetale++ ?>
                    <?php endforeach//close foreach   ?>

                    </tbody>
                </table>
            </div>
            <!-- PAGINATOR -->
            <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
                        <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                        <?php $count = 0 ?>
                        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                            <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                            <?php $count ++ ?>        
                        <?php endfor //close for   ?>
                        <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div> 
            <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacunacion') ?>" method="POST">
                <input type="hidden" id="idDelete" name="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID, true) ?>">
            </form>
        </div>


        <!-- WINDOWS MODAL DELETE MASIVE -->
        <!--  <div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('borrar seleccion') ?></h4>
                </div>
                   <a href="#close" title="Close" class="close">X</a>
                <div class="modal-body">
        
        <?php echo i18n::__('deleteMasive') ?>
                </div>
                <div class="modal-footer">
                  <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" > <?php echo i18n::__('cancel') ?></a>
                  <button type="button" class="btn btn-primary fa fa-ban" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
                </div>
              </div>
            </div>
          </div>-->

<style>

@media (max-width: 800px) {
    #myModalFilter{
   margin: 0 0 0 0;
        width: 30%;
        z-index: 99999;
    }
    
}
</style>

    </div>
</main>
<!-- WINDOWS MODAL FILTER -->
<div class="modalmask" id="myModalFilter">
  <div class="modalbox rotate">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
            </div>
            <a href="#close" title="Close" class="close">X</a>
            <div class="modal-body">
                <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>">
                    <table class="table table-bordered">
            <!--          <tr>
                        <th>
                        <?php echo i18n::__('numer', null, 'dpVenta') ?>:
                        </th>
                        <th>
                          <input  type="text" name="filter[id]">
                        </th>
                      </tr>-->
                        <tr>
                            <th>
                                <?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?>:
                            </th>
                            <th>
                                <input  type="datetime-local" name="filter[fecha]">
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('animal', null, 'animal') ?>:
                            </th>
                            <th>
                                <select name="filter[animal]">
                                    <option value="">...</option>
                                    <?php foreach ($objAnimal as $key): ?>

                                        <option value="<?php echo $key->id ?>">
                                            <?php echo $key->numero_identificacion ?>
                                        </option>
                                    <?php endforeach; //close foreach  ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('veterinario', null, 'veterinario') ?>:
                            </th>
                            <th>
                                <select name="filter[veterinario]">
                                    <option value="">...</option>

                                    <?php foreach ($objVeterinario as $key): ?>
                                        <option value="<?php echo $key->id ?>">
                                            <?php echo $key->nombre_completo ?>
                                        </option>
                                    <?php endforeach; //close foreach   ?>
                                </select>
                            </th>
                        </tr>
                    </table>

                </form>
            </div>
            <div class="modal-footer">
                <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o" ><?php echo i18n::__('close', null, 'vacunacion') ?></a>
                <button type="button" class="btn btn-info fa fa-search" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
            </div>

        </div>
    </div>




