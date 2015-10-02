<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $nombre = animalTableClass::NUMERO ?>
<?php $idAnimal = animalTableClass::ID ?>
<?php $nombreVeterinario = veterinarioTableClass::NOMBRE ?>
<?php $idVeterinario = veterinarioTableClass::ID ?>
<div class="container">
    <div class="row">
        <div class="col-xs-4offset-3">
            <form method="post" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', ((isset($objVacunacion)) ? 'updateVacunacion' : 'createVacunacion')) ?>">
                <?php if (isset($objVacunacion) == true): ?>
                    <input name="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID, true) ?>" value="<?php echo $objVacunacion[0]->id ?>" type="hidden">
                <?php endif//close if  ?>
                <table class="table"> 
                    <tr>
                        <th>
                            <?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?>: </th>
                        <th> <input placeholder="<?php echo ((isset($objVacunacion) == true) ? $objVacunacion[0]->fecha_registro : '') ?>" type="datetime-local" name="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true) ?>">
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('animal', null, 'animal') ?>: </th>
                        <th>
                            <select name=" <?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true) ?>">
                                <option>...</option>
                                <?php foreach ($objAnimal as $key): ?>

                                    <option value="<?php echo $key->$idAnimal ?>">
                                        <?php echo $key->$nombre ?>
                                    </option>
                                <?php endforeach; //close foreach  ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('veterinario', null, 'veterinario') ?>: </th>
                        <th>
                            <select name=" <?php echo vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true) ?>">
                                <option>...</option>
                                <?php foreach ($objVeterinario as $key): ?>

                                    <option value="<?php echo $key->$idVeterinario ?>">
                                        <?php echo $key->$nombreVeterinario ?>
                                    </option>
                                <?php endforeach; //close foreach  ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">
                            <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objVacunacion)) ? 'update' : 'register')) ?>">
                        </th>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
</div>
   <a id="atras" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="atras">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
</form>
</main>


