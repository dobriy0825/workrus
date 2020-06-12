<section>
    <h2 class="section__title">Личный кабинет</h2>

    @include('cabinet.cabinet_menu')

    <article class="workerStyle size_article700">
        <div class="workerStyle__top">
            <div style="position: relative">
                <div class="workerStyle__avatar" style="display: flex;justify-content:center;align-items:center;color:#fff;font-size: 33px;border-radius: 50px;position: relative;height: 150px;width: 150px;border-radius: 50px;background-color:#afafaf;border: 1px solid #006363">
                    @if(true)
                        <img src="../images/card.jpeg" alt="" style="height: 150px;width: 150px;border-radius: 50px;">
                    @else
                        Photo
                    @endif
                    <div class="edit_avatar" style="display:none;text-align:center;width: 150px;height: 40px;background-color:rgba(0,0,0,0.3);position: absolute;bottom: 0;border-bottom-left-radius:50px;border-bottom-right-radius:50px;">
                        <i class="fas fa-pen" style="color:#fff; font-size: 18px;margin-top: 11px;"></i>
                    </div>
                </div>
            </div>

            <!-- Для мобильных -->
            <div class="workerStyle__name_surname">
                <div class="block block_edit">
                    <span class="workerStyle__prop">Имя</span>
                    <hr class="workerStyle__line">
                    <div class="workerStyle__val-wrap_edit">
                        <span class="workerStyle__val" data-name="name">{{ $user->name }}</span>
                        <div class="wrap_edit">
                            <i class="fas fa-pen edit" data-name="name"></i>
                        </div>
                    </div>
                </div>

                <div class="block block_edit">
                    <span class="workerStyle__prop">Фамилия</span>
                    <hr class="workerStyle__line">
                    <div style="" class="workerStyle__val-wrap_edit">
                        <span class="workerStyle__val" data-name="surname">{{ $user->surname }}</span>
                        <div class="wrap_edit">
                            <i class="fas fa-pen edit" data-name="surname"></i>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Для ПК-->
            <div class="workerStyle__name_surname_sex">
                <div class="block block_edit">
                    <span class="workerStyle__prop">Имя</span>
                    <hr class="workerStyle__line">
                    <div class="workerStyle__val-wrap_edit">
                        <span class="workerStyle__val" data-name="name">{{ $user->name }}</span>
                        <div class="wrap_edit">
                            <i class="fas fa-pen edit" data-name="name"></i>
                        </div>
                    </div>
                </div>
                <div class="block block_edit">
                    <span class="workerStyle__prop">Фамилия</span>
                    <hr class="workerStyle__line">
                    <div class="workerStyle__val-wrap_edit">
                        <span class="workerStyle__val" data-name="surname">{{ $user->surname }}</span>
                        <div class="wrap_edit">
                            <i class="fas fa-pen edit" data-name="surname"></i>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <span class="workerStyle__prop">Пол</span>
                    <hr class="workerStyle__line">
                    <span class="workerStyle__val">{{ $user->sex }}</span>
                </div>
            </div>
        </div>
        <!-- Убрать для ПК-->
        <div class="block sex">
            <span class="workerStyle__prop">Пол</span>
            <hr class="workerStyle__line">
            <span class="workerStyle__val">{{ $user->sex }}</span>
        </div>

        <div class="block">
            <span class="workerStyle__prop">Возраст</span>
            <hr class="workerStyle__line">
            <span class="workerStyle__val italic">{{ $user->age }}</span>
        </div>
        <div class="block block_edit">
            <span class="workerStyle__prop">Номер телефона</span>
            <hr class="workerStyle__line">
            <div class="workerStyle__val-wrap_edit">
                <span class="workerStyle__val italic workerStyle__val_phone">{{ $user->phone }}</span>
                <div class="wrap_edit">
                    <i class="fas fa-pen phone_edit_btn"></i>
                </div>
            </div>
        </div>

        <div class="block block_edit">
            <span class="workerStyle__prop">E-mail</span>
            <hr class="workerStyle__line">
            <div class="workerStyle__val-wrap_edit">
                    <span class="workerStyle__val">
                        @if(!$user->email)
                        <i class="fas fa-plus-circle" style="font-size: 22px;color:#009999;cursor: pointer"></i>
                        @else
                        {{ $user->email }}
                            @endif
                    </span>
                <div class="wrap_edit">
                    @if($user->email)
                    <i class="fas fa-pen email_edit_btn"></i>
                        @endif
                </div>
            </div>
        </div>
        <div class="block">
            <span class="workerStyle__prop">Анкета</span>
            <hr class="workerStyle__line">
            <span class="workerStyle__val workerStyle__val_yes">Да</span>
        </div>
        <div class="block">
            <span class="workerStyle__prop">Задания</span>
            <hr class="workerStyle__line">
            <span class="workerStyle__val italic">3</span>
        </div>
        <div class="block">
            <span class="workerStyle__prop">Смена пароля</span>
            <hr class="workerStyle__line">
            <button class="workerStyle__change_password" style="background-color: #009999;color: #fff;padding: 4px 10px;
                                                                border: none;
                                                                border-radius: 2px;
                                                                cursor: pointer;">Изменить пароль</button>
        </div>
        <div class="block">
            <span class="workerStyle__prop">Настройки задания</span>
            <hr class="workerStyle__line">

            <div class="ask_answer">
                <label for="q1" class="workerStyle__ask">Скрывать предложенные анкеты у Ваших заданий ?</label>
                <label>
                    <input type="checkbox" class="workerStyle__answer check_input" name="hide_workers" id="q1" {{ $user->f('hide_workers') ? 'checked' : '' }}>
                    <span class="checkbox"></span>
                </label>
            </div>

            <div class="ask_answer">
                <label for="q2" class="workerStyle__ask">Сообщать о предложенных анкетах у Ваших заданий по E-mail ?</label>
                <label>
                    <input type="checkbox" class="workerStyle__answer check_input" name="report_by_phone_w" id="q2" {{ $user->f('report_by_phone_w') ? 'checked' : '' }}>
                    <span class="checkbox"></span>
                </label>
            </div>

            <div class="ask_answer">
                <label for="q3" class="workerStyle__ask" >Сообщать о предложенных анкетах у Ваших заданий по телефону ?</label>
                <label>
                    <input type="checkbox" class="workerStyle__answer check_input" name="report_by_email_w" id="q3" {{ $user->f('report_by_email_w') ? 'checked' : '' }}>
                    <span class="checkbox"></span>
                </label>

            </div>

        </div>
        <div class="block">
            <span class="workerStyle__prop">Настройки анкеты</span>
            <hr class="workerStyle__line">

            <div class="ask_answer">
                <label for="q4" class="workerStyle__ask">Скрывать предложенные задания у Вашей анкеты ?</label>
                <label>
                    <input type="checkbox" class="workerStyle__answer check_input" name="hide_jobs" id="q4" {{ $user->f('hide_jobs') ? 'checked' : '' }}>
                    <span class="checkbox"></span>
                </label>
            </div>

            <div class="ask_answer">
                <label for="q5" class="workerStyle__ask">Сообщать о предложенных заданиях у Вашей анкеты по E-mail ?</label>
                <label >
                    <input type="checkbox" class="workerStyle__answer check_input" name="report_by_phone_j" id="q5" {{ $user->f('report_by_phone_j') ? 'checked' : '' }}>
                    <span class="checkbox"></span>
                </label>
            </div>

            <div class="ask_answer">
                <label for="q6" class="workerStyle__ask">Сообщать о предложенных заданиях у Вашей анкеты по телефону ?</label>
                <label>
                    <input type="checkbox" class="workerStyle__answer check_input" name="report_by_email_j" id="q6" {{ $user->f('report_by_email_j') ? 'checked' : '' }}>
                    <span class="checkbox"></span>
                </label>
            </div>

        </div>
    </article>
</section>
