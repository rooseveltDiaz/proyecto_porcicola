
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\request\requestClass as request ?>
<?php $id_registro = detalleVacunacionTableClass::ID ?>
<?php $idDetalle = detalleVacunacionTableClass::ID_REGISTRO ?>
<?php $nombreVacuna = vacunaTableClass::NOMBRE_VACUNA ?>

<div class="container container-fluid">

    <br/> <br/>
    <?php echo i18n::__('read', null, 'usuario') ?>
    <br /> <br/>
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr class="success">
                <th><?php echo i18n::__('numer', null, 'dpVenta') ?></th>
                <th><?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?></th>
                <th><?php echo i18n::__('animal', null, 'animal') ?></th>
                <th><?php echo i18n::__('veterinario',null,'veterinario') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($objVacunacion as $key): ?>
                <tr>
                    <td><?php echo $key->id ?></td>
                    <td><?php echo $key->fecha_registro ?></td>
                    <td><?php echo $key->id_animal ?></td>
                    <td><?php echo $key->id_veterinario ?> </td>
                </tr>
                                                
            <?php endforeach ?>
        </tbody>
    </table>
    </div>
    <br/> 
    <?php echo i18n::__('detailVaccination', null, 'detalleVacunacion') ?>

    <div class="container container-fluid" style="margin-bottom: 10px">
        <!--<form id="frmDelebottom: 10px; margin-top: 30px">-->
        <br />        
        <a href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('borrar seleccion') ?></a>
        <!--<a href="<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'reportDetalleVacunacion') ?>" class="btn btn-info btn-xs" ><?php echo i18n::__('report') ?></a>-->       
        <a href="#" data-target="#myModalReport" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('filterReport', null, 'detalleVacunacion') ?></a>
        <a href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('filters') ?></a>
        <a class="btn btn-xs btn-default active" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteFilterDetalle') ?>"><?php echo i18n::__('eliminar filtros') ?></a>
    </div>

    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectDetalleVacunacion') ?>" method="POST">
        <div class="table-responsive ">
        <table class="table table-bordered ">
            <thead>
                <tr class="active">
                    <th><input type="checkbox" id="chkAll"></th>
                    <th><?php echo i18n::__('numberDoc', null, 'datos') ?></th>
                    <th><?php echo i18n::__('N°', null, 'detalleVacunacion') ?></th>
                    <th><?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></th>
                    <th><?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></th>
                    <th><?php echo i18n::__('dosis', null, 'detalleVacunacion') ?></th>
                    <th><?php echo i18n::__('accion') ?></th>
                    <th><?php echo i18n::__('action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objDetalleVacunacion as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $key->id ?>"></td>
                        <td><?php echo $key->$idDetalle ?></td>
                        <td><?php echo $key->$id_registro ?></td>
                        <td><?php echo $key->fecha_vacunacion ?></td>
                        <td><?php echo $key->$nombreVacuna ?></td>
                        <td><?php echo $key->dosis_vacuna ?></td>
                          <td><?php echo $key->accion ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info fa " data-toggle="modal" data-target="#myModalUpdate<?php echo $key->id ?>"><?php echo i18n::__('edit', null, 'user') ?></a>
                            <a href="#" class="btn btn-sm btn-danger fa fa-trash-o" data-toggle="modal" data-target="#myModalDelete<?php echo $key->id ?>"><?php echo i18n::__('delete') ?></a>
                        </td>
                    </tr>
                    <!-- WINDOWS MODAL DELETE -->
                <div class="modal fade" id="myModalDelete<?php echo $key->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete') ?></h4>
                            </div>
                            <div class="modal-body">
                                <?php echo i18n::__('eliminarIndividual') ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->id ?>, '<?php echo detalleVacunacionBaseTableClass::getNameField(detalleVacunacionTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteDetalleVacunacion') ?>')"><?php echo i18n::__('delete') ?></button>
                            </div>
                        </div>
                    </div>
                </div>      
        </form>
        <!-- WINDOWS MODAL UPDATE DETAIL VACCINATION -->
        <div class="modal fade" id="myModalUpdate<?php echo $key->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('editDetailVaccination', null, 'detalleVacunacion') ?>:</h4>
                    </div>
                    <div class="modal-body">

                        <form id="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'updateDetalleVacunacion') ?>">
                            <input type="hidden" value="<?php echo request::getInstance()->getServer('PATH_INFO') ?>" name="PATH_INFO">

                            <input type="hidden" value="<?php echo $key->$idDetalle ?>" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>">
                            <input type="hidden" value="<?php echo $key->$id_registro ?>" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID, true) ?>">
                      
                             <h3> <?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></h3>
                             <input type="datetime-local" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true) ?>">
                            <h3> <?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></h3>
                            <select name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true) ?>">
                                <option value="">...</option>
                                <?php foreach ($objVacuna as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->nombre_vacuna ?></option>
                                <?php endforeach; ?>
                            </select>
                            <h3> <?php echo i18n::__('dosis', null, 'detalleVacunacion') ?></h3>
                            <input type="text" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true) ?>">
                            <h3><?php echo i18n::__('accion') ?></h3>
                                    <select name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true) ?>">
                                        <option>...</option>
                                        <option><?php echo i18n::__('enfermedad') ?></option>
                                        <option><?php echo i18n::__('gestacion') ?></option>
                                        <option><?php echo i18n::__('parto') ?></option>
                                        <option><?php echo i18n::__('rutina') ?></option>
                                        <option><?php echo i18n::__('nacido') ?></option>
                                    </select>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></button>
                                <!--<button type="button"  onclick="$('#detailForm').submit()">Insertar</button>-->
                                <input type="submit" class="btn btn-primary" value=<?php echo i18n::__('edit', null, 'user') ?>> 
                                </form>
                            </div>
                    </div>
                </div>
            </div>     
        <?php endforeach ?>
        </tbody>
        </table>
        </div>
    </div>
    <!-- WINDOWS MODAL DELETE MASIVE -->
    <div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('borrar seleccion') ?></h4>
                </div>
                <div class="modal-body">

                    <?php echo i18n::__('confirmDeleteMasive') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo i18n::__('close', null, 'vacunacion') ?></button>
                    <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- WINDOWS MODAL FILTER -->
    <div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                </div>
                <div class="modal-body">
                    <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'viewVacunacion') ?>">
                        <input type="hidden" name="<?php echo vacunacionTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(vacunacionTableClass::ID) ?>">
                        <table class="table table-bordered">
                            <tr>
                                <th><?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></th>
                                <th>
                                    <input name="filter[fecha]" type="datetime-local">
                                </th>
                            </tr>
                            <tr>

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
                                        <?php endforeach; ?>
                                    </select>
                                </th>
                            </tr>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal" ><?php echo i18n::__('close', null, 'vacunacion') ?></button>
                    <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
                </div>
            </div>
        </div>
    </div>


    <!-- WINDOWS MODAL REPORT -->
    <div class="modal fade" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                </div>
                <div class="modal-body">
                    <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'reportDetalleVacunacion') ?>">
                        <input type="hidden" name="<?php echo vacunacionTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(vacunacionTableClass::ID) ?>">
                        <table class="table table-bordered">
                            <tr>
                                <th><?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></th>
                                <th>
                                    <input name="filter[fecha]" type="datetime-local">
                                </th>
                            </tr>
                            <tr>

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
                                        <?php endforeach; ?>
                                    </select>
                                </th>
                            </tr>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal" ><?php echo i18n::__('close', null, 'vacunacion') ?></button>
                    <button type="button" class="btn btn-primary" onclick="$('#reportForm').submit()"><?php echo i18n::__('buscar') ?></button>
                </div>
            </div>
        </div>
    </div>
