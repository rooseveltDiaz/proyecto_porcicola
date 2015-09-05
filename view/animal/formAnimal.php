<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id_animal = animalTableClass::ID ?>

<?php $lote = loteTableClass::NOMBRE ?>

<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objAnimal) == TRUE) ? 'updateAnimal' : 'createAnimal')) ?>">
    <?php if (isset($objAnimal)): ?>
        <input type="hidden" name="<?php echo animalTableClass::getNameField(animalTableClass::ID, TRUE) ?>" value="<?php echo $objAnimal[0]->$id_animal ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive">    
                    <tr>
                        <?php if (!isset($objAnimal)): ?>
                            <th> <?php echo i18n::__('identificacion') ?>:</th>
                            <th> 
                                <input required  type="text"   name="<?php echo animalTableClass::getNameField(animalTableClass::NUMERO, true) ?>" >
                                <font size="2">* <?php echo i18n::__('oblig', null, 'animal') ?></font>
                            </th> 
                        </tr>
                    <?php endif; ?>
                         

                  
                    <tr>
                        <th colspan="2" >
                    <div class=" text-center">

                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objAnimal) == TRUE) ? 'edit' : 'register'), NULL, 'user') ?>">

                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
            <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
         <br/>
 
        <a id="deleteFilter" class="btn btn-sm btn-default  fa fa-arrow-left" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>"></a>
   <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('atras', null, 'ayuda') ?>
                        </div> 
<br/>
<br/>

        </form>
</div>
</main>