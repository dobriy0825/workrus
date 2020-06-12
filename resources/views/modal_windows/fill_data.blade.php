<div class="for_popup" style="position:fixed;top: 0;background-color:rgba(0,0,0,0.5);
    width: 100%;height: 100vh;display:flex;justify-content: center;align-items: center">
    <div class="modal_window">
        <div class="wrap_title">
            <p class="popup_title">Заполните необходимые данные:</p>
        </div>
        <div class="form_btn">
            <form action="{{ route('fill.data') }}" method="post" >
                @method('put')
                @csrf
                <div class="wrap_input_label">
                    <label for="name">Имя:</label>
                    <input class="input" type="text" id="name" name="name">
                </div>
                <div class="wrap_input_label" style="margin: 22px 0;">
                    <label for="name">Фамилия:</label>
                    <input class="input" type="text" id="name" name="surname">
                </div>
                <div class="wrap_input_label">
                    <label for="name">Пол:</label>
                    <div style="display:flex;">
                        <div class="workerStyle__sex_item">
                            <input class="workerStyle__inputRadio" type="radio" name="sex" value="Мужской" id="radio1" checked>
                            <label class="workerStyle__label" for="radio1">Мужской</label>
                        </div>

                        <div class="workerStyle__sex_item">
                            <input class="workerStyle__inputRadio" type="radio" name="sex" value="Женский" id="radio2">
                            <label class="workerStyle__label" for="radio2">Женский</label>
                        </div>
                    </div>
                </div>
                <div class="wrap_input_label" style="margin-top: 22px;">
                    <label for="name">Дата рождения:</label>
                    <div class="workerStyle__selectItems">
                        <div class="wrap__select" style="">
                            <select name="year" id="" style="border: 1px solid #009999">
                                <option value="1988">1988</option>
                                <option value="1989">1989</option>
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1991">1991</option>
                            </select>
                        </div>
                        <div class="wrap__select">
                            <select name="month" id="" style="border: 1px solid #009999">
                                <option value="01">Январь</option>
                                <option value="02">Февраль</option>
                                <option value="03">Март</option>
                                <option value="04">Апрель</option>
                                <option value="05">Май</option>
                                <option value="06">Июнь</option>
                                <option value="07">Июль</option>
                                <option value="08">Август</option>
                                <option value="09">Сентябрь</option>
                                <option value="10">Май</option>
                                <option value="11">Май</option>
                                <option value="12">Май</option>
                            </select>
                        </div>
                        <div class="wrap__select">
                            <select name="day" id="" style="border: 1px solid #009999">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="25">25</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="submit" value="hhhhhh">
            </form>
            <div class="popup_buttons">

                {{--                    <button class="ok_btn" type="submit">Сохранить</button>--}}
            </div>
        </div>
    </div>
</div>
