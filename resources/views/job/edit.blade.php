@extends('layouts.template')
@section('header')
    @include('headers.header_for_mobile')
    @include('headers.header_for_pc')
    <header class="header-for-mobile">
        <div class="header-mobile">
            {{--            <a href=""><i class="header-mobile__right-btn fas fa-caret-left icon_white"></i></a>--}}
            <h2 class="header__title">Редактировать задания</h2>
        </div>
    </header>
@endsection
@section('content')
    <section class="" >
        <form id="create_job_form" action="{{ route('job.update', $job->id) }}" method="post">
            @method('put')
            @csrf
        </form>


        <h2 class="section__title">Редактировать задания</h2>
        @if ($errors->any())
            <div class="" style="background-color:red; color: white;width: 700px; padding: 7px;margin: 0 auto 10px;border-radius: 5px;">
                {{ $errors->first() }}
            </div>
        @endif
        <article class=" workerStyle size_article700 bgc__createWorker__pc">
            <div class="block">
                <span class="workerStyle__prop">Название</span>
                <hr class="workerStyle__line">
                <input class="workerStyle__inputText"
                       type="text" form="create_job_form"
                       value="{{ $job->title }}"
                       name="title" placeholder="Введите название задания" style="padding: 7px 7px;">
            </div>
            <div class="block">
                <span class="workerStyle__prop">Вид задания</span>
                <hr class="workerStyle__line">
                <span class="btn_for_selected btn_show_typeJob__items" style="display:none;">Выбрать вид задания</span>
                {{--                <input class="worker_category__input" type="text" name="category" form="create_job_form">--}}
                {{--                <input class="worker_subCategory__input" type="text" name="subCategory" form="create_job_form">--}}
                <select name="category" form="create_job_form" class="workerStyle__inputSelect select_category" style="padding: 7px 5px;">
                    <option selected>-- Выбрать категорию --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}" {{ $category->name == $job->category ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <select name="sub_category" form="create_job_form" style="margin-left: 11px;margin-bottom: 10px; width: 251px;padding: 7px 5px;" class="workerStyle__inputSelect select_sub_category">
                    <option selected>Подкатегория</option>
                    @foreach($subCategories as $item)
                        <option value="{{ $item->name }}" {{ $item->name == $job->sub_category ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>

            </div>
            <div class="block">
                <span class="workerStyle__prop">Местоположение</span>
                <hr class="workerStyle__line">
                <span class="btn_for_selected btn_show_towns" style="cursor: pointer;">{{ $job->address }}</span>
                <!-- Модальное окно Выбор города -->

            </div>
            <div class="block">
                <span class="workerStyle__prop">Нужно людей</span>
                <hr class="workerStyle__line">
                <div  class="workerStyle__sex_items">
                    <div class="workerStyle__sex_item">
                        <input class="workerStyle__inputRadio"
                               type="radio"
                               form="create_job_form"
                               name="need_people" value="1" id="radio1" {{ $job->need_people == 1 ? 'checked' : '' }}>
                        <label class="workerStyle__label" for="radio1">1</label>
                    </div>

                    <div  class="workerStyle__sex_item">
                        <input class="workerStyle__inputRadio"
                               type="radio"
                               form="create_job_form"
                               name="need_people" value="2" id="radio2" {{ $job->need_people == 2 ? 'checked' : '' }}>
                        <label class="workerStyle__label" for="radio2">2</label>
                    </div>
                    <div  class="workerStyle__sex_item">
                        <input class="workerStyle__inputRadio"
                               type="radio"
                               form="create_job_form"
                               name="need_people" value="3" id="radio3" {{ $job->need_people == 3 ? 'checked' : '' }}>
                        <label class="workerStyle__label" for="radio3" >3</label>
                    </div>
                    <div  class="workerStyle__sex_item" style="margin-right: 0;">
                        <label class="workerStyle__label" for="ooo" style="display: inline-block; font-size: 14px;">своё кол-во:</label>
                        <input class="workerStyle__inputRadio" type="text" form="create_job" name="sex" id="ooo" style="height: 18px; width: 34px;border: none;padding: 3px 8px;font-size: 14px;">
                    </div>
                </div>
            </div>


            <div class="block">
                <span class="workerStyle__prop">Дата и Время</span>
                <hr class="workerStyle__line">

                <div class="wrap_period">
                    <div class="date_time date_time_start">
                        <span class="date_time__title">Начать:</span>
                        <div class="wrap_date_time">
                            <div class="wrap_icon_input wrap_date">
                                <div class="bg_icon">
                                    <i class="date_time__icon fas fa-calendar-alt"></i>
                                </div>
                                <input class="date_time__datepicker" type="text" placeholder="Дата"
                                       form="create_job_form" name="date_start" value="{{ $job->dateFromValue($job->start) }}">
                            </div>
                            <div class="wrap_icon_input wrap_time">
                                <div class="bg_icon">
                                    <i class="date_time__icon fas fa-clock"></i>
                                </div>
                                {{--                                <input class="date_time__time" type="text" placeholder="Время" form="create_job_form"--}}
                                {{--                                       name="time1" value=":">--}}
                                <select name="time_start" form="create_job_form">
                                    @foreach($time as $item)
                                        <option value="{{ $item }}" {{ $item == $job->timeFromValue($job->start) ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="date_time date_time_finish">
                        <span class="date_time__title">Завершить:</span>
                        <div class="wrap_date_time">
                            <div class="wrap_icon_input wrap_date">
                                <div class="bg_icon">
                                    <i class="date_time__icon fas fa-calendar-alt"></i>
                                </div>
                                <input class="date_time__datepicker" type="text" placeholder="Дата"
                                       form="create_job_form" name="date_finish" value="{{ $job->dateFromValue($job->finish) }}">
                            </div>
                            <div class="wrap_icon_input wrap_time">
                                <div class="bg_icon">
                                    <i class="date_time__icon fas fa-clock"></i>
                                </div>
{{--                                <input class="date_time__time" type="text" placeholder="Время" form="create_job_form"--}}
{{--                                       name="time_finish" value="{{ old('time_finish') }}">--}}
                                <select name="time_finish" form="create_job_form">
                                    @foreach($time as $item)
                                        <option value="{{ $item }}" {{ $item == $job->timeFromValue($job->finish) ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



            <div class="block">
                <span class="workerStyle__prop">Цена</span>
                <div style="height: 1px;background-color:#8f8f8f;margin: 3px 0 4px 0;"></div>

                <div style="display:flex; align-items: center">
                    <input class="workerStyle__inputText" type="text" form="create_job_form" name="price"
                           placeholder="Введите цену" value="{{ $job->price }}"
                           style="width: 105px;">
                    <span style="color: #009999; font-size: 22px; margin-left: 6px;">₽</span>
                </div>

            </div>



            <div class="block">
                <span class="workerStyle__prop">Описание</span>
                <hr class="workerStyle__line">
                <textarea form="create_job_form" name="description" id="" cols="30" rows="5"
                          placeholder="Введите описание задания">{{ $job->description }}</textarea>
            </div>


            <div class="block">
                <input type="submit" value="Продолжить" form="create_job_form">
            </div>
        </article>
    </section>
    @include('modal_windows.city_selection')
    @include('modal_windows.type_job_selection')
    <script src="{{ mix('js/job/create_job.js') }}"></script>
@endsection
