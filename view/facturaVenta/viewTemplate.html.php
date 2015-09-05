
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass  as session ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\config\configClass as config ?>
<?php $proceso_venta = procesoVentaTableClass::ID?>
<?php $idDetalle = detalleProcesoVentaTableClass::ID?>
<?php $fecha = procesoVentaTableClass::FECHA_HORA_VENTA ?>
<?php $empleado = empleadoTableClass::NOMBRE ?>
<?php $cliente = clienteTableClass::NOMBRE ?>

<?php $animal = detalleProcesoVentaTableClass::ANIMAL ?>
<?php $valor = detalleProcesoVentaTableClass::VALOR ?>
<?php  $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">

            <br/> <br/>
          <?php echo i18n::__('fact', null, 'facturaVenta') ?>
            <br /> <br/>
            <div class=" table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="success">
                        <th><?php echo i18n::__('date', null, 'dpVenta') ?></th>
                        <th><?php echo i18n::__('empleado') ?></th>
                        <th><?php echo i18n::__('cliente') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objFacturaVenta as $key): ?>
                        <tr>
                            <td><?php echo date("Y-M-d h:m", strtotime($key->$fecha)) ?></td>
                            <td><?php echo $key->$empleado ?></td>
                            <td><?php echo $key->$cliente?></td>
                        </tr>
                                                            
                    <?php endforeach//close foreach ?>
                </tbody>
            </table>
            </div>
            <br/> 
  <?php echo i18n::__('detalle1', null, 'pCompra') ?>

            <div class="container container-fluid" style="margin-bottom: 10px">
                <!--<form id="frmDelebottom: 10px; margin-top: 30px">-->
                <br />  
              <!--  <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                <a href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" id="eliminarSeleccionDetalle" class="btn btn-default btn-sm fa fa-ellipsis-v"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="eliminarSeleccionDetalle">
                    <?php echo i18n::__('inhabilitarMasaDetalle', null, 'ayuda') ?>
                </div>
                <?php endif; ?> -->
                <a href="#myModalFilter" data-toggle="modal" id="buscarDetalle" class="btn btn-sm btn-info active fa fa-search"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="buscarDetalle">
                    <?php echo i18n::__('buscar', null, 'ayuda') ?>
                </div>
                <a class="btn btn-sm btn-primary fa fa-reply" id="eliminarBusquedaDetalle" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteFilterDetalle') ?>"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="eliminarBusquedaDetalle">
                    <?php echo i18n::__('eliBusDetalle', null, 'ayuda') ?>
                </div>
                <a href="#myModalReport" id="buscarReporteDetalle" class="btn btn-primary active btn-sm fa fa-newspaper-o"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="buscarReporteDetalle">
                    <?php echo i18n::__('buscarReporteDet', null, 'ayuda') ?>
                </div>
                
                <!--<a href="<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'reportDetalleVacunacion')    ?>" class="btn btn-info btn-xs" ><?php echo i18n::__('report') ?></a>-->       
                
              
            </div>

            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteSelectDetalleFacturaVenta') ?>" method="POST">
                <div class=" table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="success">
                             <!--    <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                            <th><input type="checkbox" id="chkAll"></th>
                            <?php endif; ?> -->
                            <th><?php echo i18n::__('item', null, 'dpVenta') ?></th>
                            <th><?php echo i18n::__('n', null, 'pCompra') ?></th>
                            <th>  <?php echo i18n::__('animal', null, 'animal') ?></th>
                            <th>  <?php echo i18n::__('valor', null, 'dpVenta') ?></th>
<!--                            <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                            <th><?php echo i18n::__('action') ?></th>
                            <?php endif; ?> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objDetalleFacturaVenta as $key): ?>
                            <tr>
                                     <!--<?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                <td><input type="checkbox" name="chk[]" value="//<?php echo $key->id ?>"></td>
                               <?php endif; ?> -->
                                <td><?php echo $key->$idDetalle ?></td>
                                <td><?php echo $key->$proceso_venta ?></td>
                                <td><?php echo $key->$animal ?></td>
                                <td><?php echo $key->$valor ?></td>
<!--                            <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                                <td>
<!--                                    <a id="editarDetalle<?php echo $countDetale ?>" href="#" class="btn btn-default active btn-sm fa fa-edit" data-toggle="modal" data-target="" onclick="myModalDetailEdit(<?php echo $key->$idDetalle ?>, '<?php echo detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::VENTA, true) ?>', <?php echo $key->$proceso_venta ?>, '<?php echo detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::ID, true) ?>')"></a>
                                    <div class="mdl-tooltip mdl-tooltip--large" for="editarDetalle<?php echo $countDetale ?>">
                                      <?php echo i18n::__('editDetalle', null, 'ayuda') ?>
                                  </div>  -->
<!--                                  <a id="eliminarDetalle<?php echo $countDetale ?>" href="#changeState<?php echo $key->$idDetalle ?>" class="btn btn-sm btn-default fa fa-ban" ></a>
                  <div class="mdl-tooltip mdl-tooltip--large" for="eliminarDetalle<?php echo $countDetale ?>">
                    <?php echo i18n::__('inhabilitarDetalle', null, 'ayuda') ?>
                  </div>  
                                </td>
                                <?php endif; ?> -->
                            </tr>
                    <?php  $countDetale++ ?>         
            <?php endforeach//close foreach  ?>
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
                        <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('close', null, 'vacunacion') ?></a>
                        <button type="button" class="btn btn-primary fa fa-ban" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
                    </div>
                </div>
            </div>
        </div>

     
    </div>
</main>
    <!-- WINDOWS MODAL CHANGE STATE -->
                     <div id="changeState<?php echo $key->$idDetalle ?>" class="modalmask">
                            <div class="modalbox rotate">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('inhDetalle') ?></h4>
                                </div>
                                <a href="#close" title="Close" class="close">X</a>
                                <div class="modal-body">
                                    <?php echo i18n::__('confirmDetalle') ?>
                                </div>
                                <div class="modal-footer">
                                    <a href="#close2" title="Close" class="close2 btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('cancel') ?></a>
                                    <button type="button" class="btn btn-primary fa fa-ban" onclick="eliminar(<?php echo $key->$idDetalle ?>, '<?php echo detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteDetalleFacturaVenta') ?>')"> <?php echo i18n::__('inhabil') ?></button>
                                </div>
                            </div>
                        </div>    
                </form>
                <!-- WINDOWS MODAL UPDATE DETAIL VACCINATION -->
<!--                <div class="modal fade" id="detailFormEdit" name="detailFormEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('editDetailVaccination', null, 'detalleVacunacion') ?>:</h4>
                            </div>
                            <div class="modal-body">

                                <form id="detailForm" class="form-horizontal" method="POST" action="<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'updateDetalleVacunacion') ?>">
                                    <input type="hidden" value="<?php // echo request::getInstance()->getServer('PATH_INFO') ?>" name="PATH_INFO">

                                    <input type="hidden" value="" id="<?php // echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>" name="<?php // echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>">
                                    <input type="hidden" id="<?php // echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID, true) ?>" value="" name="<?php // echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID, true) ?>">

                                    <h3> <?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></h3>
                                    <input type="datetime-local" name="<?php // echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true) ?>">
                                    <h3> <?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></h3>
                                    <select name="<?php // echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true) ?>">
                                        <option value="">...</option>
                                        <?php foreach ($objVacuna as $key): ?>
                                            <option value="<?php echo $key->id ?>"><?php echo $key->nombre_vacuna ?></option>
                                        <?php endforeach; //close foreach  ?>
                                    </select>
                                    <h3> <?php echo i18n::__('dosis', null, 'detalleVacunacion') ?></h3>
                                    <input type="text" name="<?php // echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true) ?>">
                                    <h3><?php echo i18n::__('accion') ?></h3>
                                    <select name="<?php // echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true) ?>">
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
                                <button type="button"  onclick="$('#detailForm').submit()">Insertar</button>
                                <input type="submit" class="btn btn-primary" value=<?php echo i18n::__('edit', null, 'user') ?>> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  -->
                
                   <!-- WINDOWS MODAL FILTER -->
        <div class="modalmask" id="myModalFilter">
            <div class="modalbox rotate">
              
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                    </div>
                <a href="#close" title="Close" class="close">X</a>
                    <div class="modal-body">
                        <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'viewFacturaVenta') ?>">
                            <input type="hidden" name="<?php // echo procesoVentaTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(procesoVentaTableClass::ID) ?>">
                            <table class="table table-bordered">
                              <tr>
                                    <th><?php echo i18n::__('numer', null, 'dpVenta') ?></th>
                                    <th>
                                        <input name="filter[numero]" type="number">
                                    </th>
                                </tr>
                                <tr>

                                    <th><?php echo i18n::__('animal') ?></th>
                                    <th>
                                        <select name="filter[animal]">
                                            <option value="">
                                                ...
                                            </option>
                                            <?php foreach ($objDetalleFacturaVenta as $key): ?>
                                                <option value="<?php echo $key->$id ?>">
                                                    <?php echo $key->$numero ?>
                                                </option>
                                            <?php endforeach; //close foreach  ?>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
                                    <th><?php echo i18n::__('valor', null, 'dpVenta') ?></th>
                                    <th>
                                        <input name="filter[valor]" type="number">
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
        <div class="modalmask" id="myModalReport" tabindex="-1" role="dialog" >
            <div class="modalbox rotate">
        
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                    </div>
                <a href="#close" title="Close" class="close">X</a>
                    <div class="modal-body">
                        <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'reportDetalleFacturaVenta') ?>">
                            <input type="hidden" name="<?php echo procesoVentaTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(procesoVentaTableClass::ID) ?>">
                            <table class="table table-bordered">
                                <tr>
                                    <th><?php echo i18n::__('numer', null, 'dpVenta') ?></th>
                                    <th>
                                        <input name="filter[numero]" type="number">
                                    </th>
                                </tr>
                                <tr>

                                    <th><?php echo i18n::__('animal') ?></th>
                                    <th>
                                        <select name="filter[animal]">
                                            <option value="">
                                                ...
                                            </option>
                                            <?php foreach ($objDetalleFacturaVenta as $key): ?>
                                                <option value="<?php echo $key->$id ?>">
                                                    <?php echo $key->$numero ?>
                                                </option>
                                            <?php endforeach; //close foreach  ?>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
                                    <th><?php echo i18n::__('valor', null, 'dpVenta') ?></th>
                                    <th>
                                        <input name="filter[valor]" type="number">
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
