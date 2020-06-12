<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'name' => 'Evgeniy',
                'surname' => 'Razdobreev',
                'phone' => '1',
                'email' => 'dobriy0825@mail.ru',
                'password' => bcrypt('q'),
                'birth_day' => Carbon::create(1988,8,25),
                'age' => 31,
                'sex' => 'Мужской',
                'status' => 'wait',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Valeriy',
                'surname' => 'Li',
                'phone' => '2',
                'email' => 'a@mail.ru',
                'password' => bcrypt('q'),
                'birth_day' => Carbon::create(1988,8,25),
                'age' => 34,
                'sex' => 'Мужской',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Roman',
                'surname' => 'Ibragimov',
                'phone' => '3',
                'email' => 'a2@mail.ru',
                'password' => bcrypt('q'),
                'birth_day' => Carbon::create(1988,8,25),
                'age' => 33,
                'sex' => 'Мужской',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Dilyara',
                'surname' => 'Husainova',
                'phone' => '4',
                'email' => 'a3@mail.ru',
                'password' => bcrypt('q'),
                'birth_day' => Carbon::create(1988,8,25),
                'age' => 34,
                'sex' => 'Женский',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        DB::table('users')->insert($data);
    }
}
