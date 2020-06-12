<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
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
                'name' => 'Астрахань',
                'region_id' => 1
            ],
            [
                'name' => 'Камызяк',
                'region_id' => 1
            ],
            [
                'name' => 'Коломна',
                'region_id' => 2
            ],
            [
                'name' => 'Королёв',
                'region_id' => 2
            ],
            [
                'name' => 'Клин',
                'region_id' => 2
            ],
            [
                'name' => 'Казань',
                'region_id' => 3
            ],
            [
                'name' => 'Набережные Челны',
                'region_id' => 3
            ],
            [
                'name' => 'Нижнекамск',
                'region_id' => 3
            ],
            [
                'name' => 'Альметьевск',
                'region_id' => 3
            ],
            [
                'name' => 'Заинск',
                'region_id' => 3
            ],
            [
                'name' => 'Бердск',
                'region_id' => 4
            ],
            [
                'name' => 'Искитим',
                'region_id' => 4
            ],
            [
                'name' => 'Кольцово',
                'region_id' => 4
            ],
            [
                'name' => 'Новосибирск',
                'region_id' => 4
            ],
            [
                'name' => 'Александров',
                'region_id' => 5
            ],
            [
                'name' => 'Владимир',
                'region_id' => 5
            ]
        ];
        DB::table('cities')->insert($data);
    }
}
