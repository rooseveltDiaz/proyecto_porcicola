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
<?php $id = procesoCompraTableClass::ID ?>
<?php $fecha = procesoCompraTableClass::FECHA_HORA_COMPRA ?>
<?php $empleado = empleadoTableClass::NOMBRE ?>
<?php $proveedor = proveedorTableClass::NOMBRE ?>
<?php $estado = procesoCompraTableClass::ACTIVA ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $nombreProveedor = proveedorTableClass::NOMBRE ?>
<?php $numero = procesoCompraTableClass::NUMERO ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-12 text-center">

                    <h2>
                        <?php echo i18n::__('factura', null, 'facturaCompra') ?> 
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                        <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'insertFacturaCompra') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="new">
                            <?php echo i18n::__('registrar', null, 'ayuda') ?>
                        </div>

                    <?php endif; ?>
                    <a id="filter" href="#myModalFilter" class="btn btn-sm btn-info active fa fa-search"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                        <?php echo i18n::__('buscar', null, 'ayuda') ?>
                    </div>
                    <a id="deleteFilter" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFilterFacturaCompra') ?>" class="btn btn-sm btn-primary fa fa-reply" ></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                        <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                    </div>
                      <a id="buscarReporteDetalle" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'reportCompra') ?>" class="btn btn-primary active btn-sm fa fa-download" ></a>
                     <div class="mdl-tooltip mdl-tooltip--large" for="buscarReporteDetalle">
                        <?php echo i18n::__('reporte', null, 'ayuda') ?>
                    </div>
<!--                   <a href="#myModalReport" data-toggle="modal" id="buscarReporteDetalle" class="btn btn-primary active btn-sm fa fa-newspaper-o"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="buscarReporteDetalle">
                        <?php echo i18n::__('buscarReporteDet', null, 'ayuda') ?>
                    </div>-->
                </div>
            </div>
            <?php view::includeHandlerMessage() ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="success">
                            <!--       <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                   <th><input type="checkbox" id="chkAll"></th>
                            <?php endif; ?> -->
                            <th><?php echo i18n::__('numberDoc', null, 'datos') ?> </th>
                            <th><?php echo i18n::__('fechaFactura', null, 'facturaCompra') ?> </th>
                            <th><?php echo i18n::__('empleado') ?> </th>
                            <th><?php echo i18n::__('proveedor', null, 'proveedor') ?> </th>
                            <th><?php echo i18n::__('action') ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objFacturaCompra as $key): ?>
                            <tr> 
                                <!--     <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                     <td>
                                    <?php if ($key->$estado == true): ?> 
                                             <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectVacunacion') ?>" method="POST">
                                               <input type="checkbox" name="chk[]" value="<?php echo $key->id ?>">
                                             </form>
                                    <?php endif; //close if   ?>
                                     </td>
                                <?php endif; //close if   ?> -->
                 <!--                <td><?php echo $key->$numero . ' ' . (($key->$estado == true) ? '' : 'Factura inhabilitada') ?></td>-->
                                <td><?php echo $key->$numero ?> </td>
                                <td><?php echo date("Y-M-d G:i", strtotime($key->$fecha)) ?></td>
                                <td><?php echo $key->$empleado ?></td>
                                <td><?php echo $key->$proveedor ?></td>
                                <td>  
                                    <?php if ($key->$estado == true): ?>
                                        <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                                   <!--<a id="edit<?php echo $countDetale ?>" href="<?php // echo routing::getInstance()->getUrlWeb('factura', 'editFacturaCompra', array(procesoCompraTableClass::ID => $key->$id))               ?>" class="btn btn-default active btn-sm fa fa-edit"></a>-->
                                            <div class="mdl-tooltip mdl-tooltip--large" for="edit<?php echo $countDetale ?>">
                                                <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                            </div>  

                                            <a id="insertDetalle<?php echo $countDetale ?>" href="#myModalDetail<?php echo $key->$id ?>" class="btn btn-sm btn-primary fa fa-bars" data-toggle="modal" data-target="#myModalDetail<?php echo $key->$id ?>" ></a>
                                            <div class="mdl-tooltip mdl-tooltip--large" for="insertDetalle<?php echo $countDetale ?>">
                                                <?php echo i18n::__('insertFactura', null, 'ayuda') ?>
                                            </div> 
                                        <?php endif; ?>
                                        <a   id="verDetalle<?php echo $countDetale ?>"  href="<?php echo routing::getInstance()->getUrlWeb('factura', 'viewFacturaCompra', array(procesoCompraTableClass::ID => $key->$id)) ?>" class="btn btn-primary active btn-sm fa fa-eye"> </a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="verDetalle<?php echo $countDetale ?>">
                                            <?php echo i18n::__('verDetalleFact', null, 'ayuda') ?>
                                        </div>  
                                    <?php endif ?>
                                    <!--    <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                                                       <a id="habilitar<?php echo $countDetale ?>"  href="#changeState<?php echo $key->$id ?>" class=" btn btn-sm btn-default fa fa-ban" ></a>
                                                                       <div class="mdl-tooltip mdl-tooltip--large" for="habilitar<?php echo $countDetale ?>">
                                        <?php echo i18n::__('inhabilitar', null, 'ayuda') ?>
                                                                       </div> 
                                    <?php endif; ?> -->
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <!-- WINDOWS MODAL CHANGE STATE -->
                        <div id="changeState<?php echo $key->$id ?>" class="modalmask">
                            <div class="modalbox rotate">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('inhRegistro') ?></h4>
                                </div>
                                <a href="#close" title="Close" class="close">X</a>
                                <div class="modal-body">
                                    <?php echo i18n::__('confirmInhabil') ?>
                                </div>
                                <div class="modal-footer">
                                    <a href="#close2" title="Close" class="close2 btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('cancel') ?></a>
                                    <button type="button" class="btn btn-primary fa fa-ban" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFacturaCompra') ?>')"> <?php echo i18n::__('inhabil') ?></button>
                                </div>
                            </div>
                        </div>

                        </td>
                        </tr>
                        <tr>
                            <th>
                                <!-- WINDOWS MODAL DELETE -->
                        <div id="changeState<?php echo $key->$id ?>" class="modalmask">
                            <div class="modalbox rotate">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('inhabilitar') ?></h4>
                                </div>
                                <a href="#close" title="Close" class="close">X</a>
                                <div class="modal-body">
                                    <?php echo i18n::__('confirmInhabilitar') ?>
                                </div>
                                <div class="modal-footer">
                                    <a href="#close2" title="Close" class="close2 btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('cancel') ?></a>
                                    <button type="button" class="btn btn-primary fa fa-ban"  onclick="eliminar(<?php echo $key->$id ?>, '<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFacturaCompra') ?>')" > <?php echo i18n::__('inhabil') ?></button>
                                </div>
                            </div>
                        </div>


                        <!-- WINDOWS MODAL DETAIL -->
                        <div id="myModalDetail<?php echo $key->$id ?>" class="modalmask">
                            <div class="modalbox rotate">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('insertDetail', null, 'vacunacion') ?></h4>
                                </div>
                                <a href="#close" title="Close" class="close">X</a>
                                <form id="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'createDetalleFacturaCompra') ?>">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?php echo $key->$id ?>" name="<?php echo detalleProcesoCompraBaseTableClass::getNameField(detalleProcesoCompraTableClass::PROCESO_COMPRA_ID, true) ?>">
                                        <table class="table table-bordered"> 
                                            <tr><th>
                                                    <?php echo i18n::__('tipoInsumo') ?></th><th>
                                                    <select name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::TIPO_INSUMO, true) ?>">
                                                        <option value="">...</option>
                                                        <?php foreach ($objTipoInsumo as $key): ?>
                                                            <option value="<?php echo $key->id ?>"><?php echo $key->descripcion ?></option>
                                                        <?php endforeach; //close foreach    ?>
                                                    </select>
                                                </th></tr>
                                            <tr><th>
                                                    <?php echo i18n::__('insumo') ?></th><th>
                                                    <select name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::INSUMO_ID, true) ?>">
                                                        <option value="">...</option>
                                                        <?php foreach ($objInsumo as $key): ?>
                                                            <option value="<?php echo $key->id ?>"><?php echo $key->nombre_insumo ?></option>
                                                        <?php endforeach; //close foreach    ?>
                                                    </select>
                                                </th>
                                            </tr>
                                            <tr><th>
                                                    <?php echo i18n::__('cantidad') ?></th><th>
                                                    <input type="number" name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::CANTIDAD, true) ?>">
                                                </th>
                                            </tr>
                                            <tr><th>
                                                    <?php echo i18n::__('valorUni') ?></th><th>
                                                    <input type="number" name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::VALOR_UNITARIO, true) ?>">

                                                    <font size="2">* <?php echo i18n::__('oblig', null, 'insumo') ?></font>
                                            <tr><th colspan="2">  
                                                    <font size="2">* <?php echo i18n::__('ojo', null, 'facturaCompra') ?></font>
                                                </th></tr>
                                        </table>
                                    </div>


                                    <div class="modal-footer">
                                        <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></a>
                                        <button type="submit" class="btn btn-info active fa fa-plus-square" >Insertar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                </div>
            </div>


            </th>
            </tr>

            <?php $countDetale++ ?>
        <?php endforeach//close foreach    ?>
        </tbody>
        </table>
    </div>

    <!-- PAGINATOR -->
    <div class="text-right">
        <nav>
            <ul class="pagination" id="slqPaginador">
                <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                <?php $count = 0 ?>
                <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                    <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                    <?php $count ++ ?>        
                <?php endfor//close for   ?>
                <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
            </ul>
        </nav>
    </div>
    <form id="frmDelete" action="<?php //echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacunacion')                ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true) ?>">
    </form>
</div>
</div>
</main>
<!-- WINDOWS MODAL DELETE MASIVE -->
<div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('inhMasa') ?></h4>
            </div>
            <div class="modal-body">

                <?php echo i18n::__('conInhSel') ?>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('cancel') ?></a>
                <button type="button" class="btn btn-primary fa fa-ban" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
            </div>
        </div>
    </div>
</div>



<!-- WINDOWS MODAL FILTER -->
<div id="myModalFilter" class="modalmask">
    <div class="modalbox rotate">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
        </div>
        <a href="#close" title="Close" class="close">X</a>
        <div class="modal-body">
            <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>">
                <table>
                    <tr>
                        <th>
                            <?php echo i18n::__('fechaInicio') ?>
                        </th>
                        <th>
                            <input type="datetime-local" name="filter[fecha_inicio]">
                        </th>   

                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('fechaFin') ?>
                        </th>
                        <th>
                            <input type="datetime-local" name="filter[fecha_fin]">
                        </th>   

                    </tr>

                </table>

            </form>
        </div>
        <div class="modal-footer">
            <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" ><?php echo i18n::__('close', null, 'vacunacion') ?></a>
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
            <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'reportCompra') ?>">

                <table class="table table-bordered">
<tr>
                        <th>
                            <?php echo i18n::__('fechaInicio') ?>
                        </th>
                        <th>
                            <input type="datetime-local" name="report[fecha_inicio]">
                        </th>   

                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('fechaFin') ?>
                        </th>
                        <th>
                            <input type="datetime-local" name="report[fecha_fin]">
                        </th>   

                    </tr>
        <tr>
                <th>
                  <?php echo i18n::__('empleado') ?>:
                </th>
                <th>
                  <select name="report[empleado]"> 
                    <option>...</option>
                    <?php foreach ($objEmpleado as $key): ?>
                      <option value="<?php echo $key->id ?>">
                        <?php echo $key->nombre_completo ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </th>
              </tr>
                 <tr>
                <th>
                  <?php echo i18n::__('proveedor', null, 'proveedor') ?>:
                </th>
                <th>
                  <select name="report[proveedor]"> 
                    <option>...</option>
                    <?php foreach ($objProveedor as $key): ?>
                      <option value="<?php echo $key->id ?>">
                        <?php echo $key->nombre_completo_proveedor ?>
                      </option>
                    <?php endforeach; ?>
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