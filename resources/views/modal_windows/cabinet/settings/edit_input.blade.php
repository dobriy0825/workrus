<div class="for_popup edit_input_popup" style="
display:none;
position:fixed;
top: 0;
background-color:rgba(0,0,0,0.5);
width: 100%;
height: 100vh;
justify-content: center;
align-items: center;">
    <div class="modal_window" style="min-width: 300px;">
        <div class="wrap_title">
            <p class="popup_title">Введите имя:</p>
        </div>
        <div class="form_btn">
            <div class="edit_input_errors"></div>
            <form class="edit_input" method="post" name="edit_input" id="edit_input">
                <div class="wrap_input_label">
                    <label for="name">Имя:</label>
                    <input class="input" type="text" form="edit_input">
                </div>
            </form>
            <div class="popup_buttons">
                <button class="cancel_edit_input_btn">Отмена</button>
                <button class="edit_input_btn" type="submit" form="edit_input">Изменить</button>
            </div>
        </div>
    </div>
</div>
