<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = gestacionTableClass::ID ?>
<?php $fecha = gestacionTableClass::FECHA ?>
<?php $empleado = empleadoTableClass::NOMBRE ?>
<?php $animal = animalTableClass::NUMERO ?>
<?php $fecha_monta = gestacionTableClass::FECHA_MONTA ?>
<?php $fecha_parto = gestacionTableClass::FECHA_PROBABLE_PARTO ?>
<?php $fecundador = gestacionTableClass::ANIMAL_FECUNDADOR ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objGestacion) == TRUE) ? 'updateGestacion' : 'createGestacion')) ?>">
    <?php if (isset($objGestacion)): ?>
    <input type="hidden" name="<?php echo gestacionTableClass::getNameField(gestacionTableClass::ID, TRUE) ?>" value="<?php echo $objGestacion[0]->$id ?>">
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
                            <input placeholder="<?php echo ((isset($objGestacion) == FALSE) ? i18n::__('fechaRegistro', NULL, 'vacunacion') : $objGestacion[0]->$fecha ) ?>" type="date" name="<?php echo gestacionTableClass::getNameField(gestacionTableClass::FECHA, true) ?>" >
                        </th>
                    </tr>
                       <tr>
                        <th>
                            <?php echo i18n::__('empleado', null, 'empleado') ?>:
                        </th>
                        <th>
                            <select name="<?php echo gestacionTableClass::getNameField(gestacionTableClass::EMPLEADO, false) ?>">
                                 <option>...</option>                               
                             <?php foreach ($objEmpleado as $key): ?>
                                    <option value="<?php echo $key->$id ?>">
                                        <?php echo $key->$empleado ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                     <tr>
                        <th>
                            <?php echo i18n::__('hem', null, 'gestacion') ?>:
                        </th>
                        <th>
                            <select name="<?php echo gestacionTableClass::getNameField(gestacionTableClass::ANIMAL, false) ?>">
                                 <option>...</option>                               
                             <?php foreach ($objAnimal as $key): ?>
                                    <option value="<?php echo $key->$id ?>">
                                        <?php echo $key->$animal ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>

                     <tr>
                        <th>
                            <?php echo i18n::__('fechaMonta', null, 'gestacion') ?>:
                        </th>
                        <th>
                            <input placeholder="<?php echo ((isset($objGestacion) == FALSE) ? i18n::__('fechaMonta', NULL, 'gestacion') : $objGestacion[0]->$fecha_monta ) ?>" type="date" name="<?php echo gestacionTableClass::getNameField(gestacionTableClass::FECHA_MONTA, true) ?>" >
                        </th>
                    </tr>
                     <tr>
                        <th>
                            <?php echo i18n::__('fechaParto', null, 'gestacion') ?>:
                        </th>
                        <th>
                            <input placeholder="<?php echo ((isset($objGestacion) == FALSE) ? i18n::__('fechaParto', NULL, 'gestacion') : $objGestacion[0]->$fecha_parto ) ?>" type="date" name="<?php echo gestacionTableClass::getNameField(gestacionTableClass::FECHA_PROBABLE_PARTO, true) ?>" >
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('fecundador', null, 'gestacion') ?>:
                        </th>
                        <th>
                            <select name="<?php echo gestacionTableClass::getNameField(gestacionTableClass::ANIMAL_FECUNDADOR, false) ?>">
                                 <option>...</option>                               
                             <?php foreach ($objAnimal as $key): ?>
                                    <option value="<?php echo $key->$id ?>">
                                        <?php echo $key->$animal ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>

                    <tr>
                        <th colspan="2">
                    <div class="text-center">
                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objGestacion) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
                 </div>
            </div>
        </div>
    </div>
</form>
        <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexGestacion') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
</div>
</main>