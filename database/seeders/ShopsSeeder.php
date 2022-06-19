<?php

namespace Database\Seeders;


use App\Models\Shop;
use App\Services\CSVService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = CSVService::import_csv('stores');

        foreach ($shops as $shop) {
            $name = explode(" ", $shop[2])[1];

            Shop::create([
                'name' => $shop[2],
                'code' => $shop[1],
            ]);
        }
    }
}
