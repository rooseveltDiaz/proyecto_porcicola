<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $id = gestacionTableClass::ID ?>
<?php $idAnimal = animalTableClass::ID ?>
<?php $fecha = gestacionTableClass::FECHA ?>
<?php $nombre = empleadoTableClass::NOMBRE ?>
<?php $animal = gestacionTableClass::ANIMAL ?>
<?php $empleado = gestacionTableClass::EMPLEADO ?>
<?php $numero = animalTableClass::NUMERO ?>
<?php $macho = animalTableClass::NUMERO ?>
<?php $fecha_monta = gestacionTableClass::FECHA_MONTA ?>
<?php $fecundador = gestacionTableClass::ANIMAL_FECUNDADOR ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 text-center">
                    <h2>
                        <?php echo i18n::__('read', NULL, 'gestacion') ?>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <a id="atras" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexHojaVida',array(hojaVidaTableClass::ID =>$idHojaVida)) ?>"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="atras">
                        <?php echo i18n::__('atras', null, 'ayuda') ?>
                    </div> 
                    <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                    <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertGestacion', array(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL) => $idAnimalHojaVida)) ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="new">
                            <?php echo i18n::__('registrar', null, 'ayuda') ?>
                        </div>
                    <?php endif; ?>
                    <a id="filter" href="#myModalFilter" class="btn btn-sm btn-info active fa fa-search"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                        <?php echo i18n::__('buscar', null, 'ayuda') ?>
                    </div>

                    <a id="deleteFilter" class="btn btn-sm btn-primary fa fa-reply" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteFiltersGestacion') ?>"></a>  
                    <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                        <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                    </div>

<!--                    <a id="report" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportGestacion') ?>" class="btn btn-primary active btn-sm fa fa-download"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="report">
                        <?php echo i18n::__('reporte', null, 'ayuda') ?>
                    </div>-->
                    <!--             <a id="deleteMasa" href="#myModalEliminarMasivo" class="btn btn-default btn-sm fa fa-trash-o" onclick="borrarSeleccion()"></a>
                                <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
                    <?php echo i18n::__('eliminarMasa', null, 'ayuda') ?>
                                </div>-->
                                 <a href="#myModalReport" data-toggle="modal" id="informe" class="btn btn-primary active btn-sm fa fa-paw"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="informe">
                        <?php echo i18n::__('buscarReporteDetGes', null, 'ayuda') ?>
                    </div>

                </div>
            </div>
            <?php view::includeHandlerMessage() ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="success">
<!--                                <td><input type="checkbox" id="chkAll"></td> -->
                            <th><?php echo i18n::__('numero de documento') ?></th>  
                            <th><?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?></th>             
                            <th><?php echo i18n::__('hem', null, 'gestacion') ?></th>
                            <th><?php echo i18n::__('fechaMonta', null, 'gestacion') ?></th>
<!--                            <th><?php echo i18n::__('fechaParto', null, 'gestacion') ?></th>-->
                            <th><?php echo i18n::__('fecundador', null, 'gestacion') ?></th>
                            <th><?php echo i18n::__('empleado') ?></th>
                          <!--  <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                <th><?php echo i18n::__('action') ?></th>
                            <?php endif; ?>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objGestacion as $key): ?>
                            <tr>

                                <td><?php echo $key->$id ?></td>  
                                <td><?php echo $key->$fecha ?></td>                
                                <td><?php echo $key->$numero ?></td>
                                <th><?php echo $key->$fecha_monta ?></th>
                                <td><?php echo $key->$macho ?></td>
                                <td><?php echo $key->$nombre ?></td>
                          <!--        <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                    <td>
                                        <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'editGestacion', array(gestacionTableClass::ID => $key->$id)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">edit</i></a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                                            <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                        </div> 
                                              <a id="eliminar<?php echo $countDetale ?>"  href="#myModalDelete<?php echo $key->$id ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">delete</i></a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="eliminar<?php echo $countDetale ?>">
                                        <?php echo i18n::__('eliminar', null, 'ayuda') ?>
                                        </div> 
                                    </td>
                                <?php endif; ?>-->
                            </tr>

                            <!-- WINDOWS MODAL DELETE -->
                        <div id="myModalDelete<?php echo $key->$id ?>" class="modalmask">
                            <div class="modalbox rotate">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('confirmDelete') ?></h4>
                                </div>
                                <a href="#close" title="Close" class="close">X</a>
                                <div class="modal-body">
                                    ¿<?php echo i18n::__('confirmDelete') ?>?
                                </div>
                                <div class="modal-footer">
                                    <a href="#close2" title="Close" class="close2 btn btn-default fa fa-times-circle-o close2"><?php echo i18n::__('cancel') ?></a>
                                    <button type="button" class="btn btn-primary fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo gestacionTableClass::getNameField(gestacionTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteGestacion') ?>')"><?php echo i18n::__('delete') ?></button>
                                </div>
                            </div>
                        </div>

                        <?php $countDetale++ ?>
                    <?php endforeach//close foreach   ?>
                    </tbody>
                </table>
            </div>

            <!----PAGINADOR---->
            <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
                        <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexGestacion') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                        <?php $count = 0 ?>
                        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                            <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexGestacion') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                            <?php $count ++ ?>        
                        <?php endfor; //close for   ?>
                        <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexGestacion') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>


    </div>
    <!-- WINDOWS MODAL FILTERS -->
    <div id="myModalFilter" class="modalmask">
        <div class="modalbox rotate">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
            </div>
            <a href="#close" title="Close" class="close">X</a>
            <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexGestacion') ?>">
                <table class="table table-responsive ">  
                    <tr>
                        <th>
                            <?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?>:
                        </th>
                        <th>
                            <input type="date" name="filter[fecha]" >               
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('hem', null, 'gestacion') ?>:
                        </th>
                        <th>
                            <select name="filter[numero]">
                                <option value="">...</option>
                                <?php foreach ($objAnimal as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->$numero ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('fechaMonta', null, 'gestacion') ?>:
                        </th>
                        <th>
                            <input type="date" name="filter[fechaMonta]" >               
                        </th>
                    </tr>
<!--                    <tr>
                        <th>
                            <?php echo i18n::__('fechaParto', null, 'gestacion') ?>:
                        </th>
                        <th>
                            <input type="date" name="filter[fechaParto]" >               
                        </th>
                    </tr>-->
                    <tr>
                        <th>
                            <?php echo i18n::__('fecundador', null, 'gestacion') ?>:
                        </th>
                        <th>
                            <select name="filter[macho]">
                                <option value="">...</option>
                                <?php foreach ($objAnimal as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->$numero ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('empleado') ?>:
                        </th>
                        <th>
                            <select name="filter[empleado]">
                                <option value="">...</option>
                                <?php foreach ($objEmpleado as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->nombre_completo ?>
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
            <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportGestacion') ?>">

                <table class="table table-bordered">

                    <tr>
                        <th><?php echo i18n::__('identificacion') ?></th>
                        <th>
                            <select name="filter[numero]">
                                <option value="">
                                    ...
                                </option>
                                <?php foreach ($objAnimal as $key): ?>
                                    <option value="<?php echo $key->id ?>">
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