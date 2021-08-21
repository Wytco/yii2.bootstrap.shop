<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 26.03.2020
 * Time: 9:52
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */
use backend\assets\VideoAsset;
VideoAsset::register($this);
?>
<div id="player">For player</div>
<ul>
    <li onclick="jwplayer('player').play()">Start</li>
    <li onclick="alert(jwplayer('player').getVolume())">Get volume</li>
    <li onclick="add_volume()">Set volume</li>
</ul>
