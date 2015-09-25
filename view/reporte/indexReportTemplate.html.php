<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\view\viewClass as view ?>
<?php $id = reporteTableClass::ID ?>
<?php $nombre = reporteTableClass::NOMBRE ?>
<?php $descripcion = reporteTableClass::DESCRIPCION ?>
<?php $direccion = reporteTableClass::DIRECCION ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 text-center">
                    <h2> 
                        <i class="fa fa-leanpub"></i>
                        <?php echo i18n::__('s') ?>
                    </h2>
                </div>
            </div>
            <div class="table-responsive text-center">
                <table class="table table-bordered">
                    <thead>
                        <tr class=" mdl-color--teal-300 mdl-color-text--blue-grey-900">

                            <th><?php echo i18n::__('name', null, 'empleado') ?></th>
                            <th><?php echo i18n::__('descripcion') ?></th>
                            <th><?php echo i18n::__('buscar') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objReporte as $key): ?>
                            <tr>
                                <th><?php echo $key->$nombre ?></th>
                                <th><?php echo $key->$descripcion ?></th>
                                <th>
                                    <a id="filter <?php echo $countDetale ?>" href="#myModalFilter<?php echo $key->id ?>" data-toggle="modal" class="fa fa-search-plus"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="filter <?php echo $countDetale ?>">
                            <?php echo i18n::__('buscarReporteDet', null, 'ayuda') ?>
                        </div>
                        </th>
                        </tr>
<!--                                       <tr>
                            <th colspan="2">
                        <div class="text-center">
                             <a href="#myModalReport" data-toggle="modal" id="informe" class="btn btn-primary active btn-sm glyphicon glyphicon-piggy-bank"></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="informe">
                        <?php echo i18n::__('buscarReporteDetHoja', null, 'ayuda') ?>
                    </div>

                                        <a id="gestacion" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportGestacion') ?>" class="btn btn-primary active btn-sm fa fa-paw" ></a>
                         <div class="mdl-tooltip mdl-tooltip--large" for="gestacion">
                        <?php echo i18n::__('buscarReporteDetGes', null, 'ayuda') ?>
                    </div>
                          <a id="parto" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportRegistroParto') ?>" class="btn btn-primary active btn-sm fa fa-history" ></a>
                         <div class="mdl-tooltip mdl-tooltip--large" for="parto">
                        <?php echo i18n::__('buscarReporteDetPar', null, 'ayuda') ?>
                    </div>
                                 <a id="peso" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportRegistroPeso') ?>" class="btn btn-primary active btn-sm fa fa-ship" ></a>
                         <div class="mdl-tooltip mdl-tooltip--large" for="peso">
                        <?php echo i18n::__('buscarReporteDetPes', null, 'ayuda') ?>
                    </div>
                                               <a id="vacunacion" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportCarneVacunas') ?>" class="btn btn-primary active btn-sm fa fa-heartbeat" ></a>
                         <div class="mdl-tooltip mdl-tooltip--large" for="vacunacion">
                        <?php echo i18n::__('buscarReporteDetVac', null, 'ayuda') ?>
                    </div>
                        </div>
                </th>
                        </tr>-->
                        <tr>
                            <th>
                                <!-- WINDOWS MODAL FILTER -->
                        <div id="myModalFilter<?php echo $key->id ?>" class="modalmask">
                            <div class="modalbox rotate">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                                </div>
                                <a href="#close" title="Close" class="close">X</a>
                                <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('reporte', 'indexReportGenerales') ?>">
                                    <div class="modal-body">
                                        <table>
                                            <tr>
                                                <th>
                                                    <?php echo i18n::__('fechaInicio') ?>
                                                </th>
                                                <th>
                                                    <input type="date" name="filter[fecha_inicio]">
                                                </th>   

                                            </tr>
                                            <tr>
                                                <th>
                                                    <?php echo i18n::__('fechaFin') ?>
                                                </th>
                                                <th>
                                                    <input type="date" name="filter[fecha_fin]">
                                                </th>   

                                            </tr>
                                        </table>

                                    </div>
                                    <div class="modal-footer">
                                        <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" ><?php echo i18n::__('close', null, 'vacunacion') ?></a>
                                        <button type="submit" class="btn btn-info fa fa-search" ><?php echo i18n::__('buscar') ?></button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        </th>
                        </tr>
                        <?php $countDetale++ ?>
                    <?php endforeach//close foreach    ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
                        <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('reporte', 'indexReport') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                        <?php $count = 0 ?>
                        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                            <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('reporte', 'indexReport') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                            <?php $count ++ ?>        
                        <?php endfor //close for    ?>
                        <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('reporte', 'indexReport') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div>#
        </div>
    </div>
</main>

