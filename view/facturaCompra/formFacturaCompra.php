<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = procesoCompraTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $nombreProveedor = proveedorTableClass::NOMBRE ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('factura', ((isset($objFacturaCompra) == TRUE) ? 'updateFacturaCompra' : 'createFacturaCompra')) ?>">
  <?php if (isset($objFacturaCompra)): ?>
    <input type="hidden" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, TRUE) ?>" value="<?php echo $objFacturaCompra[0]->$id ?>">
  <?php endif; //close if  ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-6-offset-3">
 
          <table class="table table-responsive "> 
                          <tr>
              <th>
                <?php echo i18n::__('numero de documento') ?>
              </th>
              <th>
                  <input type="number" name="<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::NUMERO, true) ?>">
              </th>   

            </tr>
            <tr>
              <th>
                <?php echo i18n::__('fechaFactura', null, 'facturaCompra') ?>
              </th>
              <th>
                <input type="datetime-local" name="<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::FECHA_HORA_COMPRA, true) ?>">
              </th>   

            </tr>
            <tr>
              <th>  
                <?php echo i18n::__('empleado') ?>:
              </th>
              <th> 
                <select name="<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true) ?>">
                  <option value="">...</option>
                  <?php foreach ($objEmpleado as $key): ?>
                    <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreEmpleado ?></option>
                  <?php endforeach; //close foreach  ?>
                </select>
              </th>   

            </tr>

            <tr>
              <th>  
                <?php echo i18n::__('proveedor') ?>:
              </th>
              <th> 
                <select name="<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true) ?>">
                  <option value="">...</option>
                  <?php foreach ($objProveedor as $key): ?>
                    <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreProveedor ?></option>
                  <?php endforeach; //close foreach  ?>
                </select>
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
</form>
</div>
</main>