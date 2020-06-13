<template>
    <div>
        <div class="popup_offer_jobs"
             style="width: 100%;height: 100%;background-color:#000;display: none;justify-content: center;align-items: center;position:fixed;top: 0;left: 0;">
            <div style="background-color:#fff;padding: 20px;border-radius: 5px;">
                <div>
                    <h3 style="color: #006363;font-size: 20px;">Выбор задания</h3>
                </div>
                <div style="margin-top: 20px;display:flex;justify-content: space-between" >
                    <span style="font-size: 18px;color: #006363;font-weight: 700;">Мои задания ()</span>
                    <a href='' style="font-size: 18px;color: #009999;">+  Создать задание</a>
                </div>
                <div style="height: 2px;background-color:#000;margin-bottom: 15px;"></div>
                <div>
                    <div class="cards">
                        <div style="display:flex; align-items: center;">
                        <input type="radio" style="width: 22px;height: 22px;margin-right: 15px;" name="job_id" value=''>
                        <div class="card">
                            <div class="data data-height75">
                                <div class="data__topRow">
                                    <a href="" class="topRow__name"></a>
                                    <p class="topRow__price">цена: <span></span>р.</p>
                                    </div>
                                <p class="data__description"></p>
                                <div class="data__bottomRow">
                                  <p class="bottomRow__create">создание: </p>
                                  <a href="" class="bottomRow__detailed">Подробнее</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex;justify-content: flex-end">
                        <button style="background-color: gray;color:white;border: none;border-radius: 2px;padding: 4px 22px;
                            font-size: 16px;cursor: pointer">Выбрать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
