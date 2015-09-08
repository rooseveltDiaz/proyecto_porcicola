<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $id = empleadoTableClass::ID ?>
<?php $idEntrada = entradaBodegaTableClass::ID ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('bodega', ((isset($objEntradaBodega) == TRUE) ? 'updateEntrada' : 'createEntrada')) ?>">
  <?php if (isset($objEntradaBodega)): ?>
    <input type="hidden" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID, TRUE) ?>" value="<?php echo $objEntradaBodega[0]->$idEntrada ?>">
  <?php endif; //close if  ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-6-offset-3">
  <table class="table table-responsive "> 
            <tr>
              <th>
                <?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?>:
              </th>
              <th>
                  <input type="datetime-local" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, true) ?>">
              </th>   

            </tr>
            <tr>
              <th>  
                <?php echo i18n::__('empleado') ?>:
              </th>
              <th> 
                <select name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO, true) ?>">
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
                <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objEntradaBodega) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
            </div>
            </th>
            </tr>
          </table>
      </div>
    </div>
  </div>
     <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'indexEntrada') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
</form>
