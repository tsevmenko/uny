<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interest::truncate();

        $csvFile = fopen(base_path("database/data/i_sport_en.csv"), "r");

        while (($data = fgetcsv($csvFile, 2000, ',')) !== FALSE) {
            Interest::create([
                'name' => $data['0'],
                'type' => $data['1']
            ]);
        }

        fclose($csvFile);
    }
}
