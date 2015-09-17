<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\view\viewClass as view ?>
<?php $id = registroPesoTableClass::ID ?>
<?php $idAnimal = animalTableClass::ID ?>
<?php $numeroIdenficacion = animalTableClass::NUMERO ?>
<?php $id_empleado = empleadoTableClass::ID ?>
<?php $fecha = registroPesoTableClass::FECHA ?>
<?php $empleado = empleadoTableClass::NOMBRE ?>
<?php $peso = registroPesoTableClass::PESO ?>
<?php $kilo = registroPesoTableClass::KILO ?>
<?php $total = registroPesoTableClass::VALOR ?>

<?php $countDetale = 1 ?>
<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 text-center">
                    <h2>
                        <?php echo i18n::__('regPe', NULL, 'dpVenta') ?>
                    </h2>
<!--                    <h4>  <?php echo i18n::__('identificacion') ?>:
                    <?php echo $objPeso[0]->$numeroIdenficacion ?> </h4>-->
                </div>
            </div>
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelectRegistroPeso') ?>" method="POST">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <?php foreach ($objPeso as $key): ?>
                            <a id="atras" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexHojaVida') ?>"></a>
                            <div class="mdl-tooltip mdl-tooltip--large" for="atras">
                                <?php echo i18n::__('atras', null, 'ayuda') ?>
                            </div> 
                        <?php endforeach; ?>
                        <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                            <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertRegistroPeso', array(hojaVidaTableClass::getNameField(hojaVidaTableClass::ANIMAL) => $idAnimalSeleccionado)) ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                            <div class="mdl-tooltip mdl-tooltip--large" for="new">
                                <?php echo i18n::__('registrar', null, 'ayuda') ?>
                            </div>
                        <?php endif; ?>
                        <a id="filter" href="#myModalFilter" class="btn btn-sm btn-info active fa fa-search"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                            <?php echo i18n::__('buscar', null, 'ayuda') ?>
                        </div>
                        <a id="deleteFilter" class="btn btn-sm btn-primary fa fa-reply" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteFiltersRegistroPeso') ?>"></a>  
                        <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                        </div> 

                        <a id="report" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportRegistroPeso') ?>" class="btn btn-primary active btn-sm fa fa-download" ></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="report">
                            <?php echo i18n::__('reporte', null, 'ayuda') ?>
                        </div>

                    </div>
                </div>
                <?php view::includeHandlerMessage() ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="success">
                                <th><?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?></th>
                                <th><?php echo i18n::__('empleado') ?></th>
<!--                                <th><?php echo i18n::__('identification', null, 'animal') ?></th>-->
                                <th><?php echo i18n::__('peso', null, 'animal') ?></th>
                                <th><?php echo i18n::__('valor_kilo') ?></th>
                                <th><?php echo i18n::__('vaT', null, 'dpVenta') ?></th>
                                <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                    <th><?php echo i18n::__('action') ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>   
                        <tbody>
                            <?php foreach ($objPeso as $key): ?>
                                <tr>
                                    <td><?php echo $key->$fecha ?></td>
    <!--                                    <td><?php echo $key->$numeroIdenficacion ?></td>-->
                                    <td><?php echo $key->$empleado ?></td>
                                    <td><?php echo $key->$peso ?> Kg.</td>
                                    <td><?php echo $key->$kilo ?></td>
                                    <td><?php echo $key->$total ?></td>
                                    <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                        <td class="text-center">
                                            <a id="kilo<?php echo $countDetale ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" href="#modalInsert<?php echo $key->$id ?>"><i class="material-icons">add</i></a>
                                            <div class="mdl-tooltip mdl-tooltip--large" for="kilo<?php echo $countDetale ?>">
                                                <?php echo i18n::__('compra1', null, 'ayuda') ?>
                                            </div>  
        

                                        </td>
                                    <?php endif; ?>
                                </tr>


                                <?php $countDetale++ ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>

            <!----PAGINADOR---->
            <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
                        <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroPeso') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                        <?php $count = 0 ?>
                        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                            <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroPeso') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                            <?php $count++ ?>        
                        <?php endfor; ?>
                        <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroPeso') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>


    </div>

</main>


<!-- WINDOWS MODAL FILTER -->
<div class="modalmask" id="myModalFilter" >
    <div class="modalbox rotate">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
        </div>
        <a href="#close" title="Close" class="close">X</a>
        <div class="modal-body">
            <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroPeso') ?>">
                <table class="table table-bordered">
                    <tr>
                        <th>  <?php echo i18n::__('ini', NULL, 'gestacion') ?>:</th>
                        <th> <input  type="datetime-local" name="filter[fecha]" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('fin', NULL, 'gestacion') ?>:</th>
                        <th> <input  type="datetime-local" name="filter[fin]" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('empleado') ?>:</th>
                        <th>
                            <select name="filter[empleado]">
                                <option value=''>...</option>
                                <?php foreach ($objEmpleado as $key): ?>
                                    <option value="<?php echo $key->$id_empleado ?>"><?php echo $key->$empleado ?></option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('kg', null, 'animal') ?>:</th>
                        <th> <input  type="number" name="filter[peso]" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('valor_kilo') ?>:</th>
                        <th> <input  type="number" name="filter[kilo]" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('vaT', null, 'dpVenta') ?>:</th>
                        <th> <input  type="number" name="filter[total]" ></th>   
                    </tr>             

                    <div class="modal-footer">
                        <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" ><?php echo i18n::__('close', null, 'vacunacion') ?></a>
                        <button type="button" class="btn btn-info fa fa-search" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
                    </div>
                </table>
            </form>
        </div>
    </div>
</div>

<!-- WINDOWS MODAL AUMENTAR VALOR POR KILO -->
<div class="modalmask" id="modalInsert<?php echo $key->$id ?>">
    <div class="modalbox rotate">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('reg', null, 'ayuda') ?></h4>
        </div>
        <form id="detailForm" name="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'updateInsertRegistroPeso') ?>">
            <a href="#close" title="Close" class="close">X</a>

            <div class="modal-body">
                <font size="2">* <?php echo i18n::__('ingrese', null, 'ayuda') ?></font>
                <br/>
                <br/>
                <input type="hidden" name="<?php echo registroPesoTableClass::getNameField(registroPesoTableClass::ID, true) ?>" value="<?php echo $key->$id ?>">
                <?php echo i18n::__('valor_kilo') ?>
                <input type="number" name="<?php echo registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true) ?>">    


            </div>
            <div class="modal-footer">
                <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></a>
                <button type="submit" class="btn btn-info active fa fa-plus-square" ><?php echo i18n::__('insert', null, 'dpVenta') ?></button>

            </div>
        </form>
    </div>
</div>