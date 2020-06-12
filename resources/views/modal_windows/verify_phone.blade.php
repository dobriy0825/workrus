<div class="wrap_popup verify_phone_popup" style="display: none;">
    <div class="popup">
        <h3 class="popup__title" >Код подтверждения</h3>
        <p class="popup__description" >На указаный Вами номер выслано СМС-сообщение с кодом подтверждения из 5х цифр. Введите его.</p>
        <form action="" class="popup__form" name="verify_phone" method="post">
            <div class="errors_popup" style="color:red;font-size: 14px;"></div>
            <input style="font-size: 20px;width: 90px;padding: 6px;" type="text" class="popup__form_code" name="code">
            <div style="display:flex;margin-top: 8px;">
                <div style="color:#5b5b5b;margin-right: 8px;">
                    <span class="minutes">00</span>
                    <span class="">:</span>
                    <span class="seconds">00</span>
                </div>
                {{--                    <a href=""  style="font-size: 14px;color:#b0afaf;text-decoration: underline;">Выслать код повторно</a>--}}
                <button class="resend_code_btn" style="border:none;font-size: 15px;color:#b0afaf;background-color: #ffffff" disabled >Выслать код повторно</button>
            </div>
            <input disabled="0" style="background-color:#b0afaf;" type="submit" value="Подтвердить" class="popup__form_button verify_phone_btn" name="push">
        </form>
        <input type="button" value="Отменить" class="popup__form_button cancel_btn" form="code" >
    </div>
    <div class="wrap_popup__overlay"></div>
</div>

