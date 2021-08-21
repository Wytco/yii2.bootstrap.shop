<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 21.03.2020
 * Time: 17:00
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php Pjax::begin(['id' => 'csv']); ?>
<?php $form = ActiveForm::begin([
    'options' => [
        'data-pjax' => true,
    ],
]);

?>


<div class="projects content__wrap">
    <h1>Выгрузка</h1>
    <div class="preloader" style="display: none">
        <div class="lds-dual-ring"></div>
    </div>
    <p><?= $message ?></p>
    <div class="box">
        <div class="box__table projects">
            <?= $form->field($model, 'imageFile')->fileInput()->label('Загрузить Продукты', ['class' => 'akb-csv']) ?>
            <?= Html::submitButton('Загрузить', ['class' => 'btn btn-primary download-btn', 'id' => 'download-akb-csv', 'name' => 'download-akb-csv', 'value' => 'download-akb-csv', 'data-pjax' => 1]) ?>
            <?= Html::submitButton('Обновить Продукты', ['class' => 'btn btn-primary download-btn', 'id' => 'download-products-csv', 'name' => 'download-products-csv', 'value' => 'download-products-csv', 'data-pjax' => 1]) ?>
            <?= Html::submitButton('Создать Архив', ['class' => 'btn btn-primary download-btn', 'id' => 'download-products-zip', 'name' => 'download-products-zip', 'value' => 'download-products-zip', 'data-pjax' => 1]) ?>
            <?php if (isset($send_file) && !empty($send_file)) : ?>
                <?= Html::a('Скачать', '/backend/web/details.csv', ['id' => 'send_file', 'data-pjax' => 0,'class' => 'btn btn-primary download-btn']) ?>
            <?php endif; ?>
            <?php if (isset($send_zip) && !empty($send_zip)) : ?>
                <?= Html::a('Скачать', '/backend/web/details.csv', ['id' => 'send_file', 'data-pjax' => 0,'class' => 'btn btn-primary download-btn']) ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>
<?php
$script = <<< JS
 $(document).on('pjax:send', function() {
        $('.preloader').show()
    })
    $(document).on('pjax:complete', function() {
        $('.preloader').hide()
    })
JS;
$this->registerJs($script);
?>
