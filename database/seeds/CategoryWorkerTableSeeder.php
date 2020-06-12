<?php

use Illuminate\Database\Seeder;

class CategoryWorkerTableSeeder extends Seeder
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
              'category_id' => 1,
              'worker_id' => 1
            ],
            [
                'category_id' => 2,
                'worker_id' => 1
            ],
            [
                'category_id' => 1,
                'worker_id' => 2
            ],
            [
                'category_id' => 2,
                'worker_id' => 2
            ],
            [
                'category_id' => 4,
                'worker_id' => 3
            ],
            [
                'category_id' => 2,
                'worker_id' => 4
            ],
            [
                'category_id' => 1,
                'worker_id' => 1
            ],
            [
                'category_id' => 1,
                'worker_id' => 1
            ],
            [
                'category_id' => 1,
                'worker_id' => 1
            ],
            [
                'category_id' => 1,
                'worker_id' => 1
            ],
            [
                'category_id' => 1,
                'worker_id' => 1
            ],
            [
                'category_id' => 1,
                'worker_id' => 1
            ],
        ];
    }
}
