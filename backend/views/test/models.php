<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
debug($model);
?>

<div class="row">
    <div class="col-md-12">
        <h1>Страница с моделями</h1>
        <table class="table">
            <tr>
                <td>Code</td>
                <td>Name</td>
                <td>Population</td>
                <td>Status</td>
            </tr>
            <?php foreach ($model as $item) : ?>
                <tr>
                    <td><?= $item->code ?></td>
                    <td><?= $item->name ?></td>
                    <td><?= $item->population ?></td>
                    <td><?= $item->status ?></td>
                </tr>
            <?php endforeach;?>
        </table>

    </div>
</div>
