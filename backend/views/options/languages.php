<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>
<div class="languages-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'languages')->checkbox() ?>

    <div id="select-languages">
        <h2>Стандартные языки</h2>
        <div class="form-group field-options-multilanguages">
            <input type="hidden" name="Options[multilanguages]" value="">
            <select id="options-multilanguages" class="form-control" name="Options[multilanguages][]" multiple="" >
                <?php foreach ($languages as $item) : ?>
                    <option <?= $item->active == 1 ? 'selected' : '' ?> value="<?= $item->id ?>"><?= $item->name ?></option>
                <?php endforeach; ?>
            </select>
            <div class="help-block"></div>
        </div>

    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>