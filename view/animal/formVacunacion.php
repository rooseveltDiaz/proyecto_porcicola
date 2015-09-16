<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>

<?php $id= carneVacunasTableClass::ID ?>

<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objCarne) == TRUE) ? 'updateVacunacion' : 'createVacunacion')) ?>">
    <?php if (isset($objCarne)): ?>
    <input type="hidden" name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::ID, TRUE) ?>" value="<?php echo $objCarne[0]->$id ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">
                <div class="table-responsive">
                <table class="table ">  
         <tr>
                        <th>
                            <?php echo i18n::__('fecha', null, 'detalleVacunacion') ?>:
                        </th>
                        <th>
                            <input type="hidden" value="<?php echo $idAnimalHojaVida ?>" name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::ANIMAL, true) ?>">
                            <input type="datetime-local" placeholder="<?php echo i18n::__('fecha', null, 'detalleVacunacion') ?>" name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::FECHA_VACUNACION, true) ?>">
                        </th>
                    </tr> 
                                       <tr>
                        <th>
                            <?php echo i18n::__('veterinario', null, 'veterinario') ?>:
                        </th>

                        <th>
                            <select name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::VETERINARIO, true) ?>">
                                  <option>...</option>
                                <?php foreach ($objVeterinario as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->nombre_completo ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                                                           <tr>
                        <th>
                            <?php echo i18n::__('identificacion') ?>:
                        </th>

                        <th>
                            <select name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::ANIMAL, true) ?>">
                                  <option>...</option>
                                <?php foreach ($objAnimal as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->numero_identificacion ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                                                                               <tr>
                        <th>
                            <?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?>:
                        </th>

                        <th>
                            <select name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true) ?>">
                                  <option>...</option>
                                <?php foreach ($objVacuna as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->nombre_vacuna ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th><?php echo i18n::__('dosis', null, 'detalleVacunacion') ?>:</th>
                        <th> <input type="number" placeholder="<?php echo i18n::__('dosis', null, 'detalleVacunacion') ?>" name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true) ?>"></th>
                    </tr>
                      <tr>
                        <th>  <?php echo i18n::__('accion') ?>:</th>
                        <th>      <select name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::ACCION, true) ?>">
                                            <option value="">...</option>
                                            <option><?php echo i18n::__('enfermedad') ?></option>
                                            <option><?php echo i18n::__('gestacion') ?></option>
                                            <option><?php echo i18n::__('parto') ?></option>
                                            <option><?php echo i18n::__('rutina') ?></option>
                                            <option><?php echo i18n::__('destete') ?></option>
                                            <option><?php echo i18n::__('nacido') ?></option>
                                            <option><?php echo i18n::__('desteta') ?></option>
                                        </select>
                        </th>   

                    </tr>
                                                  <tr>
                        <th colspan="2" >
                    <div class=" text-center">

                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objCarne) == TRUE) ? 'edit' : 'register'), NULL, 'user') ?>">

                    </div>
                    </th>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
 <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexVacunacion') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
 </form>
</div>
</main>