<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = procesoVentaTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $cliente = clienteTableClass::NOMBRE ?>
<?php $animal = animalTableClass::NUMERO ?>
<?php $idAnimal = animalTableClass::ID ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('factura', ((isset($objFacturaVenta) == TRUE) ? 'updateFacturaVenta' : 'createFacturaVenta')) ?>">
    <?php if (isset($objFacturaCompra)): ?>
      <input type="hidden" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, TRUE) ?>" value="<?php echo $objFacturaCompra[0]->$id ?>">
    <?php endif; //close if  ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <div class="table-responsive">
                    <table class="table "> 
                        <tr>
                            <th>
                                <?php echo i18n::__('fechaFactura', null, 'facturaCompra') ?>
                            </th>
                            <th>
                                <input type="datetime-local" name="<?php echo procesoVentaTableClass::getNameField(procesoVentaTableClass::FECHA_HORA_VENTA, true) ?>">
                            </th>   

                        </tr>
                        <tr>
                            <th>  
                                <?php echo i18n::__('empleado') ?>:
                            </th>
                            <th> 
                                <select name="<?php echo procesoVentaTableClass::getNameField(procesoVentaTableClass::EMPLEADO_ID, true) ?>">
                                    <option value="">...</option>
                                    <?php foreach ($objEmpleado as $key): ?>
                                      <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreEmpleado ?></option>
                                    <?php endforeach; //close foreach  ?>
                                </select>
                            </th>   

                        </tr>

                        <tr>
                            <th>  
                                <?php echo i18n::__('cliente') ?>:
                            </th>
                            <th> 
                                <select name="<?php echo procesoVentaTableClass::getNameField(procesoVentaTableClass::CLIENTE_ID, true) ?>">
                                    <option value="">...</option>
                                    <?php foreach ($objCliente as $key): ?>
                                      <option value="<?php echo $key->$id ?>"> <?php echo $key->$cliente ?></option>
                                    <?php endforeach; //close foreach  ?>
                                </select>
                            </th>   

                        </tr> 
                                 <tr>
                            <th>  
                                <?php echo i18n::__('identificacion') ?>:
                            </th>
                            <th> 
                                <select name="<?php echo procesoVentaTableClass::getNameField(procesoVentaTableClass::ANIMAL, true) ?>">
                                    <option value="">...</option>
                                    <?php foreach ($objAnimal as $key): ?>
                                      <option value="<?php echo $key->$idAnimal ?>"> <?php echo $key->$animal ?></option>
                                    <?php endforeach; //close foreach  ?>
                                </select>
                            </th>   

                        </tr>
                              <tr>
                            <th>
                                <?php echo i18n::__('kg', null, 'animal') ?>
                            </th>
                            <th>
                                <input type="number" name="<?php echo procesoVentaTableClass::getNameField(procesoVentaTableClass::PESO, true) ?>">
                            </th>   

                        </tr>
                                  <tr>
                            <th>
                                <?php echo i18n::__('valor_kilo') ?>
                            </th>
                            <th>
                                <input type="number" name="<?php echo procesoVentaTableClass::getNameField(procesoVentaTableClass::VALOR, true) ?>">
                            </th>   

                        </tr>
                         <tr>
                <th colspan="2">  
                    <font size="2">* <?php echo i18n::__('ojo', null, 'facturaCompra') ?></font>
                </th>
            </tr>
                        <tr>
                            <th colspan="2">
                        <div class="text-center">
                            <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objFacturaCompra) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
                        </div>
                        </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
       <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaVenta') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
</form>
</div>
</main>
