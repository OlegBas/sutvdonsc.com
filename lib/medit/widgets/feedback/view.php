<?
$key_tmpl = rand(100, 10000);

$signature   = md5($conf['widgets']['feedback']['key'] . "&" . $email);
$send_script =     $conf['widgets']['feedback']['send_script'];


?>


<form target="feedback_<?=$id?>" id="feedback_form_<?=$id?>" name="feedback_form_<?=$id?>" class="form2" method="post">
    <div>
<label>Введите Ваше имя:</label>
            <input type="text" name="bvz" required='' />
    </div>
    <div>
        <label>Введите Ваш телефон:</label>
        <input type="text" required=""  name="ntktajyt"/>
    </div>

    <div>
        <label>Введите Ваш E-mail:</label>
        <input type="text" required=""  name="dfigjxnf"/>
    </div>
    <div>
        <label>Категория обращения:</label>
        <select name="gfdsgfds" required="">
            <option value=""></option>
            <option value="Жалоба">Жалоба</option>
            <option value="Предложение">Предложение</option>
            <option value="Вопрос">Вопрос</option>
            <option value="Иное">Иное</option>
        </select>
    </div>
    <div>
        <label>Введите Ваше сообщение:</label>
            <textarea  required="" placeholder="" type="text" name="cjjotybt"></textarea>
    </div>

    <div>

        <label><input type="checkbox" name="fdsafdsafds"  value="1" class="politic" required="" > я ознакомлен(а) и принимаю условия <a href="/article.html?id=2138" target="_blank" style="color:#0c5a2d">Политики обработки персональных данных</a></label>

    </div>
    <div class='submit' >
        <input type="button" disabled class="button-submit" value="Отправить" onclick="$('#feedback_form_<?=$id?>').attr('action','<?=$send_script?>').submit();" />
        <input type="hidden" name="gjxnf" value="<?=$email?>" />
        <input type="hidden" name="signature" value="<?=$signature?>" />
        <input type="hidden" name="form_id" value="<?=$id?>" />

    </div>
</form>
<script>
    $(function() {
        $('#feedback_form_<?=$id?> .politic').click(function() {
            if ($(this).is(':checked')){
                $('#feedback_form_<?=$id?> .button-submit').prop('disabled', false);
            } else {
                $('#feedback_form_<?=$id?> .button-submit').prop('disabled', true);
            }
        });
    });

</script>
<style>
    #feedback_form_<?=$id?> .button-submit:disabled {
        opacity: 0.5;
    }
</style>
<iframe name="feedback_<?=$id?>" style="border:none;width:0px;height:0px;" frameborder="0" ></iframe>
