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
<?php $id = procesoVentaTableClass::ID ?>
<?php $fecha = procesoVentaTableClass::FECHA_HORA_VENTA ?>
<?php $empleado = empleadoTableClass::NOMBRE ?>
<?php $cliente = clienteTableClass::NOMBRE ?>
<?php $estado = procesoVentaTableClass::ACTIVA ?>


<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-12 text-center">

                    <h2>
                        <?php echo i18n::__('facturaVenta') ?>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                        <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'insertFacturaVenta') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="new">
                            <?php echo i18n::__('registrar', null, 'ayuda') ?>
                        </div>

                    <?php endif; ?>
                    <a id="filter" href="#myModalFilter" class="btn btn-sm btn-info active fa fa-search"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                        <?php echo i18n::__('buscar', null, 'ayuda') ?>
                    </div>
                    <a id="deleteFilter" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFilterFacturaVenta') ?>" class="btn btn-sm btn-primary fa fa-reply" ></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                        <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                    </div>
                    <a id="reporte" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'reportVenta') ?>" class="btn btn-primary active btn-sm fa fa-download" ></a>
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
                            <!--       <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                           <th><input type="checkbox" id="chkAll"></th>
                            <?php endif; ?> -->

                            <th><?php echo i18n::__('fechaFactura', null, 'facturaCompra') ?> </th>
                            <th><?php echo i18n::__('empleado') ?> </th>
                            <th><?php echo i18n::__('cliente', null, 'cliente') ?> </th>
                            <th><?php echo i18n::__('action') ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objFacturaVenta as $key): ?>
                            <tr> 
                                <!--     <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                             <td>
                                    <?php if ($key->$estado == true): ?> 
                                                       
                                    <?php endif; //close if   ?>
                                             </td>
                                <?php endif; //close if   ?> -->
                 <!--                <td><?php echo $key->$id . ' ' . (($key->$estado == true) ? '' : 'Factura inhabilitada') ?></td>-->

                                <td><?php echo date("Y-M-d G:i", strtotime($key->$fecha)) ?></td>
                                <td><?php echo $key->$empleado ?></td>
                                <td><?php echo $key->$cliente ?></td>
                                <td>  
                                    <?php if ($key->$estado == true): ?>
                                        <?php if (session::getInstance()->hasCredential('admin') == 1): ?>


                                            <a id="insertDetalle<?php echo $countDetale ?>" href="#myModalDetail<?php echo $key->$id ?>" class="btn btn-sm btn-primary fa fa-bars" data-toggle="modal" data-target="#myModalDetail<?php echo $key->$id ?>" ></a>
                                            <div class="mdl-tooltip mdl-tooltip--large" for="insertDetalle<?php echo $countDetale ?>">
                                                <?php echo i18n::__('insertFactura', null, 'ayuda') ?>
                                            </div> 
                                        <?php endif; ?>
                                        <a   id="verDetalle<?php echo $countDetale ?>"  href="<?php echo routing::getInstance()->getUrlWeb('factura', 'viewFacturaVenta', array(procesoVentaTableClass::ID => $key->$id)) ?>" class="btn btn-primary active btn-sm fa fa-eye"> </a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="verDetalle<?php echo $countDetale ?>">
                                            <?php echo i18n::__('verDetalleFact', null, 'ayuda') ?>
                                        </div>  
                                    <?php endif ?>

                                    </div> 
                                </td>
                            </tr>

                            <tr>
                                <th>



                                    <!-- WINDOWS MODAL DETAIL -->
                        <div id="myModalDetail<?php echo $key->$id ?>" class="modalmask">
                            <div class="modalbox rotate">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('insertDetail', null, 'vacunacion') ?></h4>
                                </div>
                                <a href="#close" title="Close" class="close">X</a>
                                <form id="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'createDetalleFacturaVenta') ?>">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?php echo $key->$id ?>" name="<?php echo detalleProcesoVentaBaseTableClass::getNameField(detalleProcesoVentaBaseTableClass::VENTA, true) ?>">
                                        <table class="table table-bordered"> 
                                            <tr><th>
                                                    <?php echo i18n::__('animal') ?></th><th>

                                                    <select name="<?php echo detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::ANIMAL, true) ?>">
                                                        <option value="">...</option>
                                                        <?php foreach ($objAnimal as $key): ?> 

                                                            <option value="<?php echo $key->id ?>"><?php echo $key->numero_identificacion ?></option>
                                                        <?php endforeach; //close foreach    ?>
                                                    </select>
  <tr><th>
                                                    <?php echo i18n::__('peso_final') ?></th><th>
                                                    <input type="number" name="<?php echo detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::PESO, true) ?>">
                                                </th>
                                            </tr>
                                            <tr><th>
                                                    <?php echo i18n::__('valor_kilo') ?></th><th>
                                                    <input type="number" name="<?php echo detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::VALOR, true) ?>">
                                                </th>
                                            </tr>
                                            
                                          



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
                <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaVenta') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                <?php $count = 0 ?>
                <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                    <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaVenta') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                    <?php $count ++ ?>        
                <?php endfor//close for   ?>
                <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaVenta') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
            </ul>
        </nav>
    </div>
    <form id="frmDelete" action="<?php //echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacunacion')                  ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo procesoVentaTableClass::getNameField(procesoVentaTableClass::ID, true) ?>">
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
            <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaVenta') ?>">
                <table>
        <!--          <tr>
                    <th>
                    <?php // echo i18n::__('fechaInicio') ?>
                    </th>
                    <th>
                      <input type="datetime-local" name="filter[fecha_inicio]">
                    </th>   
        
                  </tr>-->
                    <tr>
                        <th>
                            <?php echo i18n::__('cliente') ?>
                        </th>
                        <th>
                            <select name="filter[cliente]">
                                <option value="">...</option>
                                <?php foreach ($objCliente as $key): ?>
                                    <option value="<?php echo $key->id ?>"> <?php echo $key->nombre_completo_cliente ?></option>
                                <?php endforeach; //close foreach    ?>
                            </select>
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
