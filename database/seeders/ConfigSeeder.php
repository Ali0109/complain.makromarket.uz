<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config_arr = [
            [
                'key' => 'app_type',
                'value' => 1,
                'name' => 'Жалобы'
            ],
            [
                'key' => 'app_type',
                'value' => 2,
                'name' => 'Предложения'
            ],
            [
                'key' => 'app_status',
                'value' => 1,
                'name' => 'В обработке'
            ],
            [
                'key' => 'app_status',
                'value' => 2,
                'name' => 'Принят'
            ],
            [
                'key' => 'app_status',
                'value' => 3,
                'name' => 'Закрыт'
            ],
            [
                'key' => 'app_status',
                'value' => 4,
                'name' => 'Отменен'
            ],
        ];

        DB::table('configs')->insert($config_arr);
    }
}
