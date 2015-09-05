<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $id = salidaBodegaTableClass::ID ?>
<?php $idSalida = detalleSalidaBodegaTableClass::ID_SALIDA ?>
<?php $fecha = salidaBodegaTableClass::FECHA ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $tipoInsumo = tipoInsumoTableClass::DESCRIPCION ?>
<?php $insumo = insumoTableClass::NOMBRE ?>
<?php $cantidad = detalleSalidaBodegaTableClass::CANDITDAD ?>
<?php $primaria = detalleSalidaBodegaTableClass::ID ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">

            <br/> <br/>
<?php echo i18n::__('salida', null, 'bodega') ?>
            <br /> <br/>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                            <th>
<?php echo i18n::__('numero de documento') ?>
                            </th>
                            <th>
<?php echo i18n::__('date', null, 'dpVenta') ?>
                            </th>
                            <th>
<?php echo i18n::__('empleado', null, 'empleado') ?>
                    </thead>
                    <tbody>
<?php foreach ($objSalida as $key): ?>
                            <tr>
                                <td><?php echo $key->$id ?></td>
                                <td><?php echo $key->$fecha ?></td>
                                <td><?php echo $key->$nombreEmpleado ?></td>
                            </tr>

            <?php endforeach//close foreach    ?>
                    </tbody>
                </table>
            </div>
            <br/> 
                <?php echo i18n::__('detalle1', null, 'bodega') ?>

            <div class="container container-fluid" style="margin-bottom: 10px">
                <!--<form id="frmDelebottom: 10px; margin-top: 30px">-->
                <br />  
                <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                    <a href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" id="eliminarSeleccionDetalle" class="btn btn-default btn-sm fa fa-ellipsis-v"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="eliminarSeleccionDetalle">
                        <?php echo i18n::__('inhabilitarMasaDetalle', null, 'ayuda') ?>
                    </div>
<?php endif; ?>
                <a href="#myModalReport"  id="buscarDetalle" class="btn btn-sm btn-info active fa fa-search"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="buscarDetalle">
                    <?php echo i18n::__('buscar', null, 'ayuda') ?>
                </div>
                <a class="btn btn-sm btn-primary fa fa-reply" id="eliminarBusquedaDetalle" href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'deleteFilterDetalleSalida') ?>"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="eliminarBusquedaDetalle">
                    <?php echo i18n::__('eliBusDetalle', null, 'ayuda') ?>
                </div>
                <a href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'reportDetalleSalidaBodega') ?>" id="buscarReporteDetalle" class="btn btn-primary active btn-sm fa fa-newspaper-o"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="buscarReporteDetalle">
<?php echo i18n::__('buscarReporteDet', null, 'ayuda') ?>
                </div>

            </div>

<!--      <form id="frmDeleteAll" action="<?php // echo routing::getInstance()->getUrlWeb('bodega', 'delet')  ?>" method="POST">-->
            <div class="table-responsive">
                <table class="table table-bordered  ">
                    <thead>
                        <tr class="active">
<!--                            <th><input type="checkbox" id="chkAll"></th>-->
                            <th>
<?php echo i18n::__('item') ?>
                            </th>
<!--                            <th>
<?php echo i18n::__('numRegistro', null, 'datos') ?>
                            </th>-->
                            <th>
<?php echo i18n::__('tipoInsumo') ?> 
                            </th>
                            <th>
                            <?php echo i18n::__('insumo', null, 'insumo') ?>
                            </th>
                            <th>
                            <?php echo i18n::__('cantidad') ?>
                            </th>
<?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                <th><?php echo i18n::__('action') ?></th>
                        <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
<?php foreach ($objDetalleSalida as $key): ?>
                            <tr>
<!--                                <td><input type="checkbox" name="chk[]" value="<?php echo $key->id ?>"></td>-->
                                <td><?php echo $key->$primaria ?></td>
<!--                                <td><?php echo $key->$idSalida ?></td>-->
                                <td><?php echo $key->$tipoInsumo ?></td>
                                <td><?php echo $key->$insumo ?></td>
                                <td><?php echo $key->$cantidad ?></td>
                                        <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                    <td>
                                        <a id="editarDetalle<?php echo $countDetale ?>" href="#myModaUpdateDetails<?php echo $key->$id ?>" class="btn btn-default active btn-sm fa fa-edit"  ></a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="editarDetalle<?php echo $countDetale ?>">
                                            <?php echo i18n::__('editDetalle', null, 'ayuda') ?>
                                        </div>  
<!--                                        <a id="eliminarDetalle<?php echo $countDetale ?>" href="#myModalDelete<?php echo $key->$id ?>" class="btn btn-sm btn-default fa fa-ban" ></a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="eliminarDetalle<?php echo $countDetale ?>">
                                <?php echo i18n::__('inhabilitarDetalle', null, 'ayuda') ?>
                                        </div>  -->
                                    </td>
    <?php endif; ?>
                            </tr>
    <?php $countDetale++ ?>    


                            <!-- WINDOWS MODAL DELETE -->
                        <div id="myModalDelete<?php echo $key->$id ?>" class="modalmask">
                            <div class="modalbox rotate">
                                <a href="#close" title="Close" class="close">X</a>
                                <div class="modal-body">
    <?php echo i18n::__('eliminarIndividual') ?>
                                </div>
                                <div class="modal-footer">
                                    <a href="#close2" title="Close" class="close2 btn btn-info"><?php echo i18n::__('cancel') ?></a>
                                    <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->id ?>, '<?php echo detalleSalidaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID, true) ?>', '<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteDetalleVacunacion')     ?>')"><?php echo i18n::__('delete') ?></button>
                                </div>
                            </div>
                        </div>


                        <!-- WINDOWS MODAL UPDATE DETAILS -->


                        <!-- WINDOWS MODAL DETAILS -->
                        <div id="myModaUpdateDetails<?php echo $key->$id ?>" class="modalmask">
                            <div class="modalbox rotate">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">  modificar detalle</h4>
                                </div>
                                <a href="#close" title="Close" class="close">X</a>
                                <form id="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('bodega', 'updateDetalleSalidaBodega') ?>">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?php echo request::getInstance()->getServer('PATH_INFO') ?>" name="PATH_INFO">
                                        <input type="hidden" value="<?php echo $key->$idSalida ?>" name="<?php echo detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_SALIDA, true) ?>" >
                                        <input type="hidden"  value="<?php echo $key->$id ?>" name="<?php echo detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID, true) ?>">
                                            <?php echo i18n::__('tipoInsumo') ?>
                                        <select name="<?php echo detalleSalidaBodegaBaseTableClass::getNameField(detalleSalidaBodegaTableClass::TIPO_INSUMO, true) ?>">
                                            <option value="">...</option>
    <?php foreach ($objTipoInsumo as $key): ?>
                                                <option value="<?php echo $key->id ?>"><?php echo $key->descripcion ?></option>
                                        <?php endforeach; //close foreach   ?>
                                        </select>
                                        <br />
                                        <br />
                                            <?php echo i18n::__('insumo') ?>
                                        <select name="<?php echo detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_INSUMO, true) ?>">
                                            <option value="">...</option>
    <?php foreach ($objInsumo as $key): ?>
                                                <option value="<?php echo $key->id ?>"><?php echo $key->nombre_insumo ?></option>
    <?php endforeach; //close foreach     ?>
                                        </select>

                                        <br/>
                                        <br/>

    <?php echo i18n::__('cantidad') ?>
                                        <input type="number" name="<?php echo detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::CANDITDAD, true) ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></a>
                                        <button type="button" class="btn btn-blue active fa fa-external-link" onclick="$('#detailForm').submit()"><?php echo i18n::__('update') ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </th>
                        </tr>
    <?php $countDetale++ ?>
<?php endforeach//close foreach     ?>
                    </tbody>
                </table>
            </div>



            <!-- WINDOWS MODAL FILTER -->
            <div id="myModalReport" class="modalmask">
                <div class="modalbox rotate">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                    </div>
                    <a href="#close" title="Close" class="close">X</a>
                    <div class="modal-body">
                        <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('bodega', 'viewSalida') ?>">
                            <input type="hidden" name="<?php echo salidaBodegaTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(salidaBodegaTableClass::ID) ?>">
                            <table class="table table-bordered">
                                <tr>
                                    <th>
                                            <?php echo i18n::__('tipoInsumo') ?>
                                    </th>
                                    <th>
                                        <select name="filter[tipoInsumo]">
                                            <option value="">...</option>
<?php foreach ($objTipoInsumo as $key): ?>
                                                <option value="<?php echo $key->id ?>"><?php echo $key->descripcion ?></option>
<?php endforeach; //close foreach    ?>
                                        </select>
                                    </th>
                                </tr>
                                <tr>

                                    <th>
                                            <?php echo i18n::__('insumo', null, 'insumo') ?>
                                    </th>
                                    <th>
                                        <select name="filter[Insumo]">
                                            <option value="">...</option>
<?php foreach ($objInsumo as $key): ?>
                                                <option value="<?php echo $key->id ?>"><?php echo $key->nombre_insumo ?></option>
<?php endforeach; //close foreach    ?>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
<?php echo i18n::__('cantidad') ?>
                                    </th>
                                    <th>
                                        <input name="filter[cantidad]" type="text">
                                    </th>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" data-dismiss="modal" ><?php echo i18n::__('close', null, 'vacunacion') ?></a>
                        <button type="button" class="btn btn-info fa fa-search" onclick="$('#reportForm').submit()"><?php echo i18n::__('buscar') ?></button>
                    </div>
                </div>
            </div>


