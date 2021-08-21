<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 24.03.2020
 * Time: 13:32
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

use yii\helpers\Url;

?>
<h1>Список калькуляторов</h1>
<a href="<?=Url::to(['/cupboard/create']) ?>">Шкафы</a>
<br>
<a href="<?=Url::to(['/calculator/calculator']) ?>">Калькулятор</a>
<br>
<a href="<?=Url::to(['/site/size']) ?>">Разымер одежды</a>
