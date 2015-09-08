<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = insumoTableClass::ID ?>
<?php $nombre = insumoTableClass::NOMBRE ?>
<?php $fabricacion = insumoTableClass::FECHA_FABRICACION ?>
<?php $vencimiento = insumoTableClass::FECHA_VENCIMIENTO ?>
<?php $tipoInsumo = tipoInsumoTableClass::DESCRIPCION ?>
<?php $id_tipoInsumo = tipoInsumoTableClass::ID ?>
<?php $idTipoInsumo = insumoTableClass::TIPO_INSUMO ?>
<?php $valor = insumoTableClass::VALOR ?>
<?php $cantidad = insumoTableClass::CANTIDAD ?>
<?php $stock = insumoTableClass::STOCK_MINIMO ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('insumo', ((isset($objInsumo) == TRUE) ? 'update' : 'create')) ?>">
    <?php if (isset($objInsumo)): ?>
        <input type="hidden" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, TRUE) ?>" value="<?php echo $objInsumo[0]->$id ?>">
    <?php endif; //close if  ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">
                <div class="table-responsive">
                <table class="table ">    
                    <tr>
                        <th>  <?php echo i18n::__('tipoInsumo') ?>:</th>
                        <th>
                            <select name="<?php echo insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true) ?>">
                                <option value=<?php echo null ?>>...</option>
                                <?php foreach ($objTipoInsumo as $key): ?>
                                    <option value="<?php echo $key->$id_tipoInsumo ?>"><?php echo $key->$tipoInsumo ?></option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('insumo', NULL, 'insumo') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objInsumo) == FALSE) ? i18n::__('insumo', NULL, 'insumo') : $objInsumo[0]->$nombre = ucwords($objInsumo[0]->$nombre)) ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('fechaFabricacion') ?>:</th>
                        <th> <input  type="date" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('fechaVencimiento') ?>:</th>
                        <th> <input  type="date" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true) ?>" ></th>   
                    </tr>

                    <tr>
                        <th>  <?php echo i18n::__('valorInsumo') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objInsumo) == FALSE) ? i18n::__('valorInsumo') : $objInsumo[0]->$valor = ucwords($objInsumo[0]->$valor)) ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::VALOR, true) ?>" ><font size="2">* <?php echo i18n::__('oblig', null, 'insumo') ?></font></th>   
                    </tr>
                    <?php if (!isset($objInsumo)): ?>
                        <tr>
                            <th>  <?php echo i18n::__('cantidad') ?>:</th>
                            <th> <input placeholder="<?php echo ((isset($objInsumo) == FALSE) ? i18n::__('cantidad') : $objInsumo[0]->$cantidad = ucwords($objInsumo[0]->$cantidad)) ?>" type="number" name="<?php echo insumoTableClass::getNameField(insumoTableClass::CANTIDAD, true) ?>" ><font size="2">* <?php echo i18n::__('oblig1', null, 'insumo') ?></font></th>   
                        </tr>
                        <tr>
                            <th>  <?php echo i18n::__('stock') ?>:</th>
                            <th> <input placeholder="<?php echo ((isset($objInsumo) == FALSE) ? i18n::__('stock') : $objInsumo[0]->$stock = ucwords($objInsumo[0]->$stock)) ?>" type="number" name="<?php echo insumoTableClass::getNameField(insumoTableClass::STOCK_MINIMO, true) ?>" ><font size="2">* <?php echo i18n::__('oblig2', null, 'insumo') ?></font></th>   
                        </tr>
                    <?php endif ?>
                    <tr>
                        <th colspan="2">
                    <div class="text-center">
                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objInsumo) == TRUE) ? 'edit' : 'register'), NULL, 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
         <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
</form>
</div>
</main>