<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
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
                'name' => 'Астраханская'
            ],
            [
                'name' => 'Московская'
            ],
            [
                'name' => 'Татарстан'
            ],
            [
                'name' => 'Новосибирская'
            ],
            [
                'name' => 'Владимирская'
            ],
        ];
        DB::table('regions')->insert($data);
    }
}
