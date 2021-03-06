
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\config\configClass as config ?>
<?php $proceso_compra = procesoCompraTableClass::ID ?>
<?php $fecha = procesoCompraTableClass::FECHA_HORA_COMPRA ?>
<?php $idDetalle = detalleProcesoCompraTableClass::ID ?>
<?php $id = tipoInsumoTableClass::ID ?>
<?php $descripcion = tipoInsumoTableClass::DESCRIPCION ?>
<?php $idI = insumoTableClass::ID ?>
<?php $nombre = insumoTableClass::NOMBRE ?>
<?php $num_factura = procesoCompraTableClass::NUMERO ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">

            <br/> <br/>
            <?php echo i18n::__('fact', null, 'pCompra') ?>
            <br /> <br/>
            <div class=" table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="success">
<!--                             <th><?php echo i18n::__('Number of document', null, 'veterinario') ?></th>-->
                            <th><?php echo i18n::__('date', null, 'dpVenta') ?></th>
                            <th><?php echo i18n::__('empleado') ?></th>
                            <th><?php echo i18n::__('proveedor', null, 'proveedor') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objFacturaCompra as $key): ?>
                            <tr>
<!--                                <td><?php echo $key->$num_factura ?></td>-->
                                <td><?php echo date("Y-M-d h:m", strtotime($key->$fecha)) ?></td>
                                <td><?php echo $key->nombre_completo ?></td>
                                <td><?php echo $key->nombre_completo_proveedor ?></td>
                            </tr>
                                                                    
                        <?php endforeach//close foreach  ?>
                    </tbody>
                </table>
            </div>
            <br/> 
            <?php echo i18n::__('detalle', null, 'pCompra') ?>

            <div class="container container-fluid" style="margin-bottom: 10px">

                <br />  
<!--                  <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                          <a href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" id="eliminarSeleccionDetalle" class="btn btn-default btn-sm fa fa-ellipsis-v"></a>
                          <div class="mdl-tooltip mdl-tooltip--large" for="eliminarSeleccionDetalle">
                    <?php echo i18n::__('inhabilitarMasaDetalle', null, 'ayuda') ?>
                          </div>
                <?php endif; ?> -->
<!--                <a href="#myModalFilter" id="buscarDetalle" class="btn btn-sm btn-info active fa fa-search"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="buscarDetalle">
                    <?php echo i18n::__('buscar', null, 'ayuda') ?>
                </div>-->
                <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
<!--               
                <a href="#myModalReport" data-toggle="modal" id="buscarReporteDetalle" class="btn btn-primary active btn-sm fa fa-newspaper-o"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="buscarReporteDetalle">
                    <?php echo i18n::__('buscarReporteDet', null, 'ayuda') ?>
                </div>-->

          </div>

            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectDetalleVacunacion') ?>" method="POST">
                <div class=" table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="success">

                                <th><?php echo i18n::__('item') ?></th>
                                <th>  <?php echo i18n::__('insumo') ?></th>
                                <th>  <?php echo i18n::__('tipoInsumo') ?></th>
                                <th>  <?php echo i18n::__('cantidad') ?></th>
                                <th>  <?php echo i18n::__('valorUni') ?></th>
                                <th><?php echo i18n::__('subt') ?></th>

                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($objDetalleFacturaCompra as $key): ?>
                                <tr>
                                
                                    <td><?php echo $key->$idDetalle ?></td>
                                    <td><?php echo $key->nombre_insumo ?></td>
                                    <td><?php echo $key->descripcion ?></td>
                                    <td><?php echo $key->cantidad ?></td>
                                    <td><?php echo $key->valor_unitario ?></td>
                                    <td><?php echo $key->subtotal ?></td>
                    
                                </tr>
                                <tr>
                                    <th>
                                        
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
            <button type="button" class="btn btn-primary fa fa-ban" onclick="eliminar(<?php echo $key->$idDetalle ?>, '<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteDetalleFacturaCompra') ?>')"> <?php echo i18n::__('inhabil') ?></button>
        </div>
    </div>
</div>
                                        
                                        <!--WINDOWS MODAL FILTER--> 
                            <div class="modalmask" id="myModalFilter">
                                <div class="modalbox rotate">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                                    </div>
                                    <a href="#close" title="Close" class="close">X</a>
                                    <div class="modal-body">
                                        <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'viewFacturaCompra') ?>">
                                            <input type="hidden" name="<?php echo detalleProcesoCompraTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(detalleProcesoCompraTableClass::ID) ?>">
                                            <table class="table table-bordered">
                                                <tr>

                                                    <th><?php echo i18n::__('tipoInsumo') ?></th>
                                                    <th>
                                                        <select name="filter[tipo]">
                                                            <option value="">
                                                                ...
                                                            </option>
                                                            <?php foreach ($objDetalleFacturaCompra as $key): ?>
                                                                <option value="<?php echo $key->$id ?>">
                                                                    <?php echo $key->$descripcion ?>
                                                                </option>
                                                            <?php endforeach; //close foreach   ?>
                                                        </select>
                                                    </th>
                                                </tr>
                                                <tr>

                                                    <th><?php echo i18n::__('insumo', null, 'insumo') ?></th>
                                                    <th>
                                                        <select name="filter[insumo]">
                                                            <option value="">
                                                                ...
                                                            </option>
                                                            <?php foreach ($objDetalleFacturaCompra as $key): ?>
                                                                <option value="<?php echo $key->$idI ?>">
                                                                    <?php echo $key->$nombre ?>
                                                                </option>
                                                            <?php endforeach; //close foreach   ?>
                                                        </select>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th><?php echo i18n::__('cantidad') ?></th>
                                                    <th>
                                                        <input name="filter[cantidad]" type="number">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th><?php echo i18n::__('valorUni') ?></th>
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
                            </th>
                            </tr>
                            <?php $countDetale++ ?>         
                        <?php endforeach//close foreach   ?>
                        </tbody>
                    </table>
                </div>
        </div>
       


    </div>
       

                       
                    
</main>


 
<!--         WINDOWS MODAL REPORT -->
<div class="modalmask" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modalbox rotate">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
        </div>
        <a href="#close" title="Close" class="close">X</a>
        <div class="modal-body">
            <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'reportDetalleFacturaCompra') ?>">
                <input type="hidden" name="<?php echo procesoCompraTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(procesoCompraTableClass::ID) ?>">
                <table class="table table-bordered">

                    <tr>

                        <th><?php echo i18n::__('tipoInsumo') ?></th>
                        <th>
                            <select name="report[tipo]">
                                <option value="">
                                    ...
                                </option>
                                <?php foreach ($objDetalleFacturaCompra as $key): ?>
                                    <option value="<?php echo $key->$id ?>">
                                        <?php echo $key->$descripcion ?>
                                    </option>
                                <?php endforeach; //close foreach   ?>
                            </select>
                        </th>
                    </tr>
                    <tr>

                        <th><?php echo i18n::__('insumo') ?></th>
                        <th>
                            <select name="report[insumo]">
                                <option value="">
                                    ...
                                </option>
                                <?php foreach ($objDetalleFacturaCompra as $key): ?>
                                    <option value="<?php echo $key->$idI ?>">
                                        <?php echo $key->$nombre ?>
                                    </option>
                                <?php endforeach; //close foreach   ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th><?php echo i18n::__('cantidad') ?></th>
                        <th>
                            <input name="report[cantidad]" type="number">
                        </th>
                    </tr>
                    <tr>
                        <th><?php echo i18n::__('valorUni') ?></th>
                        <th>
                            <input name="report[valor]" type="number">
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

