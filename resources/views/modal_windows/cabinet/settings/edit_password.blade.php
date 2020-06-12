<div class="for_popup edit_password_popup" style="display:none;position:fixed;top: 0;background-color:rgba(0,0,0,0.5);width: 100%;height: 100vh;justify-content: center;align-items: center">
    <div class="modal_window" style="min-width: 300px;">
        <div class="wrap_title">
            <p class="popup_title">Введите пароль:</p>
        </div>
        <div class="form_btn">
            <div class="edit_password_errors"></div>
            <form class="edit_input" action="" method="post" id="edit_input" name="edit_password">
                @method('post')
                @csrf
                <div class="wrap_input_label">
                    <label for="name">Текущий пароль:</label>
                    <input class="input" type="password" name="password">
                </div>
                <div class="wrap_input_label">
                    <label for="name">Новый пароля:</label>
                    <input class="input" type="password" name="new_password">
                </div>
                <div class="wrap_input_label">
                    <label for="name">Подтверждение пароля:</label>
                    <input class="input" type="password" name="new_password2">
                </div>
            </form>
            <div class="popup_buttons">
                <button class="cancel_edit_password_btn">Отмена</button>
                <button class="edit_password_btn" type="submit" form="edit_input">Изменить</button>
            </div>
        </div>
    </div>
</div>
