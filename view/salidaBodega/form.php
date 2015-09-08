<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idSalida = salidaBodegaTableClass::ID?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $id = empleadoTableClass::ID ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('bodega', ((isset($objSalidaBodega) == TRUE) ? 'updateSalida' : 'createSalida')) ?>">
  <?php if (isset($objSalidaBodega)): ?>
  <input type="hidden" name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, TRUE) ?>" value="<?php echo $objSalidaBodega[0]->$idSalida ?>">
  <?php endif; //close if  ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-6-offset-3">
          <div class="table-responsive">
          <table class="table "> 
            <tr>
              <th>
                   <?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?>:
              </th>
              <th>
                <input type="datetime-local" name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true) ?>">
              </th>   

            </tr>
            <tr>
              <th>  
                <?php echo i18n::__('empleado', NULL, 'empleado') ?>:
              </th>
              <th> 
                <select name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO, true) ?>">
                  <option value="">...</option>
                  <?php foreach ($objEmpleado as $key): ?>
                    <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreEmpleado ?></option>
                  <?php endforeach; //close foreach  ?>
                </select>
              </th>   
            </tr>
            <tr>
              <th colspan="2">
            <div class="text-center">
                <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objSalidaBodega) == TRUE) ? 'edit' : 'register'))?>">
            </div>
            </th>
            </tr>
          </table>
          </div>
      </div>
    </div>
  </div>
   <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'indexSalida') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
</form>
</div>
</main>