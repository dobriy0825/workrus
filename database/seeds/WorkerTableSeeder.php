<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WorkerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'user_id' => 1,
                'name' => 'Evgeniy',
                'surname' => 'Razdobreev',
                'age' => 31,
                'sex' => 'Мужской',
                'city' => 'Нижнекамск',
                'task_completed' => 0,
                'rating' => 0,
                'about_me' => 'Do play they miss give so up. Celebrated delightful an especially increasing instrument am. How one dull get busy dare far. If as increasing contrasted entreaties be. At none neat am do over will. Sportsman do offending supported extremity breakfast by listening. Small for ask shade water manor think me',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
    }
}
