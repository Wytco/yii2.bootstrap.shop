<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 24.03.2020
 * Time: 13:49
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

?>
<h1>Калькулятор</h1>
<label for="input">Ввод</label>
<input type="text" id="input" placeholder="input">
<label for="count">Формула</label>
<input type="text" id="count" placeholder="count">
<label for="result">Результат</label>
<input type="text" id="result" placeholder="result">

<div class="container">
    <div class="row">
        <div class="line">
            <button id="bracket-left" onClick="reply_click(this.id)">(</button>
            <button id="bracket-right" onClick="reply_click(this.id)">)</button>
            <button id="precent" onClick="reply_click(this.id)">%</button>
            <button id="C" onClick="reply_click(this.id)">C</button>
        </div>
        <div class="line">
            <button id="1" onClick="reply_click(this.id)">1</button>
            <button id="2" onClick="reply_click(this.id)">2</button>
            <button id="3" onClick="reply_click(this.id)">3</button>
            <button id="plus" onClick="reply_click(this.id)">+</button>
        </div>
        <div class="line">
            <button id="4" onClick="reply_click(this.id)">4</button>
            <button id="5" onClick="reply_click(this.id)">5</button>
            <button id="6" onClick="reply_click(this.id)">6</button>
            <button id="mines" onClick="reply_click(this.id)">-</button>
        </div>
        <div class="line">
            <button id="7" onClick="reply_click(this.id)">7</button>
            <button id="8" onClick="reply_click(this.id)">8</button>
            <button id="9" onClick="reply_click(this.id)">9</button>
            <button id="multiply" onClick="reply_click(this.id)">*</button>
        </div>
        <div class="line">
            <button id="0" onClick="reply_click(this.id)">0</button>
            <button id="." onClick="reply_click(this.id)">.</button>
            <button id="enter" onClick="reply_click(this.id)">=</button>
            <button id="divide" onClick="reply_click(this.id)">/</button>
        </div>
    </div>
</div>


<script type="text/javascript">
    function isNumeric(num) {
        return !isNaN(num)
    }

    function reply_click(clicked_id) {
        if (clicked_id === 'enter') {
            var result = $('#count').val(),
                symbols = result.split(''),
                number = '';
            if (symbols.indexOf('%') != -1) {
                let i = 0;
                while (i < symbols.length) {
                    if (isNumeric(symbols[i]) === true) {
                        number += symbols[i];
                        // console.log(symbols[i]);
                    } else if (isNumeric(symbols[i]) === false) {
                        // console.log(symbols[i]);
                        number += symbols[i] + ',';
                    }
                    i++;
                }
                var symbols2 = number.split(',');
                let j = 0;
                while (j < symbols2.length) {
                    if (symbols2[j].indexOf('%') != -1) {
                        var percent = (symbols2[j].substring(0, symbols2[j].length - 1) / 100);
                        symbols2[j] = percent;
                    }
                    j++;
                }
                $('#result').val(calc(symbols2.join('')));
            } else {
                $('#result').val(calc(result));
            }

        } else if (clicked_id === 'C') {
            $('#result').val('');
            $('#count').val('');
            $('#input').val('');
        } else if (clicked_id === 'plus') {
            document.getElementById('input').value += '+';
        } else if (clicked_id === 'mines') {
            document.getElementById('input').value += '-';
        } else if (clicked_id === 'multiply') {
            document.getElementById('input').value += '*';
        } else if (clicked_id === 'divide') {
            document.getElementById('input').value += '/';
        } else if (clicked_id === 'bracket-left') {
            document.getElementById('input').value += '(';
        } else if (clicked_id === 'bracket-right') {
            document.getElementById('input').value += ')';
        } else if (clicked_id === 'precent') {
            document.getElementById('input').value += '%';
        } else {
            document.getElementById('input').value += clicked_id;
            // document.getElementById('input').value += clicked_id;
        }
    }

    function calc(fn) {
        return new Function('return ' + fn)();
    }

    document.addEventListener('keydown', function (event) {
        if (event.code === 'NumpadEnter' || event.code === 'Enter') {
            $('#count').val($('#input').val());
            $('#enter').click();
        } else if (event.code === 'Backspace') {
            var input = $('#count').val();
            $('#count').val(input.substring(0, input.length - 1))
        }
        // console.log(event.code)
    });
</script>


