<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id_registro= registroPesoTableClass::ID ?>

<?php $empleado = empleadoTableClass::NOMBRE ?>

<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objRegistroPeso) == TRUE) ? 'updateRegistroPeso' : 'createRegistroPeso')) ?>">
    <?php if (isset($objRegistroPeso)): ?>
    <input type="hidden" name="<?php echo registroPesoTableClass::getNameField(registroPesoTableClass::ID, TRUE) ?>" value="<?php echo $objRegistroPeso[0]->$id_registro ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">
                <div class="table-responsive">
                <table class="table">  
         <tr>
                        <th>
                            <?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?>:
                        </th>
                        <th>
                            <input type="datetime-local" placeholder="<?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?>" name="<?php echo registroPesoTableClass::getNameField(registroPesoTableClass::FECHA, true) ?>">
                        </th>
                    </tr> 
                                       <tr>
                        <th>
                            <?php echo i18n::__('empleado') ?>:
                        </th>

                        <th>
                            <select name="<?php echo registroPesoTableClass::getNameField(registroPesoTableClass::EMPLEADO, true) ?>">
                                  <option>...</option>
                                <?php foreach ($objEmpleado as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->nombre_completo ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
<!--                                                           <tr>
                        <th>
                            <?php echo i18n::__('identificacion') ?>:
                        </th>

                        <th>
                            <select name="<?php echo registroPesoTableClass::getNameField(registroPesoTableClass::ANIMAL, true) ?>">
                                  <option>...</option>
                                <?php foreach ($objAnimal as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->numero_identificacion ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>-->
                    <tr>
                        <th><?php echo i18n::__('weight', null, 'dpVenta') ?>:</th>
                        <th> <input type="number" placeholder="<?php echo i18n::__('weight', null, 'dpVenta') ?>" name="<?php echo registroPesoTableClass::getNameField(registroPesoTableClass::PESO, true) ?>"></th>
                    </tr>
                      <tr>
                        <th>  <?php echo i18n::__('valor_kilo') ?>:</th>
                        <th> <input type="number" placeholder="<?php echo i18n::__('valor_kilo') ?>" name="<?php echo registroPesoTableClass::getNameField(registroPesoTableClass::KILO, true) ?>"></th>   

                    </tr>
                                                  <tr>
                        <th colspan="2" >
                    <div class=" text-center">

                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objRegistroPeso) == TRUE) ? 'edit' : 'register'), NULL, 'user') ?>">

                    </div>
                    </th>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
 <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroPeso') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
 </form>
</div>
</main>