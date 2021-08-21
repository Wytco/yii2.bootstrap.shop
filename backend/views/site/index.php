<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title =  Html::encode(Yii::$app->name);

?>
<div class="site-index">
<h1 class="text-danger">Сделать вывод метотегов для мультеязычности</h1>
    <div class="jumbotron">
        <h1>Congratulations!</h1>
        <p class="lead">Order -> GridView change view + _from Обратить внимание на работу с Pjax</p>
        <p class="lead">(Фронт или Бек) MenuWidget -> Обратить внимание на кеширование меню , что бы меню открывалось на сл странице так же</p>
        <p class="lead">Category -> GridView change view + _from + связи категорий к той же таблице + <br> CategorySearch жадная загрузка(уменьшает количество запросов) 43 строка "$query = Category::find()-><span class="text-danger">with('category');</span>"  </p>
        <p class="lead">Products -> Загрузка изображений как несколько так и одну, но не забывать сбрасывать переменную перед сохранением, а так же GridView с обновлениям в index c помощью Pjax</p>
        <p class="lead">Products->Search-Session -> Pjax + ActiveForm + ListView Динамический поиск без перезагрузки страницы с пагинацией и запоминанием фильтра через Сессии (Не передумал как обнулять Сессию)</p>
        <p class="lead">API backend\modules\api\modules\v1\ - пример отправки запроса http://advanced.loc/admin/api/v1/statistics/create</p>
        <p class="lead">Notes -> Примеряем Pjax на ActiveForm и GridView + Редактирования с этой же странци + DataPicker два варианта</p>
        <p class="lead">CSV -> загрузка csv и выгрузка</p>
    </div>

</div>
<script>
    (function() {
        'use strict';

        // Your code here...
        function mklnk() {
            let url = $('pjsdiv video').attr('src');
            $('article.fullstory').prepend(`<a href="${url}" target="_blank" style="margin: 0;padding: 0 20px;font-size: 200%;"">Открыть в vlc</a>`);
        }

        setTimeout(mklnk, 1500);
//mklnk();

    })();
</script>
