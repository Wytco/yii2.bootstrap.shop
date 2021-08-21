<?php
//Задать заголовок в виде
//$this->title = 'My Test';
?>
<h1>234</h1>

<!--Регистрируем js файл только для этой страницы с зависимостью от YiiJs-->
<?php $this->registerJsFile('@web/js/script.js', ['depends' => 'yii\web\YiiAsset']) ?>

<?php
//    кусок js кода
$js = <<<JS
alert(234);
JS;

//$this->registerJs($js);

// кусок js кода в определенном месте https://www.yiiframework.com/doc/guide/2.0/ru/output-client-scripts
//https://www.yiiframework.com/doc/api/2.0/yii-web-view#POS_HEAD-detail
$this->registerJs($js, \yii\web\View::POS_HEAD);
?>
