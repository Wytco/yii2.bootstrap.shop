<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 22.03.2020
 * Time: 11:36
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;


//dd($my->username)

?>
<div class="chat">

    <h3>Chat</h3>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <?php Pjax::begin(['id' => 'chat-list', 'timeout' => 7000,'scrollTo'=>'$("#scroll").offset().top;']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <?php if (isset($list) && !empty($list)) : ?>
        <div class="list">
            <?php foreach ($list as $item) : ?>
                <?php if($item['first_user_id'] == $my->id) : ?>
                    <p class="first_user_id"> <?= $item['first_user_id'] ?> - <?= $item['second_user_id'] ?> - <?= $item['message'] ?></p>
                    <div class="clearfix"></div>
                <?php else: ?>
                    <p class="second_user_id"> <?= $item['first_user_id'] ?> - <?= $item['second_user_id'] ?> - <?= $item['message'] ?></p>
                    <div class="clearfix"></div>
                <?php endif; ?>


            <?php endforeach; ?>
        </div>
        <?= Html::submitButton('Обновить', ['name' => 'Chat[refresh-btn]', 'id' => 'refresh-btn', 'value' => 'refresh-btn', 'class' => 'btn btn-success']) ?>
    <?php endif; ?>
    <div id="scroll"></div>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>

    <?php Pjax::begin(['id' => 'chat']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <label for="UserID">Выберите собеседника</label>
    <select id="UserID" name="Chat[UserID]">
        <?php if (isset($users) && !empty($users)) : ?>
            <?php foreach ($users as $user) : ?>
                <option <?= isset($UserID) && !empty(isset($UserID)) && $UserID == $user->id ? 'selected' : '' ?>
                        value="<?= $user->id ?>"><?= $user->username ?></option>    `
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <?= $form->field($model, 'message')->textInput(['value' => isset($message) ? $message : '', 'maxlength' => 255, 'placeholder' => 'Сообщение']) ?>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['name' => 'Chat[send-btn]', 'id' => 'send-btn', 'value' => 'send-btn', 'class' => 'btn btn-success']) ?>
    </div>

    <script>

    </script>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>

    <?php
    $this->registerJs(
        '
    $("document").ready(function () {
        $("#chat").on("pjax:complete", function () {
           $.pjax.reload({container:"#chat-list"});  //Reload GridView
        });
         $("#chat-list").on("pjax:complete", function () {
//          $(".list").animate({scrollTop: $("#scroll").offset().top}, 2000);
          $(".list").animate({scrollTop: $("#scroll").offset().top}, 100);
        });
        setInterval(function(){ $("#refresh-btn").click(); }, 7000);
    });
    '
    );
    ?>
</div>
<!--<script>-->
<!--    $('.blueButton').on('click', function (e) {-->
<!--        e.preventDefault();-->
<!--        var myUserID = $('#myUserID').val(),-->
<!--            UserID = $('#UserID').val(),-->
<!--            Send = 'send',-->
<!--            chatText = $('#chatText').val();-->
<!--        $.ajax({-->
<!--            url: '/admin/chat/index',-->
<!--            data: {myUserID: myUserID, UserID: UserID, chatText: chatText,Send:Send},-->
<!--            type: 'POST',-->
<!--            success: function (res) {-->
<!--                var obj = JSON.parse(res);-->
<!--                console.log(res);-->
<!--            },-->
<!--            error: function () {-->
<!--                alert('Error')-->
<!--            }-->
<!--        });-->
<!--        return false;-->
<!--    });-->
<!--</script>-->
<?php
//$num = 'n'; // Чтобы название функции не повторялась
//$file = '/admin/chat/index';
//$time = 7;
//echo ajax($file, $time);
//function ajax($file, $time = 7)
//{ // $file - Файл какой надо загружать, $time - интервал в секундах обновления
//    global $num;
//    return '<div id="' . $num . '">
//    <div class="loadup" style="text-align:center;">Загрузка...</div>
//</div>
//<script>
//    function show_' . $num . '(){
//    $.ajax({
//    url: "' . $file . '",
//    cache: true,
//     success: function(html) {
//      $("#' . $num . '").html(html);
//       console.log(res);
//      }});}
//      $(document).each(function(){show_' . $num . '(); setInterval(show_' . $num . ', ' . $time . '000);});
//</script>';
//    $num .= $num;
//}
//
//?>
