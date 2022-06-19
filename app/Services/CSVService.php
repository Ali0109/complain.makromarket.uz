<?php

namespace App\Services;

use App\Models\Region;
use Illuminate\Support\Facades\DB;

class CSVService
{
    public static function import_csv($file_name) {
        $file_handle = fopen(public_path("csv/seed/$file_name.csv"), 'r');
        $regions = [];
        while (!feof($file_handle)) {
            $data = fgetcsv($file_handle, 1000, ",");
            if($data) {
                $regions[] = $data;
            }
        }
        fclose($file_handle);

        return $regions;
    }
}
