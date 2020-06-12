<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user_id' => 2,
            'title' => 'Помыть посуду на 6 персон',
            'category' => 'Название категории3-2',
            'sub_category' => 'Грузоперевозки',
            'address' => 'Новосибирск',
            'need_people' => 1,
            'start' => '22.05.2020 12:00',
            'finish' => '22.05.2020 17:00',
            'price' => 1500,
            'description' => 'По своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.',
            'views' => 0,
            'draft' => 0,
            'status' => 'Открыто',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('jobs')->insert($data);
    }
}
